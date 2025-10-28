<?php


namespace App\Controllers\DashboardController;

use App\Core\Database;
use App\Models\Services;

class ServicesController
{
    protected $db;
    protected $servicesModel;

    public function __construct()
    {
        // Database connection
        $config = require BASE_PATH . 'config.php';
        $this->db = new Database($config['database']);

        // Single merged model
        $this->servicesModel = new Services($this->db);
    }

    
    public function index()
    {
        $services = $this->servicesModel->getAll();

      $content = view('dashboard/Services/services.view.php', [
            'services' => $services
        ]);
            return view('Layouts/dashboard.layout.php', ['content' => $content]);
    
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

       $content = view('dashboard/Services/createService.view.php', [
            'services' => $services
        ]);
         return view('Layouts/dashboard.layout.php', ['content' => $content]);
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

       $content = view('dashboard/Services/editService.view.php', [
            'service' => $service
        ]);
         return view('Layouts/dashboard.layout.php', ['content' => $content]);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];

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

