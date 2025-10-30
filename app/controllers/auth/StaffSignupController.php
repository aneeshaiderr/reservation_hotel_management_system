<?php



namespace App\Controllers\Auth;

use App\Core\Database;

class StaffSignupController
{
    
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Feedback-- Did you implement Request Classes and Concept of Request Validation?
            $firstName = $_POST['first_name'] ?? '';
            $lastName  = $_POST['last_name'] ?? '';
            $useremail     = $_POST['user_email'] ?? '';
            $contact   = $_POST['contact_no'] ?? '';
            $password  = $_POST['password'] ?? '';
           

            // Password hash for security
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Feedback-- Need to use singleton pattern for database connection
            // Database connection
            $config = require base_path('config.php');
            $db = new Database($config['database']);
            
            // Feedback-- Should be present in the User Model Breaking MVC Conventions
            // Feedback-- How are you handling the sql injections and unsafe queries?
            $db->query(
                "INSERT INTO users (first_name, last_name, user_email, contact_no, password, role_id) 
                 VALUES (:first_name, :last_name, :user_email, :contact_no, :password ,:role_id)",
                [
                    ':first_name' => $firstName,
                    ':last_name'  => $lastName,
                    ':user_email'      => $useremail,
                    ':contact_no'    => $contact,
                    ':password'   => $hashedPassword,
                    ':role_id'    => 2
                ]    
            );

            // Redirect after successful signup
          
           header("Location: " . BASE_URL . "/staffLogin");
            exit;
        }

        // Agar GET request hai to form dikhado
        view('auth/staffSignup.view.php');
    }
}

