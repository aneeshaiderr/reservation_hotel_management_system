<?php

namespace App\Controllers\DashboardController;

use App\Models\Services;
use App\Core\Csrf;
use App\Request\ServiceRequest;
// Feedback-- Need proper indentation as per PSR-12 standards
class ServicesController extends BaseController
{
    protected $db;

    protected $servicesModel;

    public function __construct()
    {
        $this->servicesModel = new Services($this->db);
    }

    public function index()
    {
        $services = $this->servicesModel->getAll();

        // Feedback-- This view function in the base controller should be used to render the layout while the function
        // Call here should pass data to the view.

        // Feedback-- Layout should accept the view name and include or require the view passed here current approach incorrect
        $this->render('dashboard/Services/services.view.php', [
            'services' => $services,
        ]);
      
    }

       public function delete()
       {
           if (! isset($_POST['id'])) {
               header('Location: '.BASE_URL.'/services');
               exit;
           }

           $id = (int) $_POST['id'];
           $this->servicesModel->softDelete($id);

           header('Location: '.BASE_URL.'/services');
           exit;
       }

    public function create()
    {
        

      
          $services = $this->servicesModel->all(); 
        // Feedback-- This view function in the base controller should be used to render the layout while the function
        // Call here should pass data to the view.

        // Feedback-- Layout should accept the view name and include or require the view passed here current approach incorrect
        $this->render('dashboard/Services/createService.view.php', [
            'services' => $services,
        ]);
        
    }
public function store()
{
    // CSRF Protection
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['errors']['csrf'] = "Invalid CSRF token!";
        
    }

    // Request class
    $request = new ServiceRequest($_POST);

    // Validate
    if (!$request->validate()) {
        $_SESSION['errors'] = $request->errors();
        $_SESSION['old'] = $_POST;
        redirect(url('/services'));
        return;
    }

    // Insert into DB
    $this->servicesModel->create($request->all());

    // Redirect to index
    redirect(url('/services'));
}



    public function edit()
    {
        if (! isset($_GET['id'])) {
            redirect(url('/services'));
        }

        $id = $_GET['id'];
        $service = $this->servicesModel->find($id);

        if (! $service) {
            redirect(url('/services'));
        }

        // Feedback-- This view function in the base controller should be used to render the layout while the function
        // Call here should pass data to the view.

        // Feedback-- Layout should accept the view name and include or require the view passed here current approach incorrect
        $this->render('dashboard/Services/editService.view.php', [
            'service' => $service,
        ]);
      
    }
public function update()
{
    //  Allow POST only
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        redirect(url('/services'));
        return;
    }

    //  CSRF Check
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['errors']['csrf'] = "Invalid CSRF token!";
       
    }

    // Request Validation
    $request = new ServiceRequest($_POST);

    if (!$request->validate()) {
        $_SESSION['errors'] = $request->errors();
        $_SESSION['old'] = $_POST;
        redirect($_SERVER['HTTP_REFERER']);
       
    }

    // Get Service ID
    $id = $_POST['id'] ?? null;
    if (!$id) {
        $_SESSION['error'] = "Service ID is required!";
        
    }

    // Update in DB
    $this->servicesModel->update($id, $request->all());

    // Success Message + Redirect
    $_SESSION['success'] = "Service updated successfully!";
    redirect(url('/services'));
}
}
