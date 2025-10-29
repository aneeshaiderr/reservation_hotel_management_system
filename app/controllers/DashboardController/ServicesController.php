<?php


namespace App\Controllers\DashboardController;

use App\Core\Database;
use App\Models\Services;

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

      $this-> view('dashboard/Services/services.view.php', [
            'services' => $services
        ]);
            return view('Layouts/dashboard.layout.php');
    
    }

       public function delete()
    {
        if (!isset($_POST['id'])) {
            header('Location: ' . BASE_URL . '/services');
            exit;
        }

        $id = (int)$_POST['id'];
        $this->servicesModel->softDelete($id);

        header('Location: ' . BASE_URL . '/services');
        exit;
    }


    public function create()
    {
        $services = $this->db->fetchAll("
            SELECT id, service_name, price, status 
            FROM services 
            WHERE deleted_at IS NULL
        ");

      $this-> view('dashboard/Services/createService.view.php', [
            'services' => $services
        ]);
         return view('Layouts/dashboard.layout.php');
    }


    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'service_name' => $_POST['service_name'],
                'price'        => $_POST['price'],
                'status'       => $_POST['status'],
            ];

            $this->servicesModel->create($data);

            redirect(url('/services'));
        } else {
            redirect(url('/services/create'));
        }
    }


    public function edit()
    {
        if (!isset($_GET['id'])) {
            redirect(url('/services'));
        }

        $id = $_GET['id'];
        $service = $this->servicesModel->find($id);

        if (!$service) {
            redirect(url('/services'));
        }

      $this->view('dashboard/Services/editService.view.php', [
            'service' => $service
        ]);
         return view('Layouts/dashboard.layout.php');
    }

    public function update()
    {
       
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id           = $_POST['id'] ?? null;
        $service_name = $_POST['service_name'] ?? '';
        $price        = $_POST['price'] ?? '';
        $status       = $_POST['status'] ?? '';

        
        if (!$id || !$service_name || !$price) {
            redirect(url('/services'));
        }
            $data = [
                'service_name' => $_POST['service_name'],
                'price'        => $_POST['price'],
                'status'       => $_POST['status']
            ];

            $this->servicesModel->update($id, $data);

            redirect(url('/services'));
        } else {
            redirect(url('/services'));
        }
    }
}

