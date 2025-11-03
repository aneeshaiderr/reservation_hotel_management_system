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
            $db = new Database($config['database']);

            // Step 5: Use prepared statement (safe from SQL injection)
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

// namespace App\Controllers\Auth;

// use App\Core\Database;

// class StaffSignupController
// {

//     public function index()
//     {
//            view('auth/staffSignup.view.php');
//         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//             // Feedback-- Did you implement Request Classes and Concept of Request Validation?
//             $firstName = $_POST['first_name'] ;
//             $lastName  = $_POST['last_name'] ;
//             $useremail     = $_POST['user_email'] ;
//             $contact   = $_POST['contact_no'] ;
//             $password  = $_POST['password'] ;

//             // Password hash for security
//             $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

//             // Feedback-- Need to use singleton pattern for database connection
//             // Database connection
//             $config = require base_path('config.php');
//             $db = new Database($config['database']);

//             // Feedback-- Should be present in the User Model Breaking MVC Conventions
//             // Feedback-- How are you handling the sql injections and unsafe queries?
//             $db->query(
//                 "INSERT INTO users (first_name, last_name, user_email, contact_no, password, role_id)
//                  VALUES (:first_name, :last_name, :user_email, :contact_no, :password ,:role_id)",
//                 [
//                     ':first_name' => $firstName,
//                     ':last_name'  => $lastName,
//                     ':user_email'      => $useremail,
//                     ':contact_no'    => $contact,
//                     ':password'   => $hashedPassword,
//                     ':role_id'    => 2
//                 ]
//             );

//             // Redirect after successful signup

//            header("Location: " . BASE_URL . "/staffLogin");
//             exit;
//         }

//         // Agar GET request hai to form dikhado
//         view('auth/staffSignup.view.php');
//     }
// }
