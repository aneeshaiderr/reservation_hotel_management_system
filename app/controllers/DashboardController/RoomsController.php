<?php

namespace App\Controllers\DashboardController;

use App\Core\Database;
use App\Models\Rooms;


class RoomsController
{
    protected $roomModel;

    public function __construct()
    {
        $config = require BASE_PATH . 'config.php';
        $db = new Database($config['database']);
        $this->roomModel = new Rooms($db);
    }

    public function index()
    {
        $rooms = $this->roomModel->getAllRooms();
        return view('dashboard/rooms.view.php', ['rooms' => $rooms]);
    }

    public function delete()
    {
        session_start();

        if (!isset($_POST['id'])) {
            header('Location: ' . BASE_URL . '/rooms');
            exit;
        }

        $id = (int)$_POST['id'];
        $this->roomModel->softDelete($id);

        header('Location: ' . BASE_URL . '/rooms');
        exit;
    }
}
