<?php

namespace App\Middleware;

class AuthMiddleware
{
    public static function handle()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // ✅ Public pages (no login required)
        $publicRoutes = [
            '/login',
            '/signup',
            '/logout',
        ];

        // ✅ Frontend pages (open without login + direct hit allowed)
        $frontendRoutes = [
            '/',
            '/about',
            '/contact',
            '/news',
            '/staff/login',   // staff login page direct hit allowed
            '/staff/signup',
        ];

        // ✅ Current route
        $uri = strtok($_SERVER['REQUEST_URI'], '?');

        // ✅ Public allowed
        if (in_array($uri, $publicRoutes)) {
            return;
        }

        // ✅ Frontend allowed WITHOUT login + WITHOUT referer
        if (in_array($uri, $frontendRoutes)) {
            return;
        }

        // ✅ If user is not logged in → redirect to login
        if (!isset($_SESSION['user'])) {
            $_SESSION['error'] = 'Please login to continue.';
            header('Location: /login');
            exit;
        }

        // ✅ Backend URLs (admin + staff dashboards both)
        // Example: /dashboard, /admin/users, /staff/dashboard
        $backendPrefixes = ['/dashboard', '/admin', '/staff'];

        // Check if URL starts with backend prefix
        foreach ($backendPrefixes as $prefix) {
            if (strpos($uri, $prefix) === 0) {

                // ✅ Check referer to block URL hit
                $referer = $_SERVER['HTTP_REFERER'] ?? '';

                if (empty($referer)) {
                    http_response_code(404);
                    require BASE_PATH . '/views/errors/404.php';
                    exit;
                }
            }
        }

        // ✅ Otherwise allow
        return;
    }


    public static function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_unset();
        session_destroy();

        header('Location: /login');
        exit;
    }
}


// namespace App\Middleware;

// class AuthMiddleware
// {
//     public static function handle()
//     {
//         // Start session safely
//         if (session_status() === PHP_SESSION_NONE) {
//             session_start();
//         }

//         // Routes that do NOT require login
//         $publicRoutes = [
//             '/login',
//             '/signup',
//             '/logout',  // logout always allowed
//         ];

//         // Current URL
//         $uri = strtok($_SERVER['REQUEST_URI'], '?');

//         // If route is public → allow
//         if (in_array($uri, $publicRoutes)) {
//             return;
//         }

//         // If user is NOT logged in → redirect to login
//         if (!isset($_SESSION['user'])) {
//             $_SESSION['error'] = "Please login to continue.";
//             header("Location: /login");
//             exit;
//         }
//     }

//     // Logout function
//     public static function logout()
//     {
//         if (session_status() === PHP_SESSION_NONE) {
//             session_start();
//         }

//         // destroy session
//         session_unset();
//         session_destroy();

//         // avoid redirect loop
//         header("Location: /login");
//         exit;
//     }
// }

// namespace App\Middleware;

// class AuthMiddleware
// {
//     public function handle()
//     {
//         if (session_status() === PHP_SESSION_NONE) {
//             session_start();
//         }
//         if (!isset($_SESSION['user_id'])) {
//             redirect(url('/login'));
//             exit;
//         }
//     }
// }
