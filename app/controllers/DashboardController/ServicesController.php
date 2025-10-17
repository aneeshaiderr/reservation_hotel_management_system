<?php

namespace App\Controllers\DashboardController;

use App\Core\Database;
use App\Models\Services;

class ServicesController
{
    protected $servicesModel;

    public function __construct()
    {
        $config = require BASE_PATH . 'config.php';
        $db = new Database($config['database']);
        $this->servicesModel = new Services($db);
    }

    // Show all services
    public function index()
    {
        $services = $this->servicesModel->getAll();

        return view('dashboard/services.view.php', [
            'services' => $services
        ]);
    }

    // Soft delete service
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
}
