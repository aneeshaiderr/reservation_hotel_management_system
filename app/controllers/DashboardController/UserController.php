<?php

namespace App\Controllers\DashboardController;

use App\Core\Csrf;
use App\Helpers\Permission;
use App\Middleware\ExceptionHandler;
use App\Models\RoleModel;
use App\Models\User;
use App\Request\UserRequest;

class UserController extends BaseController
{
    protected $userModel;
    protected $reservationModel;


    protected $roleModel;
    protected $permission;
    protected $content;

    public function __construct()
    {
        $this->userModel = new User($this->db);
        $this->roleModel = new RoleModel($this->db);


        $this->permission = new Permission($this->userModel, $this->roleModel);


    }

    public function index()
    {
        // Feedback3-- Remove unnecessary comments before pushing code on git
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

        // Feedback3-- Explain this function verbally
        // Get user ID from URL or fallback to logged-in user
        $userId = $_GET['id'] ?? $_SESSION['user_id'];
        // Fetch all past reservations, default to empty array
        $allReservations = $this->userModel->getAllReservationsByUser($userId) ?? [];
        // Fetch the user's current active reservation
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

    public function Show($id = null)
    {
        if (! $id && isset($_GET['id'])) {
            $id = $_GET['id'];
        }

        $user = $this->userModel->find($id);

        if (! $user || $user === false) {
            $_SESSION['error'] = 'User not found. Please check the details.';
            header('Location: '.BASE_URL.'/login');
            exit();
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

    public function create()
    {

        $this->render('dashboard/User/create.view.php');
    }


    public function store()
    {
        // Allow only POST request
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['_token'] ?? '';


            if (!Csrf::validateToken($token)) {
                $_SESSION['error'] = 'Token has expired or is invalid. Please try again.';
                header('Location: '.BASE_URL.'/login');
                exit();
            }
        }


        // Request Class Validation
        $request = new UserRequest($_POST);

        if (!$request->validate()) {
            $_SESSION['errors'] = $request->errors();
            $_SESSION['old']    = $_POST;

            redirect(url('/user/create'));

            return;
        }

        // Extract Validated Data
        $data = $request->all();
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $data['status']   = 1;
        $data['role_id']  = 4;
        $data['address']  = '';

        // Insert into DB
        try {
            $this->userModel->create($data);

            $_SESSION['success'] = 'User created successfully!';
            redirect(url('/user'));

        } catch (\PDOException $e) {
            ExceptionHandler::handle($e, url('/user/create'));
        }
    }




    public function editUser()
    {
        if (! $this->permission->can('edit_user')) {
            abort(403);
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

        $this->render('dashboard/User/editUser.view.php', ['user' => $user]);
    }
    public function update()
    {

        $id = $_POST['id'] ?? null;

        if (! $id) {
            $_SESSION['error'] = 'Missing user ID.';
            redirect(url('/user'));
            exit;
        }

        // Use request class with update mode
        $request = new UserRequest($_POST, true);

        if (! $request->validate()) {
            $_SESSION['errors'] = $request->errors();
            $_SESSION['old'] = $_POST;
            redirect(url('/user/edit?id=' . $id));
            exit;
        }

        try {
            $validated = $request->all();


            $validated['status'] = $_POST['status'] ?? 'active';
            $validated['address'] = $_POST['address'] ?? '';


            // Update DB
            $this->userModel->update($id, $validated);

            $_SESSION['success'] = 'User updated successfully!';
        } catch (\Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }

        redirect(url('/user'));
        exit;
    }




    public function softDelete()
    {
        if (! $this->permission->can('delete_user')) {
            abort(403);
        }

        if (! isset($_POST['id']) || empty($_POST['id'])) {
            exit('User ID missing!');
        }

        $id = (int) $_POST['id'];
        $this->userModel->softDelete($id);

        header('Location: '.BASE_URL.'/user');
        exit;
    }
}
