<?php

namespace App\Controllers\DashboardController;

use App\Core\Csrf;
use App\Models\Services;
use App\Request\ServiceRequest;

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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['_token'] ?? '';


            if (!Csrf::validateToken($token)) {
                $_SESSION['error'] = 'Token has expired or is invalid. Please try again.';
                header('Location: '.BASE_URL.'/login');
                exit();
            }

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

        try {
            $this->servicesModel->create($request->all());
            $_SESSION['success'] = 'Service created successfully.';
            header('Location: ' . url('/services'));
            exit();
        } catch (\Exception $e) {
            $_SESSION['error'] = 'Please provide correct information: ' . $e->getMessage();
            header('Location: ' . url('/services/create'));
            exit();
        }

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

        //  CSRF Check
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['_token'] ?? '';

            // CSRF token validation using centralized method
            if (!Csrf::validateToken($token)) {
                $_SESSION['error'] = 'Token has expired or is invalid. Please try again.';
                header('Location: '.BASE_URL.'/login');
                exit();
            }

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
            $_SESSION['error'] = 'Service ID is required!';
        }

        // Update in DB
        $this->servicesModel->update($id, $request->all());

        // Success Message
        $_SESSION['success'] = 'Service updated successfully!';
        redirect(url('/services'));
    }
}
