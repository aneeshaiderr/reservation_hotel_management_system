<?php



namespace App\Controllers\Auth;

use App\Core\Database;

class StaffSignupController
{
    
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstName = $_POST['first_name'] ?? '';
            $lastName  = $_POST['last_name'] ?? '';
            $useremail     = $_POST['user_email'] ?? '';
            $contact   = $_POST['contact_no'] ?? '';
            $password  = $_POST['password'] ?? '';
           

            // Password hash for security
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Database connection
            $config = require base_path('config.php');
            $db = new Database($config['database']);
            
            $db->query(
                "INSERT INTO users (first_name, last_name, user_email, contact_no, password, role_id) 
                 VALUES (:first_name, :last_name, :user_email, :contact_no, :password ,:role_id)",
                [
                    ':first_name' => $firstName,
                    ':last_name'  => $lastName,
                    ':user_email'      => $email,
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

