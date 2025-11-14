<?php

namespace App\Middleware;

use App\Helpers\Permission;
use App\Models\User;

class Middleware
{
    protected User $userModel;
    protected Permission $permission;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->userModel = new User();
        $this->permission = new Permission($this->userModel);
    }

    /**
     * Ensure user is logged in
     */
    public function handle()
    {
        if (!isset($_SESSION['user'])) {
            $_SESSION['error'] = 'Please login to continue.';
            header('Location: /login');
            exit;
        }
    }

    /**
     * Check if logged-in user has a specific permission
     */
    public function can(string $permissionName): bool
    {
        $userId = $_SESSION['user_id'] ?? null;

        if (!$userId) {
            return false;
        }

        // Use Permission helper for role-based & user-based permissions
        return $this->permission->can($permissionName);
    }

    /**
     * Deny access and show 403 page
     */
    public function deny()
    {
        http_response_code(403);
        include BASE_PATH . '/public/errors/403.php';
        exit;
    }


}



