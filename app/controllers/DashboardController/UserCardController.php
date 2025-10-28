<?php
namespace App\Controllers\DashboardController;

use App\Models\User;
use App\Models\UserCard;
use App\Core\Database;

class UserCardController
{
    protected $userModel;
    protected $reservationModel;

    public function __construct()
    {
        $config = require BASE_PATH . 'config.php';
        $db = new Database($config['database']);

        // $this->userModel = new User($db);
        $this->reservationModel = new UserCard($config);
        //  
    }

    public function index()
    {
        // session_start();

        if (!isset($_SESSION['user_id'])) {
            redirect(url('/login'));
            exit;
        }
   $roleId = $_SESSION['role_id'] ?? null;
        $userId = $_SESSION['user_id'] ?? null;

        $userId = $_SESSION['user_id'];
         if ($roleId == 4) {
       

        $currentReservation = $this->reservationModel->getCurrentReservation($userId);

        return view('dashboard/user.view.php', [
           
            'currentReservation' => $currentReservation ?? null
        ]);
    }
}
}
