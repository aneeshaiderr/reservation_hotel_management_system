<?php


namespace App\Controllers\DashboardController;

use App\Models\User;
use App\Models\UserReservation;
use App\Core\Database;
use App\Middleware\AuthMiddleware;
class UserController
{
    protected $userModel;
    protected $reservationModel;

    public function __construct()
    {
        $config = require BASE_PATH . 'config.php';
        $db = new Database($config['database']);

        $this->userModel = new User($db);
        $this->reservationModel = new UserReservation($config);
    //    $auth = new AuthMiddleware();
    //     $auth->checkAccess(); 
    }

    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            redirect(url('/login'));
            exit;
        }

        $roleId = $_SESSION['role_id'] ?? null;
        $userId = $_SESSION['user_id'] ?? null;
        
        // Super Admin Dashboard
        if ($roleId == 1) {
            $users = $this->userModel->getAllUsers();

            return view('dashboard/superAdmin.view.php', [
                'users' => $users
            ]);
        } 
        //  Staff Dashboard (redirect to reservation dashboard)
  elseif ($roleId == 2) {
   $users = $this->userModel->getAllUsers();
   return view('dashboard/staff.view.php', [
        'users' => $users
   ]);
}
        //  All other users (Normal, Guest, etc.)
        else {
            
            $user = $this->userModel->findUserById($userId);
            $currentReservation = $this->reservationModel->getCurrentReservation($_SESSION['user_id']);
 
            return view('dashboard/user.view.php', [
                'user' => $user,
                
                'currentReservation' => $currentReservation ?? null
            ]);
        }
        
    }

     // Soft delete
    public function softDelete()
{
    session_start(); 

    if (!isset($_POST['id'])) {
        header('Location: ' . BASE_URL . '/user');
        exit;
    }

    $id = $_POST['id'];

    // Call model function for soft delete
    $this->userModel->softDelete($id);

   
    header('Location: ' . BASE_URL . '/user');
    exit;
}
}


