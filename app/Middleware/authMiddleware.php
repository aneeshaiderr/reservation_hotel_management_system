<?php
namespace App\Middleware;

class AuthMiddleware
{
    public function handle()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['user'])) {
            header("Location: /practice/public/login");
            exit;
        }
    }
}

