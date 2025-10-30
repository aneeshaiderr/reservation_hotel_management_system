<?php

namespace App\Controllers\DashboardController;

use App\Core\Database;
use App\Models\Rooms;

// Feedback-- Need proper indentation as per PSR-12 standards
class RoomsController extends BaseController
{
    protected $db;
    protected $roomModel;

    public function __construct()
    {
        
        $this->roomModel = new Rooms($this->db);
    }

    public function index()
    {
        // Feedback-- This view function in the base controller should be used to render the layout while the function
        // Call here should pass data to the view.

        // Feedback-- Layout should accept the view name and include or require the view passed here current approach incorrect
        $rooms = $this->roomModel->getAllRooms();
        $this-> view('dashboard/Rooms/rooms.view.php', ['rooms' => $rooms]);
                return view('Layouts/dashboard.layout.php');
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

        // Feedback-- This view function in the base controller should be used to render the layout while the function
        // Call here should pass data to the view.

        // Feedback-- Layout should accept the view name and include or require the view passed here current approach incorrect
      $this-> view('dashboard/Rooms/roomDetail.view.php', [
            'room' => $room
        ]);
         return view('Layouts/dashboard.layout.php');
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
        // Feedback-- This view function in the base controller should be used to render the layout while the function
        // Call here should pass data to the view.

        // Feedback-- Layout should accept the view name and include or require the view passed here current approach incorrect

          $hotels = $this->roomModel->getAllHotels();
        // Show create room form
         $this-> view('dashboard/Rooms/roomCreate.view.php', [
            'hotels' => $hotels
        ]);
         return view('Layouts/dashboard.layout.php');
    }


    public function store()
    {
        // Feedback-- Did you use Request Class?
        // Feedback-- Did you use concept of CSRF tokens in this form submission?

        $data = [
            'room_number' => $_POST['room_number'],
            'floor'       => $_POST['floor'],
            'room_bed'    => $_POST['room_bed'],
            'Max_guests'  => $_POST['Max_guests'],
            'hotel_id'    => $_POST['hotel_id'],
            'status'      => $_POST['status']
        ];
  
        // Feedback-- How are you handling the sql injections and unsafe queries?
       $this->roomModel->create($data);

        redirect(url('/rooms'));
    }
}


