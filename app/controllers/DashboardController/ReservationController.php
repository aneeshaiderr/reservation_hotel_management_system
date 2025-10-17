<?php

namespace App\Controllers\DashboardController;

use App\Core\Database;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Rooms;
use App\Models\Discount;
use App\Middleware\AuthMiddleware;
class ReservationController
{
    protected $reservationModel;
protected $userModel;
 protected  $room;
  protected  $discount;
 protected  $discountModel;
protected  $hotelModel;
    public function __construct()
    {
        $config = require BASE_PATH . 'config.php';
        $db = new Database($config['database']);
        $this->reservationModel = new Reservation($db);
         $this->userModel = new User();         
        $this->hotelModel = new Hotel($db); 
        $this->room = new Rooms($db);
          $this->discount = new Discount($db);
           $auth = new AuthMiddleware();
        $auth->checkAccess(); 
    }

    // Show all reservations
    public function index()
    {
//  session_start();

        if (!isset($_SESSION['user_id'])) {
            header("Location: " . BASE_URL . "/login");
            exit;
        }

        $userId = $_SESSION['user_id'];
        $roleId = $_SESSION['role_id']; // 1=superadmin, 2=staff, 3=manager?, 4=user

        // Filter applied in model
        $reservations = $this->reservationModel->getAllReservations($userId, $roleId);


        // $reservations = $this->reservationModel->getAllReservations();
        return view('dashboard/reservation.view.php', [
            'reservations' => $reservations
        ]);
    }
// Show create reservation form
public function create()
{
    // Fetch all users (email)
    $users = $this->userModel->getAllUsers();

    // Fetch all hotels (name)
    $hotels = $this->hotelModel->getAllHotels(); 
    $rooms = $this->room->getAllRooms();
    $discounts = $this->discount->getAll();
    return view('dashboard/reservationCreate.view.php', [
        'users' => $users,
        'hotels' => $hotels,
        'rooms'=>$rooms,
          'discounts' => $discounts 
    ]);
}
public function store()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // 1️⃣ Check if it's a delete request (soft delete)
        if (isset($_POST['hotel_code']) && !isset($_POST['check_in'])) {
            $hotelCode = $_POST['hotel_code'];
            $this->reservationModel->softDeleteByHotelCode($hotelCode);
            header('Location: ' . BASE_URL . '/reservation');
            exit;
        }

        // 2️⃣ Normal reservation create request
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

        $this->reservationModel->create($data);
        header('Location: ' . BASE_URL . '/reservation');
        exit;
    }
}

public function delete()
{
    $hotelCode = $_POST['hotel_code'] ?? null;

    if (!$hotelCode) {
        die("Hotel code missing!");
    }

    // Call model function to delete
    $this->reservationModel->deleteByHotelCode($hotelCode);

    // Redirect after delete
    header("Location: " . BASE_URL . "/reservation");
    exit;
}

    // Show reservation detail
    public function show()
    {
        $id = (int)$_GET['id'];
        $reservation = $this->reservationModel->getReservationById($id);

        return view('dashboard/reservationDetail.view.php', [
            'reservation' => $reservation
        ]);
    }
}



