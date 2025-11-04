<?php

namespace App\Controllers\Auth;

use App\Core\Database;
use App\Request\SignupRequest;

class StaffSignupController
{
    public function index()
    {
        // Step 1: If POST => process form
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Step 2: Validate form input
            $validatedData = SignupRequest::validate($_POST, '/staffSignup');

            // Step 3: Hash password securely
            $hashedPassword = password_hash($validatedData['password'], PASSWORD_BCRYPT);

            // Step 4: Use Singleton pattern for DB
            $config = require base_path('config.php');

            // Feedback2-- Should use the instance of the database from the base controller following singelton design pattern
            $db = new Database($config['database']);

            // Step 5: Use prepared statement (safe from SQL injection)

            // Feedback2-- Should be in the model
            $db->query(
                'INSERT INTO users (first_name, last_name, user_email, contact_no, password, role_id) 
                 VALUES (:first_name, :last_name, :user_email, :contact_no, :password ,:role_id)',
                [
                    ':first_name' => $validatedData['first_name'],
                    ':last_name' => $validatedData['last_name'],
                    ':user_email' => $validatedData['user_email'],
                    ':contact_no' => $validatedData['contact_no'],
                    ':password' => $hashedPassword,
                    ':role_id' => 2,
                ]
            );

            // Step 6: Redirect on success
            header('Location: '.BASE_URL.'/staffLogin');
            exit;
        }

        // Step 7: If GET => show form (and display any validation errors)
        $errors = $_SESSION['errors'] ?? [];
        unset($_SESSION['errors']);

        view('auth/staffSignup.view.php', ['errors' => $errors]);
    }
}