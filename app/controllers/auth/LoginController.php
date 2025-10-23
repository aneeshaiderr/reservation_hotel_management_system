<?php
namespace App\Controllers\Auth;

use App\Core\Database;

class LoginController
{
    public function index()
    {
        return view("auth/login.view.php");
    }

    public function store()
    {
        session_start();

        $config = require BASE_PATH . 'config.php';
        $db = new Database($config);

        $user = $db->query("SELECT * FROM users WHERE user_email = :email", [
            ':email' => $_POST['user_email']
        ])->find();

        if (!$user || !password_verify($_POST['password'], $user['password'])) {
            $_SESSION['error'] = "Invalid email or password";
            header("Location: /practice/public/login");
            exit;
        }

        //  Fetch role name from DB (join roles table)
        $role = $db->query("SELECT name FROM roles WHERE id = :id", [
            ':id' => $user['role_id']
        ])->find();

        $roleName = strtolower($role['name'] ?? 'user'); // default user

        // Session set karte hain
        $_SESSION['user'] = [
            'id' => $user['id'],
            'email' => $user['user_email'],
            'role_id' => $user['role_id'],
            'role_name' => $roleName,
            'name' => $user['first_name'] . ' ' . $user['last_name']
        ];

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role_id'] = $user['role_id'];

        //  Sab users ka redirect same hoga
        header("Location: /practice/public/user");
        exit;
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();

        header("Location: /practice/public/login");
        exit;
    }
}


// class LoginForm
// {
    
//      public function index()
//     {
        

//         // session_start(); 
//         return view("auth/login.view.php");
    
//     }
    
    
//  public function store()
// {
//     // session_start();

//     $config = require BASE_PATH . 'config.php';
//     $db = new Database($config);

//     $user = $db->query("SELECT * FROM users WHERE user_email = :user_email", [
//         ':user_email' => $_POST['user_email']
//     ])->find();

//     if (!$user || !password_verify($_POST['password'], $user['password'])) {
//         $_SESSION['error'] = "Invalid email or password";
//         header("Location: /practice/public/login"); 
//         exit();
//     }
//     unset($_SESSION['error']);
// // user ko find karne ke baad
// $userId = $user['id'];
// $roleId = $user['role_id'];

// // role based permissions
// $rolePermissions = $db->fetchColumn("
//     SELECT p.name 
//     FROM role_permissions rp
//     JOIN permissions p ON rp.permission_id = p.id
//     WHERE rp.role_id = ?
// ", [$roleId]);

// // user-specific permissions
// $userPermissions = $db->fetchColumn("
//     SELECT p.name 
//     FROM user_permissions up
//     JOIN permissions p ON up.permission_id = p.id
//     WHERE up.user_id = ?
// ", [$userId]);


// $permissionsArray = array_unique(array_merge($rolePermissions, $userPermissions));

// // session me store
// $_SESSION['user_id'] = $userId;
// $_SESSION['role_id'] = $roleId;
//  $_SESSION['user_name'] = $user['name'];
// $_SESSION['permissions'] = $permissionsArray;
//     $_SESSION['users'] = [
//         'id'    => $user['id'],
//         'email' => $user['user_email'],
//         'name'  => $user['first_name'] . ' ' . $user['last_name']
//     ];

//     header("Location: /practice/public/user"); 
//     exit();
// }
// public function logout()
// {
//     session_start();
//     session_unset();  
//     session_destroy();

//     header("Location: /practice/public/login"); 
//     exit();
// }
// }
