<?php
namespace App\Controllers\DashboardController;

use App\Models\User;
use App\Models\UserReservation;
use App\Core\Database;
use App\Middleware\AuthMiddleware;
class UserDashboardController
{
    protected $userModel;
    protected $reservationModel;

    public function __construct()
    {
        $config = require BASE_PATH . 'config.php';
        $db = new Database($config['database']);

        // $this->userModel = new User($db);
        $this->reservationModel = new UserReservation($config);
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
        // $user = $this->userModel->findUserById($userId);

        $currentReservation = $this->reservationModel->getCurrentReservation($userId);

        return view('dashboard/user.view.php', [
            // 'user' => $user,
            'currentReservation' => $currentReservation ?? null
        ]);
    }
}
}
