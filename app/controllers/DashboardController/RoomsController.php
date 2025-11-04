<?php

namespace App\Controllers\DashboardController;

use App\Models\Rooms;
use App\Request\RoomRequest;
use App\Core\Csrf;
// Feedback2-- Need proper indentation as per PSR-12 standards
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
        $rooms = $this->roomModel->getAllRooms();
        $this->render('dashboard/Rooms/rooms.view.php', ['rooms' => $rooms]);
        
    }

    public function delete()
    {
        session_start();

        if (! isset($_POST['id'])) {
            header('Location: '.BASE_URL.'/rooms');
            exit;
        }

        $id = (int) $_POST['id'];
        $this->roomModel->softDelete($id);

        header('Location: '.BASE_URL.'/rooms');
        exit;
    }

    public function detail($id = null)
    {
        if (! $id && isset($_GET['id'])) {
            $id = (int) $_GET['id'];
        }

        $room = $this->roomModel->find($id);

        // Feedback2-- Return user to the page with proper message not a case for 404
        if (! $room) {
            abort(404);
        }

        $this->render('dashboard/Rooms/roomDetail.view.php', [
            'room' => $room,
        ]);
       
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
        $this->render('dashboard/Rooms/roomCreate.view.php', [
            'hotels' => $hotels,
        ]);
       
    }
    

    public function store()
{
 // CSRF CHECK
    // Feedback2-- Why used a different approach for CSRF Token Validation in this function?
    if (!isset($_POST['_token']) || $_POST['_token'] !== $_SESSION['_token']) {
        $_SESSION['errors']['csrf'] = "Invalid CSRF token!";
       
    // redirect(url('/rooms'));
        // return;
    }
    $request = new RoomRequest($_POST);

    if (!$request->validate()) {
        $_SESSION['errors'] = $request->errors();
        $_SESSION['old'] = $_POST;
       redirect(url('/rooms'));
        return;
    }

    $room = new Rooms();

    $room->create($request->all());

    redirect(url('/rooms'));
}
}

// Feedback2-- Dont keep commented code in the codebase use git to see old versions keep the codebase clean

// public function store()
// {
//     // CSRF CHECK
//     if (!isset($_POST['_token']) || $_POST['_token'] !== $_SESSION['_token']) {
//         $_SESSION['errors']['csrf'] = "Invalid CSRF token!";
       
//     redirect(url('/rooms'));
//         return;
//     }

//     //  VALIDATION
//     $request = new RoomRequest($_POST);

//     if (!$request->validate()) {
//         $_SESSION['errors'] = $request->errors();
//         $_SESSION['old'] = $_POST;
        
//     redirect(url('/rooms'));
//         return;
//     }

//     // ✅ MODEL
//     $room = new Rooms();
//     $room->create($request->all());

//     redirect(url('/rooms'));
// }
// }

// public function store()
//     {
//         // Feedback-- Did you use Request Class?
//         // Feedback-- Did you use concept of CSRF tokens in this form submission?

//         $data = [
//             'room_number' => $_POST['room_number'],
//             'floor' => $_POST['floor'],
//             'room_bed' => $_POST['room_bed'],
//             'Max_guests' => $_POST['Max_guests'],
//             'hotel_id' => $_POST['hotel_id'],
//             'status' => $_POST['status'],
//         ];

//         // Feedback-- How are you handling the sql injections and unsafe queries?
//         $this->roomModel->create($data);

//         redirect(url('/rooms'));
//     }
// }
