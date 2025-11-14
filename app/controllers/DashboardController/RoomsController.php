<?php

namespace App\Controllers\DashboardController;

use App\Core\Csrf;
use App\Models\Rooms;
use App\Request\RoomRequest;

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

        if (! $room) {
            $_SESSION['error'] = 'Room details not found.';
            header('Location: ' . url('/rooms'));
            exit();
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['_token'] ?? '';
            if (!Csrf::validateToken($token)) {
                $_SESSION['error'] = 'Token has expired or is invalid. Please try again.';
                header('Location: '.BASE_URL.'/login');
                exit();
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
}
