<?php

namespace App\Controllers\DashboardController;

use App\Core\Database;
use App\Models\Rooms;

class RoomsController
{
    protected $room;

    public function __construct()
    {
        
 $config = require BASE_PATH . 'config.php';
        $db = new Database($config);
        $this->room = new Rooms($db);
    }

    public function index()
    {
        $rooms = $this->room->getAllRooms();
        return view('dashboard/rooms.view.php', ['rooms' => $rooms]);
    }
}