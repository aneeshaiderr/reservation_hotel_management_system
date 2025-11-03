<?php

namespace App\Helpers;

class Flash
{
    /**
     * Set a flash message in session
     */
    public static function set($key, $message, $type = 'success')
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['flash'][$key] = [
            'message' => $message,
            'type' => $type,
        ];
    }

    /**
     * Get and remove a flash message from session
     */
    public static function get($key)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (! empty($_SESSION['flash'][$key])) {
            $flash = $_SESSION['flash'][$key];
            unset($_SESSION['flash'][$key]);

            return $flash;
        }

        return null;
    }
}
