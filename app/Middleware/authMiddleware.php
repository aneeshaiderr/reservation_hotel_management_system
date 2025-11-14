<?php

namespace App\Middleware;

class AuthMiddleware
{
    public static function handle()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

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

