<?php

// RoomController.php

namespace App\Controllers;

class RoomController extends BaseController
{
    public function __construct()
    {
        $this->view = 'Frontend/room.php';
    }
}
