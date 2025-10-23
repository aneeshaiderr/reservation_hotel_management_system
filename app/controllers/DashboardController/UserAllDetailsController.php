<?php

namespace App\Controllers\DashboardController;

use App\Models\UserAllDetails;
use App\Models\UserReservation;
use App\Core\Database;

class UserAllDetailsController
{
    protected $reservationModel;
    protected $userReservationModel;
    protected $user;

    public function __construct()
    {
        $config = require BASE_PATH . 'config.php';
        $db = new Database($config['database']);

        $this->reservationModel = new UserAllDetails($db);
        $this->userReservationModel = new UserReservation($config);
        $this->user = $this->reservationModel; 
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

        $allReservations = $this->reservationModel->getAllReservationsByUser($userId) ?? [];
        $currentReservation = $this->userReservationModel->getCurrentReservation($userId);

        if ($currentReservation) {
            $reservations = array_filter($allReservations, function ($r) use ($currentReservation) {
                return $r['id'] !== $currentReservation['id'];
            });

            array_unshift($reservations, $currentReservation);
        } else {
            $reservations = $allReservations;
        }

        return view('dashboard/userAllDetails.view.php', [
            'reservations' => $reservations
        ]);
    }

  
    public function show($id = null)
    {
        if (!$id && isset($_GET['id'])) {
            $id = $_GET['id'];
        }

        $user = $this->user->find($id);

        if (!$user || $user === false) {
            abort(404);
        }

        return view('dashboard/userdetail.view.php', [
            'user' => $user
        ]);
    }

    public function update()
    {
        $id = $_POST['id'];
        $this->user->update($id, $_POST);

        redirect(url('/user'));
        exit;
    }
}
