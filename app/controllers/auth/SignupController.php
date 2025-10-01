<?php



namespace App\Controllers\Auth;

use App\Core\Database;

class SignupController
{
    
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstName = $_POST['first_name'] ?? '';
            $lastName  = $_POST['last_name'] ?? '';
            $email     = $_POST['email'] ?? '';
            $contact   = $_POST['contact_no'] ?? '';
            $password  = $_POST['password'] ?? '';
            // $role=$_POST['role_id'];

            // Password hash for security
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Database connection
            $config = require base_path('config.php');
            $db = new Database($config['database']);
            
            $db->query(
                "INSERT INTO users (first_name, last_name, email, contact_no, password, role_id) 
                 VALUES (:first_name, :last_name, :email, :contact_no, :password ,:role_id)",
                [
                    ':first_name' => $firstName,
                    ':last_name'  => $lastName,
                    ':email'      => $email,
                    ':contact_no'    => $contact,
                    ':password'   => $hashedPassword,
                    ':role_id'    => 4
                ]    
            );

            // Redirect after successful signup
          
           header("Location: " . BASE_URL . "/login");
            exit;
        }

        // Agar GET request hai to form dikhado
        view('auth/signup.view.php');
    }
}
