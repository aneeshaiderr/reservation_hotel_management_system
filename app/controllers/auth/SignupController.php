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
        $db = new Database($config['database']);

        // Step 4: Insert user securely using prepared statement

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

// namespace App\Controllers\Auth;
// use App\Request\SignupRequest;
// use App\Core\Database;

// class SignupController
// {

//     public function index()
//     {
//          view('auth/signup.view.php');
//        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//             // Feedback-- Did you implement Request Classes and Concept of Request Validation?
//             $firstName = $_POST['first_name'] ;
//             $lastName  = $_POST['last_name'] ;
//             $email     = $_POST['user_email'] ;
//             $contact   = $_POST['contact_no'] ;
//             $password  = $_POST['password'] ;

//             // Password hash for security
//             $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
//             if ($_SERVER['REQUEST_METHOD'] === 'POST') {

//             //  Validate data before using
//             $validatedData = SignupRequest::validate($_POST);

//             // Password hash for security
//             // $hashedPassword = password_hash($validatedData['password'], PASSWORD_BCRYPT);

//             // Database connection
//             $config = require base_path('config.php');
//             $db = new Database($config['database']);
//             // Database connection
//             // $config = require base_path('config.php');
//             // $db = new Database($config['database']);

//             // Feedback-- Should be present in the User Model Breaking MVC Conventions
//             // Feedback-- How are you handling the sql injections and unsafe queries?
//             $db->query(
//                 "INSERT INTO users (first_name, last_name, user_email, contact_no, password, role_id)
//                  VALUES (:first_name, :last_name, :user_email, :contact_no, :password ,:role_id)",
//                 [
//                     ':first_name' => $firstName,
//                     ':last_name'  => $lastName,
//                     ':user_email'      => $email,
//                     ':contact_no'    => $contact,
//                     ':password'   => $hashedPassword,
//                     ':role_id'    => 4
//                 ]
//             );

//             // Redirect after successful signup

//            header("Location: " . BASE_URL . "/login");
//             exit;
//         }

//         // Agar GET request hai to form dikhado
//         // view('auth/signup.view.php');
//     }
// }
// }
