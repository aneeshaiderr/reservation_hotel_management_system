<?php



namespace App\Controllers\DashboardController;

use App\Models\UserCard;
use App\Models\User;
use App\Core\Database;
use App\Middleware\ExceptionHandler;
class UserController extends BaseController 
{
 
    protected $userModel;
    protected $userCard;
protected $content;
    public function __construct()
    {
       

        $this->userModel = new User($this->db);
        $this->userCard = new UserCard();
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

        $roleId = $_SESSION['role_id'] ?? null;
        $userId = $_SESSION['user_id'] ?? null;

        if ($roleId == 1) {
            $users = $this->userModel->getAllUsers();
            $this->view('dashboard/User/index.view.php', ['users' => $users]); 
         
        } elseif ($roleId == 2) {
            $users = $this->userModel->getAllUsers();
             $this->view('dashboard/Staff/staff.view.php', ['users' => $users]); 
          
        } else {
            $user = $this->userModel->findUserById($userId);
            $currentReservation = $this->userCard->getCurrentReservation($userId);
           $this->view('dashboard/User/user.view.php', [
                'user' => $user,
                'currentReservation' => $currentReservation ?? null
            ]);
         
        }

        return view('Layouts/dashboard.layout.php');
    }

    /*  Using Model for query now */
    public function userAllDetails()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            redirect(url('/login'));
            exit;
        }

        $userId = $_GET['id'] ?? $_SESSION['user_id'];
        $allReservations = $this->userModel->getAllReservationsByUser($userId) ?? [];
        $currentReservation = $this->userCard->getCurrentReservation($userId);

        if ($currentReservation) {
            $reservations = array_filter($allReservations, fn($r) => $r['id'] !== $currentReservation['id']);
            array_unshift($reservations, $currentReservation);
        } else {
            $reservations = $allReservations;
        }
        $this->view('dashboard/User/userAllDetails.view.php', [
            'reservations' => $reservations
        ]);
       

        return view('Layouts/dashboard.layout.php');
    }

    public function userAllDetailsShow($id = null)
    {
        if (!$id && isset($_GET['id'])) {
            $id = $_GET['id'];
        }

        $user = $this->userModel->find($id);

        if (!$user || $user === false) {
            abort(404);
        }

        $this->view('dashboard/User/userdetail.view.php', ['user' => $user]);
        return view('Layouts/dashboard.layout.php');
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstName = $_POST['first_name'] ?? '';
            $lastName  = $_POST['last_name'] ?? '';
            $email     = $_POST['user_email'] ?? '';
            $contact   = $_POST['contact_no'] ?? '';
            $password  = $_POST['password'] ?? '';
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $data = [
            'first_name' => $firstName,
            'last_name'  => $lastName,
            'user_email' => $email,
            'contact_no' => $contact,
            'address'    => '',
            'password'   => $hashedPassword,
            'status'     => 1,
            'role_id'    => 4
        ];

        try {
            $this->userModel->create($data);
            $_SESSION['success'] = "User created successfully!";
            redirect(url('/user'));
        } catch (\PDOException $e) {
           
            ExceptionHandler::handle($e, $_SERVER['HTTP_REFERER']);
        }
    
            
        }

        $this->view('dashboard/User/create.view.php');
        return view('Layouts/dashboard.layout.php');
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

        $user = $this->userModel->find($id);

        if (!$user) {
            $_SESSION['error'] = "User details not found.";
            redirect(url('/user'));
            exit;
        }

        $this->view('dashboard/User/details.view.php', ['user' => $user]);
        return view('Layouts/dashboard.layout.php');
    }

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
            $this->userModel->update($id, $_POST);
            $_SESSION['success'] = "User updated successfully!";
        } catch (\Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }

        redirect(url('/user'));
        exit;
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
}
