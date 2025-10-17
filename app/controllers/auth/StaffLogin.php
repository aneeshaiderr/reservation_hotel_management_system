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

    $user = $db->query("SELECT * FROM users WHERE user_email = :user_email", [
        ':user_email' => $_POST['user_email']
    ])->find();

    if (!$user || !password_verify($_POST['password'], $user['password'])) {
        $_SESSION['error'] = "Invalid email or password";
        header("Location: /practice/public/staffLogin"); 
        exit();
    }

 $_SESSION['user_id'] = $user['id'];
    $_SESSION['role_id'] = $user['role_id']; 
    $_SESSION['user'] = [
        'id'    => $user['id'],
        'user_email' => $user['user_email'],
        'name'  => $user['first_name'] . ' ' . $user['last_name']
    ];
redirect("/practice/public/user");
    // header("Location: /practice/public/user"); 
    exit();
}

}

