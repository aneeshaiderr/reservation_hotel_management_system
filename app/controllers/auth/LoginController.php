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

        
        $user = $db->query("
            SELECT 
                u.id,
                u.user_email,
                u.password,
                u.first_name,
                u.last_name,
                u.role_id,
                r.name AS role_name
            FROM users u
            LEFT JOIN roles r ON u.role_id = r.id
            WHERE u.user_email = :email
            LIMIT 1
        ", [
            ':email' => $_POST['user_email']
        ])->find();

        // Agar user exist nahi karta
        if (!$user || !password_verify($_POST['password'], $user['password'])) {
            $_SESSION['error'] = "Invalid email or password";
            header("Location: /practice/public/login");
            exit;
        }

        //Session set with eager-loaded role
        $_SESSION['user'] = [
            'id'         => $user['id'],
            'email'      => $user['user_email'],
            'role_id'    => $user['role_id'],
            'role_name'  => strtolower($user['role_name'] ?? 'user'),
            'name'       => trim($user['first_name'] . ' ' . $user['last_name'])
        ];

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role_id'] = $user['role_id'];

        //Redirect after login
        header("Location: /practice/public/user");
        exit;
    }

    public function logout()
    {
        session_unset();
        session_destroy();

        header("Location: /practice/public/login");
        exit;
    }
}
