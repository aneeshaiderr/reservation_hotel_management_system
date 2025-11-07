<?php

namespace App\Controllers\Auth;

use App\Controllers\DashboardController\BaseController;
use App\Models\User;

class StaffLoginController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        // Initialize User model
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

        // Get user by email using User model
        $user = $this->userModel->findEmail($email);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role_name'] = strtolower($user['role_name']);
        // Check if user exists and password matches
        if (!$user || !$this->userModel->verifyPassword($user, $password)) {
            $_SESSION['errors'] = ['Invalid email or password. Please try again.'];
            header('Location: /practice/public/staffLogin');
            exit();
        }

        // Set user session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role_id'] = $user['role_id'];
        $_SESSION['user'] = [
            'id' => $user['id'],
            'user_email' => $user['user_email'],
            'name' => $user['first_name'] . ' ' . $user['last_name'],
            'role_name' => strtolower($user['role_name'] ?? 'user'),
        ];



        // Redirect to dashboard/user page
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
