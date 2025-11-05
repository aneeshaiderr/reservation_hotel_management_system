<?php

namespace App\Controllers\Auth;

use App\Controllers\DashboardController\BaseController;
use App\Models\User;
use App\Request\SignupRequest;

class SignupController extends BaseController
{
    public function index()
    {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return view('auth/signup.view.php');
        }

        //  Validate form data
        $validatedData = SignupRequest::validate($_POST, '/signup');

        //  Hash password
        $hashedPassword = password_hash($validatedData['password'], PASSWORD_BCRYPT);

        $userData = [
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'user_email' => $validatedData['user_email'],
            'contact_no' => $validatedData['contact_no'],
            'password' => $hashedPassword,
            'role_id' => 4,
        ];


        $userModel = new User($this->db);

        try {
            $userModel->signup($userData);
        } catch (\Exception $e) {

            $_SESSION['errors'] = ['Signup failed: '.$e->getMessage()];
            header('Location: '.BASE_URL.'/signup');
            exit;
        }

        // SSuccess message aur redirect to login
        $_SESSION['success'] = 'Signup successful! You can now login.';
        header('Location: '.BASE_URL.'/login');
        exit;
    }
}
