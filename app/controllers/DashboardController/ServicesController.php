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

    // ===============================
    // 1️⃣  Show all services
    // ===============================
    public function index()
    {
        $services = $this->servicesModel->getAll();

        return view('dashboard/services.view.php', [
            'services' => $services
        ]);
    }

    // ===============================
    // 2️⃣  Soft delete service
    // ===============================
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

    // ===============================
    // 3️⃣  Show create service form
    // ===============================
    public function create()
    {
        $services = $this->db->fetchAll("
            SELECT id, service_name, price, status 
            FROM services 
            WHERE deleted_at IS NULL
        ");

        return view('dashboard/createService.view.php', [
            'services' => $services
        ]);
    }

    // ===============================
    // 4️⃣  Handle create form submission
    // ===============================
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

    // ===============================
    // 5️⃣  Show edit form
    // ===============================
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

        return view('dashboard/editService.view.php', [
            'service' => $service
        ]);
    }

    // ===============================
    // 6️⃣  Handle update request
    // ===============================
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

// namespace App\Controllers\DashboardController;

// use App\Core\Database;
// use App\Models\Services;

// class ServicesController
// {
//     protected $servicesModel;

//     public function __construct()
//     {
//         $config = require BASE_PATH . 'config.php';
//         $db = new Database($config['database']);
//         $this->servicesModel = new Services($db);
//     }

//     // Show all services
//     public function index()
//     {
//         $services = $this->servicesModel->getAll();

//         return view('dashboard/services.view.php', [
//             'services' => $services
//         ]);
//     }

//     // Soft delete service
//     public function delete()
//     {
//         if (!isset($_POST['id'])) {
//             header('Location: ' . BASE_URL . '/services');
//             exit;
//         }

//         $id = (int)$_POST['id'];
//         $this->servicesModel->softDelete($id);

//         header('Location: ' . BASE_URL . '/services');
//         exit;
//     }
// }
