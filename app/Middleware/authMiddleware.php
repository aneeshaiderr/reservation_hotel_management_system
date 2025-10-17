<?php


namespace App\Middleware;

class AuthMiddleware
{
    protected $allowedPages = [
        1 => ['dashboard','staff','rooms','hotel','reservation','reservationCreate','editReservation','user','payment','discount','details','services','analytics','setting'], // Super Admin
        2 => ['dashboard','rooms','reservation','reservationCreate','services','delete','services/delete','details'], // Staff
        4 => ['user','reservation','reservationCreate','/reservation/delete']  // Normal User
    ];

    public function checkAccess()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $roleId = $_SESSION['role_id'] ?? null;
        $currentPage = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), ".php");

        if (!isset($this->allowedPages[$roleId]) || !in_array($currentPage, $this->allowedPages[$roleId])) {
           http_response_code(403); 
            die("Forbidden: You cannot access this page 403.");
        }
        
    }
 
}


