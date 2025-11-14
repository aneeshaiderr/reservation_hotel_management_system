<?php

namespace App\Controllers\Auth;

use App\Controllers\DashboardController\BaseController;
use App\Models\User;
use App\Models\RoleModel;
use App\Helpers\Permission;
class StaffLoginController extends BaseController
{
    protected $userModel;
protected $permission;
    protected $roleModel;
    public function __construct()
    {
        // Initialize User model
             $roleModel = new RoleModel();

        $this->userModel = new User();
    }

    // Show login form
    public function index()
    {


        return view('auth/staffLogin.view.php');
    }

    // Handle login form submission
   public function store()
{
    session_start();

    $email = $_POST['user_email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Get user by email
    $user = $this->userModel->findEmail($email);

    // Role check (case-insensitive) + password verification
    if (!$user || strtolower($user['role_name']) !== 'staff' || !$this->userModel->verifyPassword($user, $password)) {
        $_SESSION['errors'] = ['Invalid email, password, or you are not allowed to login here.'];
        header('Location: /practice/public/staffLogin');
        // exit();
    }

    // Set session
    $_SESSION['user'] = [
        'id' => $user['id'],
        'user_email' => $user['user_email'],
        'name' => $user['first_name'] . ' ' . $user['last_name'],
        'role_id' => $user['role_id'],
        'role_name' => strtolower($user['role_name']),
    ];
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['role_id'] = $user['role_id'];

    // Redirect to staff dashboard
    header('Location: /practice/public/user');
    exit();
}


    // Logout user
    public function logout()
    {
        session_unset();
        session_destroy();

        header('Location: /practice/public/staffLogin');
        exit();
    }
}



