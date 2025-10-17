<?php

namespace App\Controllers\DashboardController;

use App\Core\Database;
use App\Models\EditService;

class EditServiceController
{
    protected $db;
    protected $service;

    public function __construct()
    {
        // Database Connection
        $config = require BASE_PATH . 'config.php';
        $this->db = new Database($config['database']);

        // Initialize Model
        $this->service = new EditService($this->db);
    }

    //  Show Edit Form (GET)
    public function edit()
    {
        if (!isset($_GET['id'])) {
            redirect(url('/services'));
        }

        $id = $_GET['id'];
        $service = $this->service->find($id);

        if (!$service) {
            redirect(url('/services'));
        }

        // Render view
        return view('dashboard/editService.view.php', ['service' => $service]);
    }

    // Handle Update Request (POST / PATCH)
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];

            $data = [
                'service_name' => $_POST['service_name'],
                'price'        => $_POST['price'],
                'status'       => $_POST['status']
            ];

            $this->service->update($id, $data);

            // Redirect back to services list after update
            redirect(url('/services'));
        } else {
            redirect(url('/services'));
        }
    }
}

