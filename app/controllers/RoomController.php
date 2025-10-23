<?php
// RoomController.php
namespace App\Controllers;

use App\Controllers\BaseController;
class RoomController extends BaseController
{
    public function __construct()
    {
        $this->view = 'Frontend/room.php';
    }
}
