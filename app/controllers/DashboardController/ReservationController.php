<?php

namespace App\Controllers\DashboardController;

use App\Core\Database;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Rooms;
use App\Models\Discount;
use App\Middleware\AuthMiddleware;
use App\Middleware\ExceptionHandler;
use App\Middleware\Permission;

class ReservationController extends BaseController
{
    protected $reservationModel;
    protected $userModel;
    protected $room;
    protected $discount;
    protected $hotelModel;
       protected $db;
    protected $permission;
    public function __construct()
    {
    
        $this->reservationModel = new Reservation($this->db);
        $this->userModel = new User();
        $this->hotelModel = new Hotel($this->db);
        $this->room = new Rooms($this->db);
        $this->discount = new Discount($this->db);

       
    }

    // Show all reservations
    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . BASE_URL . "/login");
            exit;
        }

        $userId = $_SESSION['user_id'];
        $roleId = $_SESSION['role_id'];

        $reservations = $this->reservationModel->getAllReservations($userId, $roleId);

     $this-> view('dashboard/Reservation/reservation.view.php', [
            'reservations' => $reservations
        ]);
         return view('Layouts/dashboard.layout.php');
    }

    // Show create reservation form
    public function create()
    {
        $users = $this->userModel->getAllUsers();
        $hotels = $this->hotelModel->getAllHotels();
        $rooms = $this->room->getAllRooms();
        $discounts = $this->discount->getAll();

       $this->view('dashboard/Reservation/reservationCreate.view.php', [
            'users' => $users,
            'hotels' => $hotels,
            'rooms' => $rooms,
            'discounts' => $discounts
        ]);
         return view('Layouts/dashboard.layout.php');
        
    }
    public function store()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $userId  = $_POST['user_id'] ?? null;
        $hotelId = $_POST['hotel_id'] ?? null;

        if (!$userId || !$hotelId) {
            die("Missing required data (user_id or hotel_id)");
        }

        $user_email = $this->reservationModel->getUserEmailById($userId);
        $hotel_name = $this->reservationModel->getHotelNameById($hotelId);

        $data = [
            'hotel_code'  => $_POST['hotel_code'] ?? null,
            'user_id'     => $userId,
            'email'       => $user_email,
            'hotel_id'    => $hotelId,
            'hotel_name'  => $hotel_name,
            'room_id'     => $_POST['room_id'] ?? null,
            'discount_id' => $_POST['discount_id'] ?? null,
            'check_in'    => $_POST['check_in'] ?? null,
            'check_out'   => $_POST['check_out'] ?? null,
            'status'      => $_POST['status'] ?? 'pending'
        ];
try {
          $this->reservationModel->create($data);
            $_SESSION['success'] = "Reservation created successfully!";
            redirect(url('/reservation'));
        } catch (\PDOException $e) {
            
            ExceptionHandler::handle($e, $_SERVER['HTTP_REFERER']);
        }
     
    }
}

    // Delete reservation
    public function delete()
    {
        $hotelCode = $_POST['hotel_code'] ?? null;
        if (!$hotelCode) die("Hotel code missing!");

        $this->reservationModel->deleteByHotelCode($hotelCode);
        header("Location: " . BASE_URL . "/reservation");
        exit;
    }

    // Show reservation detail
    public function show()
    {
        $id = (int)$_GET['id'];
        $reservation = $this->reservationModel->getReservationById($id);

       $this-> view('dashboard/Reservation/reservationDetail.view.php', [
            'reservation' => $reservation
        ]);
         return view('Layouts/dashboard.layout.php');
    }

    // Show Edit Form 
    public function edit($id = null)
    {
        if (!$id && isset($_GET['id'])) {
            $id = (int)$_GET['id'];
        }

        $reservation = $this->reservationModel->find($id);
        if (!$reservation) abort(404);

        $hotels = $this->hotelModel->getAllHotels();
        $discounts = $this->discount->getAll();

       $this->view('dashboard/Reservation/editReservation.view.php', [
            'reservation' => $reservation,
            'hotels' => $hotels,
            'discounts' => $discounts
        ]);
         return view('Layouts/dashboard.layout.php');
    }

    // Update Reservation 
   
    public function update()
    {
       if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'] ?? null;

        
        if (!$id) {
            redirect(url('/reservation'));
        }
        
        $id = $_POST['id'];
        $data = [
            'hotel_id' => $_POST['hotel_id'],
            'hotel_code' => $_POST['hotel_code'],
            'discount_id' => $_POST['discount_id'],
            'check_in' => $_POST['check_in'],
            'check_out' => $_POST['check_out'],
            'status' => $_POST['status']
        ];

        $this->reservationModel->update($id, $data);
        header('Location: ' . BASE_URL . '/reservation');
        exit;
    }
}
}

