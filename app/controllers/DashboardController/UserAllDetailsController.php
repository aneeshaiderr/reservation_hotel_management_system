<?php

namespace App\Controllers\DashboardController;

use App\Models\UserAllDetails;
use App\Models\UserReservation;
use App\Core\Database;
use App\Middleware\AuthMiddleware;
class UserAllDetailsController
{
    protected $reservationModel;
    protected $userReservationModel;

    public function __construct()
    {
        $config = require BASE_PATH . 'config.php';
        $db = new Database($config['database']);
        $this->reservationModel = new UserAllDetails($db);
        $this->userReservationModel = new UserReservation($config);
        //  $auth = new AuthMiddleware();
        // $auth->checkAccess(); 
    }

  public function index()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['user_id'])) {
        redirect(url('/login'));
        exit;
    }

    $userId = $_GET['id'] ?? $_SESSION['user_id'];

    // Get all reservations
    $allReservations = $this->reservationModel->getAllReservationsByUser($userId) ?? [];

    // Get current reservation
    $currentReservation = $this->userReservationModel->getCurrentReservation($userId);

    // Filter out the current reservation from all reservations if it already exists there
    if ($currentReservation) {
        $reservations = array_filter($allReservations, function ($r) use ($currentReservation) {
            return $r['id'] !== $currentReservation['id'];
        });

        // Add current reservation on top (latest)
        array_unshift($reservations, $currentReservation);
    } else {
        $reservations = $allReservations;
    }

    return view('dashboard/userAllDetails.view.php', [
        'reservations' => $reservations
    ]);
}
}
