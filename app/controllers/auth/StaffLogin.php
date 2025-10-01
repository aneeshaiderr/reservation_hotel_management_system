<?php

namespace App\Controllers\Auth;
use App\Middleware\Session;
use App\Core\Database;
class StaffLogin
{
    
     public function index()
    {
        

        // session_start(); 
        return view("auth/staffLogin.view.php");
    
    }
    
    
 public function store()
{
    // session_start();

    $config = require BASE_PATH . 'config.php';
    $db = new Database($config);

    $user = $db->query("SELECT * FROM users WHERE email = :email", [
        ':email' => $_POST['email']
    ])->find();

    if (!$user || !password_verify($_POST['password'], $user['password'])) {
        $_SESSION['error'] = "Invalid email or password";
        header("Location: /practice/public/staffLogin"); 
        exit();
    }

    $_SESSION['user'] = [
        'id'    => $user['id'],
        'email' => $user['email'],
        'name'  => $user['first_name'] . ' ' . $user['last_name']
    ];

    header("Location: /practice/public/user"); 
    exit();
}

}

