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

// class RoleMiddleware
// {
//     public function handle($requiredRole)
//     {
//         if (session_status() === PHP_SESSION_NONE) {
//             session_start();
//         }

//         if (empty($_SESSION['user'])) {
//             header('Location: /practice/public/login');
//             exit;
//         }

//         $userRole = strtolower($_SESSION['user']['role_name'] ?? '');

//         // Super Admin
//         if ($userRole === 'superadmin') {
//             return;
//         }

//         // Role-specific match check
//         $requiredRole = strtolower($requiredRole);
//         if ($userRole !== $requiredRole) {
//             http_response_code(403);
//             echo "403 - Unauthorized: You don't have access to this page.";
//             exit;
//         }
//     }
// }
