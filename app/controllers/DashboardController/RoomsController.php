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

    // ======================================
    // 🟩 From RoomsController
    // ======================================
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

    // ======================================
    // From RoomDetailController
    // ======================================
    public function detail($id = null)
    {
        if (!$id && isset($_GET['id'])) {
            $id = (int) $_GET['id'];
        }

        $room = $this->roomModel->find($id);

        if (!$room) {
            abort(404);
        }

        return view('dashboard/roomDetail.view.php', [
            'room' => $room
        ]);
    }

    public function update()
    {
        $id = (int) $_POST['id'];

        $this->roomModel->update($id, $_POST);
        redirect(url('/rooms'));
        exit;
    }

    // ======================================
    // From RoomCreateController
    // ======================================
    public function create()
    {
        
        // Fetch all hotels for dropdown
        $hotels = $this->db->fetchAll("SELECT id, hotel_name FROM hotels", []);

        // Show create room form
        return view('dashboard/roomCreate.view.php', [
            'hotels' => $hotels
        ]);
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

        $this->db->query("
            INSERT INTO rooms (room_number, floor, beds, max_guests, hotel_id, status)
            VALUES (:room_number, :floor, :room_bed, :Max_guests, :hotel_id, :status)
        ", $data);

        redirect(url('/rooms'));
    }
}


// namespace App\Controllers\DashboardController;

// use App\Core\Database;
// use App\Models\Rooms;


// class RoomsController
// {
//     protected $roomModel;

//     public function __construct()
//     {
//         $config = require BASE_PATH . 'config.php';
//         $db = new Database($config['database']);
//         $this->roomModel = new Rooms($db);
//     }

//     public function index()
//     {
//         $rooms = $this->roomModel->getAllRooms();
//         return view('dashboard/rooms.view.php', ['rooms' => $rooms]);
//     }

//     public function delete()
//     {
//         session_start();

//         if (!isset($_POST['id'])) {
//             header('Location: ' . BASE_URL . '/rooms');
//             exit;
//         }

//         $id = (int)$_POST['id'];
//         $this->roomModel->softDelete($id);

//         header('Location: ' . BASE_URL . '/rooms');
//         exit;
//     }
// }
