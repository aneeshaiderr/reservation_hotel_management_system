<?php

namespace App\Controllers\Auth;

use App\Controllers\DashboardController\BaseController;
use App\Models\User;

class LoginController extends BaseController
{
    public function index()
    {
        return view('auth/login.view.php');
    }

    public function store()
    {
        // Start session if not started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        $email = trim($_POST['user_email'] ?? '');
        $password = $_POST['password'] ?? '';

        // Basic validation
        if ($email === '' || $password === '') {
            $_SESSION['errors'] = ['Please enter email and password.'];
            header('Location: /practice/public/login');
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['errors'] = ['Please enter a valid email address.'];
            header('Location: /practice/public/login');
            exit;
        }
        ;


        // Use User model (query moved to model)
        $userModel = new User($this->db);
        $user = $userModel->findByEmail($email);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role_name'] = strtolower($user['role_name']);

        // Authentication check
        if (! $user || ! password_verify($password, $user['password'])) {
            $_SESSION['errors'] = ['Invalid email or password. Please try again.'];
            header('Location: /practice/public/login');
            exit;
        }

        // Set session user info
        $_SESSION['user'] = [
            'id' => $user['id'],
            'email' => $user['user_email'],
            'role_id' => $user['role_id'],
            'role_name' => strtolower($user['role_name'] ?? 'user'),
            'name' => trim(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? '')),
        ];

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role_id'] = $user['role_id'];
        $roleId = (int) $_SESSION['role_id'];
        // Set success message
        $_SESSION['success'] = 'Login successful! Welcome back, ' . htmlspecialchars($user['first_name'] ?? '');

        // Redirect after login
        header('Location: /practice/public/user');
        exit;
    }

    public function logout()
    {

        session_unset();
        session_destroy();

        header('Location: /practice/public/login');
        exit;
    }
}
