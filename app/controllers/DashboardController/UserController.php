<?php


namespace App\Controllers\DashboardController;

use App\Models\User;
use App\Models\UserReservation;
use App\Core\Database;

class UserController
{
   protected $user;
    protected $userModel;
    protected $reservationModel;

    public function __construct()
    {
        $config = require BASE_PATH . 'config.php';
        $db = new Database($config['database']);
         $this->user = new User($db); 
        $this->userModel = new User($db);
        $this->reservationModel = new UserReservation($config);
   
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


 public function softDelete()
    {
        if (!isset($_POST['id']) || empty($_POST['id'])) {
            die("User ID missing!");
        }

        $id = (int) $_POST['id'];
        $this->userModel->softDelete($id);

        header("Location: " . BASE_URL . "/user");
        exit;
    }
 public function createUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstName = $_POST['first_name'] ?? '';
            $lastName  = $_POST['last_name'] ?? '';
            $email     = $_POST['user_email'] ?? '';
            $contact   = $_POST['contact_no'] ?? '';
            $password  = $_POST['password'] ?? '';
            // $role=$_POST['role_id'];

            // Password hash for security
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Database connection
            $config = require base_path('config.php');
            $db = new Database($config['database']);
            
            $db->query(
                "INSERT INTO users (first_name, last_name, user_email, contact_no, password, role_id) 
                 VALUES (:first_name, :last_name, :user_email, :contact_no, :password ,:role_id)",
                [
                    ':first_name' => $firstName,
                    ':last_name'  => $lastName,
                    ':user_email'      => $email,
                    ':contact_no'    => $contact,
                    ':password'   => $hashedPassword,
                    ':role_id'    => 4
                ]    
            );

            // Redirect after successful signup
          
           header("Location: " . BASE_URL . "/user");
            exit;
        }

        // Agar GET request hai to form dikhado
        view('dashboard/create.view.php');
    }
    public function show()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $id = $_GET['id'] ?? $_SESSION['user_id'] ?? null;

        if (!$id) {
            $_SESSION['error'] = "User not found.";
            redirect(url('/user'));
            exit;
        }

        $user = $this->user->find($id);

        if (!$user) {
            $_SESSION['error'] = "User details not found.";
            redirect(url('/user'));
            exit;
        }

        return view('dashboard/details.view.php', [
            'user' => $user
        ]);
    }

    // Update user details
    public function update()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $id = $_POST['id'] ?? null;

        if (!$id) {
            $_SESSION['error'] = "Missing user ID.";
            redirect(url('/user'));
            exit;
        }

        try {
            $this->user->update($id, $_POST);
            $_SESSION['success'] = "User updated successfully!";
        } catch (\Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }

        redirect(url('/user'));
        exit;
    }
}



