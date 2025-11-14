<?php

namespace App\Controllers\Auth;

use App\Controllers\DashboardController\BaseController;
use App\Models\User;
use App\Request\SignupRequest;

class StaffSignupController extends BaseController
{
    protected $userModel;

    public function __construct()
    {

        $this->userModel = new User();
    }

    public function index()
    {
        // If GET request → show form
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $errors = $_SESSION['errors'] ?? [];
            unset($_SESSION['errors']);

            return view('auth/staffSignup.view.php', [
                'errors' => $errors
            ]);
        }

        //  If POST request → process form
        try {

            // Step 1: Validate input
            $validatedData = SignupRequest::validate($_POST, '/staffSignup');

            // Step 2: Hash password
            $hashedPassword = password_hash($validatedData['password'], PASSWORD_BCRYPT);

            // Step 3: Create staff account via Model
            $this->userModel->staffsignup([
                'first_name'  => $validatedData['first_name'],
                'last_name'   => $validatedData['last_name'],
                'user_email'  => $validatedData['user_email'],
                'contact_no'  => $validatedData['contact_no'],
                'password'    => $hashedPassword,
                'role_id'     => 2,
            ]);

            // Step 4: Flash success message
            $_SESSION['success'] = 'Staff account created successfully! You can now login.';


            header('Location: ' . BASE_URL . '/staffLogin');
            exit;

        } catch (\Exception $e) {

            //  Any DB or email duplicate error
            $_SESSION['errors'] = [$e->getMessage()];
            header('Location: ' . BASE_URL . '/staffSignup');
            exit;
        }
    }
}
