<?php

namespace App\Controllers\DashboardController;

use App\Core\Database;

class RoomCreateController
{
    protected $db;

    public function __construct()
    {
        $config = require BASE_PATH . 'config.php';
        $this->db = new Database($config['database']);
    }

    public function index()
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
        // Form submission handle
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

// use App\Models\RoomCreate;
// use App\Core\Database;

// class RoomCreateController
// {
//     protected $roomModel;
//  protected $db;
//     public function __construct()
//     {
//         $config = require BASE_PATH . 'config.php';
//         $db = new Database($config['database']);
//         $this->roomModel = new RoomCreate($db);
        
//     }

//     // Show all rooms
//     public function index()
//     {
//         $rooms = $this->roomModel->getAll();
//         return view('dashboard/rooms.view.php', ['rooms' => $rooms]);
//     }

//     // Show create room form
//     public function create()
//     {
//          $hotels = $this->db->query("SELECT id, name FROM hotels")->fetchAll();
//         return view('dashboard/roomCreate.view.php');
//     }

//     // Store new room
//     public function store()
//     {
//         $this->roomModel->create($_POST);
//         redirect(url('/rooms')); 
//         exit;
//     }

    // Show edit room form
    // public function edit($id)
    // {
    //     $room = $this->roomModel->find($id);
    //     return view('dashboard/roomEdit.view.php', ['room' => $room]);
    // }

    // Update existing room
    // public function update()
    // {
    //     $id = $_POST['id'];
    //     $this->roomModel->update($id, $_POST);
    //     redirect(url('/rooms'));
    //     exit;
    // }

  
// }

