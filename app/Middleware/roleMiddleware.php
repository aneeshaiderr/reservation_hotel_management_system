<?php

namespace App\Middleware;

class RoleMiddleware
{
    public static function allow(array $roles)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        //  User login check
        if (!isset($_SESSION['user'])) {
            $_SESSION['error'] = 'Please login first.';
            header('Location: /login');
            exit;
        }

        $userRole = $_SESSION['user']['role'] ?? null;

        // Role match check
        if (!in_array($userRole, $roles)) {
            $_SESSION['error'] = 'You do not have access.';
            header(url('Location: /user'));
            exit;
        }
    }
}
