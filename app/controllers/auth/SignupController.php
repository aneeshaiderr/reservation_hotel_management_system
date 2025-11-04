<?php

namespace App\Controllers\Auth;

use App\Core\Database;
use App\Request\SignupRequest;

class SignupController
{
    public function index()
    {
        // Show signup form first (for GET requests)
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return view('auth/signup.view.php');
        }

        //  Step 1: Validate form data (this checks email format, required fields, etc.)
        $validatedData = SignupRequest::validate($_POST, '/signup');

        //  Step 2: Hash password securely
        $hashedPassword = password_hash($validatedData['password'], PASSWORD_BCRYPT);

        //  Step 3: Database connection
        $config = require base_path('config.php');

        // Feedback2-- Should use the instance of the database from the base controller following singelton design pattern
        $db = new Database($config['database']);

        // Step 4: Insert user securely using prepared statement

        // Feedback2-- Should be in the model
        $db->query(
            'INSERT INTO users (first_name, last_name, user_email, contact_no, password, role_id) 
             VALUES (:first_name, :last_name, :user_email, :contact_no, :password, :role_id)',
            [
                ':first_name' => $validatedData['first_name'],
                ':last_name' => $validatedData['last_name'],
                ':user_email' => $validatedData['user_email'],
                ':contact_no' => $validatedData['contact_no'],
                ':password' => $hashedPassword,
                ':role_id' => 4,
            ]
        );

        //  Step 5: Redirect after successful signup
        header('Location: '.BASE_URL.'/login');
        exit;
    }
}