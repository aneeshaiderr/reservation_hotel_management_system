<?php
namespace App\Controllers\DashboardController;

use App\Models\User;
use App\Models\UserCard;


class UserCardController extends BaseController
{
    protected $userModel;
    protected $reservationModel;

    public function __construct()
    {

        $this->userModel = new UserCard($this->db);
        $this->reservationModel = new UserCard();
        
    }

    public function index()
    {
       

        if (!isset($_SESSION['user_id'])) {
            redirect(url('/login'));
            exit;
        }
   $roleId = $_SESSION['role_id'] ?? null;
        $userId = $_SESSION['user_id'] ?? null;

        $userId = $_SESSION['user_id'];
         if ($roleId == 4) {
       

        $currentReservation = $this->reservationModel->getCurrentReservation($userId);

       $this->view('dashboard/User/user.view.php', [
           
            'currentReservation' => $currentReservation ?? null
        ]);
    }
    
}
}
