<?php

namespace App\Controllers\DashboardController;

use App\Core\Database;
use App\Models\CreateService;

class CreateServiceController
{
    protected $db;
    protected $service;

    public function __construct()
    {
        // Database connection
        $config = require BASE_PATH . 'config.php';
        $this->db = new Database($config['database']);

        // Initialize Model
        $this->service = new CreateService($this->db);
    }

    //  Show the create service form
    public function index()
    {
        // Optional: You can fetch related data if needed
        $services = $this->db->fetchAll("SELECT id, service_name, price, status FROM services WHERE deleted_at IS NULL", []);

        return view('dashboard/createService.view.php', [
            'services' => $services
        ]);
    }

    //  Handle form submission (insert new service)
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'service_name' => $_POST['service_name'],
                'price'        => $_POST['price'] ,
                'status'       => $_POST['status'] ,
            ];

            $this->service->create($data);

            // Redirect back to service list page
            redirect(url('/services'));
        } else {
            redirect(url('/services/create'));
        }
    }
}

