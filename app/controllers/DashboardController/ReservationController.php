<?php

namespace App\Controllers\DashboardController;

use App\Core\CSRF;
use App\Models\Discount;
use App\Models\Hotel;
use App\Models\Reservation;
use App\Models\Rooms;
use App\Models\User;
use App\Request\ReservationRequest;

// Feedback2-- Need proper indentation as per PSR-12 standards
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
        // Feedback2-- Should be consider a global alternative to this rather than handling it in each controller method?


        $userId = $_SESSION['user_id'];
        $roleId = $_SESSION['role_id'];

        $reservations = $this->reservationModel->getAllReservations($userId, $roleId);

        $this->render('dashboard/Reservation/reservation.view.php', [
            'reservations' => $reservations,
        ]);

    }

    // Show create reservation form
    public function create()
    {
        $users = $this->userModel->getAllUsers();
        $hotels = $this->hotelModel->getAllHotels();
        $rooms = $this->room->getAllRooms();
        $discounts = $this->discount->getAll();

        $this->render('dashboard/Reservation/reservationCreate.view.php', [
            'users' => $users,
            'hotels' => $hotels,
            'rooms' => $rooms,
            'discounts' => $discounts,
        ]);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['csrf_token'] ?? '';
            if (!Csrf::validateToken($token)) {
                $_SESSION['error'] = 'Token has expired or is invalid. Please try again.';
                header('Location: '.BASE_URL.'/login');
                exit();
            }



            // Validate request data
            $validated = ReservationRequest::validate($_POST);

            // Auto fetch email + hotel name after validation
            $validated['email']      = $this->reservationModel->getUserEmailById($validated['user_id']);
            $validated['hotel_name'] = $this->reservationModel->getHotelNameById($validated['hotel_id']);

            try {
                $this->reservationModel->create($validated);

                $_SESSION['success'] = 'Reservation created successfully!';
            } catch (\PDOException $e) {
                // Duplicate entry
                if ($e->getCode() == 23000) {
                    $_SESSION['error'] = 'Reservation already exists!';
                    redirect($_SERVER['HTTP_REFERER']);
                }

                // Other errors
                $_SESSION['error'] = 'Something went wrong!';
                redirect($_SERVER['HTTP_REFERER']);
            }

            redirect(url('/reservation'));
        }
    }

    // Delete reservation
    public function delete()
    {
        $hotelCode = $_POST['hotel_code'] ?? null;
        if (! $hotelCode) {
            exit('Hotel code missing!');
        }

        $this->reservationModel->deleteByHotelCode($hotelCode);
        header('Location: '.BASE_URL.'/reservation');
        exit;
    }

    // Show reservation detail
    public function show()
    {
        $id = (int) $_GET['id'];
        $reservation = $this->reservationModel->getReservationById($id);

        $this->render('dashboard/Reservation/reservationDetail.view.php', [
            'reservation' => $reservation,
        ]);
    }

    // Show Edit Form
    public function edit($id = null)
    {
        if (! $id && isset($_GET['id'])) {
            $id = (int) $_GET['id'];
        }

        $reservation = $this->reservationModel->find($id);
        // Feedback2-- Return user to the page with proper message not a case for 404
        if (!$reservation) {
            $_SESSION['error'] = 'Reservation details not found or invalid.';
            header('Location: /reservation');
            exit();
        }



        $hotels = $this->hotelModel->getAllHotels();
        $discounts = $this->discount->getAll();

        $this->render('dashboard/Reservation/editReservation.view.php', [
            'reservation' => $reservation,
            'hotels' => $hotels,
            'discounts' => $discounts,
        ]);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect(url('/reservation'));
        }

        $id = $_POST['id'] ?? null;

        if (!$id) {
            redirect(url('/reservation'));
        }

        // CSRF Token Check
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['csrf_token'] ?? '';
            // Feedback2-- Return user to the login page if token is invalid with proper message
            if (!Csrf::validateToken($token)) {
                $_SESSION['error'] = 'Token are expire. Please try again.';
                header('Location: '.BASE_URL.'/login');
                exit();
            }


            // Validation
            $validated = ReservationRequest::validate($_POST, true);

            //  Update Query
            $this->reservationModel->update($id, $validated);

            //Redirect to listing page
            redirect(url('/reservation'));
        }
    }
}
