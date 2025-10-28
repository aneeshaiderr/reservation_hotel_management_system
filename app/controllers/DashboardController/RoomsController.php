<?php

namespace App\Controllers\DashboardController;

use App\Core\Database;
use App\Models\Rooms;

class RoomsController
{
    protected $db;
    protected $roomModel;

    public function __construct()
    {
        $config = require BASE_PATH . 'config.php';
        $this->db = new Database($config['database']);
        $this->roomModel = new Rooms($this->db);
    }

    public function index()
    {
          
        $rooms = $this->roomModel->getAllRooms();
         $content = view('dashboard/Rooms/rooms.view.php', ['rooms' => $rooms]);
                return view('Layouts/dashboard.layout.php', ['content' => $content]);
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

 
    public function detail($id = null)
    {
        if (!$id && isset($_GET['id'])) {
            $id = (int) $_GET['id'];
        }

        $room = $this->roomModel->find($id);

        if (!$room) {
            abort(404);
        }

       $content = view('dashboard/Rooms/roomDetail.view.php', [
            'room' => $room
        ]);
         return view('Layouts/dashboard.layout.php', ['content' => $content]);
    }

    public function update()
    {
        $id = (int) $_POST['id'];

        $this->roomModel->update($id, $_POST);
        redirect(url('/rooms'));
        exit;
    }


    public function create()
    {
        

          $hotels = $this->roomModel->getAllHotels();
        // Show create room form
         $content = view('dashboard/Rooms/roomCreate.view.php', [
            'hotels' => $hotels
        ]);
         return view('Layouts/dashboard.layout.php', ['content' => $content]);
    }

    public function store()
    {
        $data = [
            'room_number' => $_POST['room_number'],
            'floor'       => $_POST['floor'],
            'room_bed'    => $_POST['room_bed'],
            'Max_guests'  => $_POST['Max_guests'],
            'hotel_id'    => $_POST['hotel_id'],
            'status'      => $_POST['status']
        ];
  
       $this->roomModel->create($data);

        redirect(url('/rooms'));
    }
}


