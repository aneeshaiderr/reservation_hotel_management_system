<?php

namespace App\Controllers\Auth;
use App\Middleware\Session;
use App\Core\Database;
use PDO;
class LoginForm
{
    
     public function index()
    {
        

        // session_start(); 
        return view("auth/login.view.php");
    
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
        header("Location: /practice/public/login"); 
        exit();
    }
    unset($_SESSION['error']);
// user ko find karne ke baad
$userId = $user['id'];
$roleId = $user['role_id'];

// role based permissions
$rolePermissions = $db->fetchColumn("
    SELECT p.name 
    FROM role_permissions rp
    JOIN permissions p ON rp.permission_id = p.id
    WHERE rp.role_id = ?
", [$roleId]);

// user-specific permissions
$userPermissions = $db->fetchColumn("
    SELECT p.name 
    FROM user_permissions up
    JOIN permissions p ON up.permission_id = p.id
    WHERE up.user_id = ?
", [$userId]);

// dono merge kar do
$permissionsArray = array_unique(array_merge($rolePermissions, $userPermissions));

// session me store
$_SESSION['user_id'] = $userId;
$_SESSION['role_id'] = $roleId;
$_SESSION['permissions'] = $permissionsArray;
    $_SESSION['user'] = [
        'id'    => $user['id'],
        'email' => $user['email'],
        'name'  => $user['first_name'] . ' ' . $user['last_name']
    ];

    header("Location: /practice/public/user"); 
    exit();
}
// public function logout()
// {
//     session_start();
//     session_unset();  
//     session_destroy();

//     header("Location: /practice/public/login"); 
//     exit();
// }
}
