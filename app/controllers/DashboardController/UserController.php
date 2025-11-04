<?php

namespace App\Controllers\DashboardController;

use App\Middleware\ExceptionHandler;
use App\Models\User;
use App\Middleware\AuthMiddleware;
use App\Request\UserRequest;
// Feedback2-- Need proper indentation as per PSR-12 standards
class UserController extends BaseController
{
    protected $userModel;
protected $reservationModel;
    protected $userCard;

    protected $content;

    public function __construct()
    {
        $this->userModel = new User($this->db);
        
    }

    public function index()
    {
        $auth = new AuthMiddleware();
        $auth->handle();
       
        $roleId = $_SESSION['role_id'] ?? null;
        $userId = $_SESSION['user_id'] ?? null;

        if ($roleId == 1) {
            $users = $this->userModel->getAllUsers();
            $this->render('dashboard/User/index.view.php', ['users' => $users]);
        } elseif ($roleId == 2) {
            $users = $this->userModel->getAllUsers();
            $this->render('dashboard/Staff/staff.view.php', ['users' => $users]);
        } else {
            $user = $this->userModel->findUserById($userId);
            $currentReservation = $this->userModel->getCurrentReservation($userId);
            $this->render('dashboard/User/user.view.php', [
                'user' => $user,
                'currentReservation' => $currentReservation ?? null,
            ]);
        }
    }

    /*  Using Model for query now */
    public function userAllDetails()
    {
        //Feedback2-- Should keep this logic globally 
        $auth = new AuthMiddleware();
          $auth->handle();
        

        $userId = $_GET['id'] ?? $_SESSION['user_id'];
        $allReservations = $this->userModel->getAllReservationsByUser($userId) ?? [];
        $currentReservation = $this->userModel->getCurrentReservation($userId);

        if ($currentReservation) {
            $reservations = array_filter($allReservations, fn ($r) => $r['id'] !== $currentReservation['id']);
            array_unshift($reservations, $currentReservation);
        } else {
            $reservations = $allReservations;
        }
        $this->render('dashboard/User/userAllDetails.view.php', [
            'reservations' => $reservations,
        ]);

        
    }

    public function userAllDetailsShow($id = null)
    {
        if (! $id && isset($_GET['id'])) {
            $id = $_GET['id'];
        }

        $user = $this->userModel->find($id);

        //Feedback2-- Return user to the page with proper message not a case for 404
        if (! $user || $user === false) {
            abort(404);
        }

        $this->render('dashboard/User/userdetail.view.php', ['user' => $user]);
       
    }

    public function userAllDetailsUpdate()
    {
        $id = $_POST['id'];
        $this->userModel->update($id, $_POST);
        redirect(url('/user'));
        exit;
    }

    
    public function createUser()
    {
        //Feedback2-- Did you use Request Class and Request validation?
        //Feedback2-- Did you use concept of CSRF tokens in this form submission?
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstName = $_POST['first_name'] ?? '';
            $lastName = $_POST['last_name'] ?? '';
            $email = $_POST['user_email'] ?? '';
            $contact = $_POST['contact_no'] ?? '';
            $password = $_POST['password'] ?? '';
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $data = [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'user_email' => $email,
                'contact_no' => $contact,
                'address' => '',
                'password' => $hashedPassword,
                'status' => 1,
                'role_id' => 4,
            ];

            try {
                $this->userModel->create($data);
                $_SESSION['success'] = 'User created successfully!';
                redirect(url('/user'));
            } catch (\PDOException $e) {
                // Feedback2-- Besids ExceptionHandler, did you use any other error handling method for human readable error messages?
                ExceptionHandler::handle($e, $_SERVER['HTTP_REFERER']);
            }
        }

        $this->render('dashboard/User/create.view.php');
      
    }

    public function show()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $id = $_GET['id'] ?? $_SESSION['user_id'] ?? null;

        if (! $id) {
            $_SESSION['error'] = 'User not found.';
            redirect(url('/user'));
            exit;
        }

        $user = $this->userModel->find($id);

        if (! $user) {
            $_SESSION['error'] = 'User details not found.';
            redirect(url('/user'));
            exit;
        }

        $this->render('dashboard/User/details.view.php', ['user' => $user]);
      
    }

    public function update()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $id = $_POST['id'] ?? null;

        if (! $id) {
            $_SESSION['error'] = 'Missing user ID.';
            redirect(url('/user'));
            exit;
        }

        try {
            //Feedback2-- Did you use Request Class and Request validation?
            //Feedback2-- Did you use concept of CSRF tokens in this form submission?
            //Feedback2-- How are you handling the sql injections and unsafe queries?
            $this->userModel->update($id, $_POST);
            $_SESSION['success'] = 'User updated successfully!';
        } catch (\Exception $e) {
            // Feedback2-- Besids ExceptionHandler, did you use any other error handling method for human readable error messages?
            $_SESSION['error'] = $e->getMessage();
        }

        redirect(url('/user'));
        exit;
    }

    public function softDelete()
    {
        if (! isset($_POST['id']) || empty($_POST['id'])) {
            exit('User ID missing!');
        }

        $id = (int) $_POST['id'];
        $this->userModel->softDelete($id);

        header('Location: '.BASE_URL.'/user');
        exit;
    }
}
