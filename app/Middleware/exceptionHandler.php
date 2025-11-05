<?php

namespace App\Middleware;

class ExceptionHandler
{
    public static function handle(\Throwable $e, $redirectUrl = null)
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        // Duplicate entry ke liye friendly message
        if (str_contains($e->getMessage(), 'Duplicate entry')) {
            $_SESSION['error'] = 'This record already exists.';
        } else {
            $_SESSION['error'] = 'Database error: '.$e->getMessage();
        }

        if ($redirectUrl) {
            header('Location: '.$redirectUrl);
        } else {
            header('Location: '.($_SERVER['HTTP_REFERER'] ?? '/'));
        }
        exit;
    }
}
