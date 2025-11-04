<?php

namespace App\Controllers\DashboardController;

use App\Models\Services;
use App\Core\Csrf;
use App\Request\ServiceRequest;
// Feedback2-- Need proper indentation as per PSR-12 standards
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

        $this->render('dashboard/Services/createService.view.php', [
            'services' => $services,
        ]);
        
    }
public function store()
{
    // CSRF Protection

    // Feedback2-- Why used a different approach for CSRF Token Validation in this function?
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

    // Feedback2-- What would happend if there is an error during create operation?
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

    // Feedback2-- Why used a different approach for CSRF Token Validation in this function?
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

    // Feedback2-- What would happend if there is an error during update operation?
    $this->servicesModel->update($id, $request->all());

    // Success Message + Redirect
    $_SESSION['success'] = "Service updated successfully!";
    redirect(url('/services'));
}
}
