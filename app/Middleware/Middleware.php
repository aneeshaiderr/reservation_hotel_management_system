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

    /**
     * Example usage:
     * $middleware = new Middleware();
     * $middleware->handle(); // login check
     * if (!$middleware->can('delete_user')) $middleware->deny();
     */
}





// namespace App\Middleware;

// use PDO;

// // // Feedback-- This needs to be updated completely
// class Middleware
// {
//     protected $pdo;

//     public function __construct($pdo)
//     {
//         $this->pdo = $pdo;
//     }

//     /**
//      * Ensure user is logged in
//      */
//     public function handle()
//     {
//         if (! isset($_SESSION['user'])) {
//             header('Location: /login');
//             exit();
//         }
//     }

//     /**
//      * Check if user has a specific permission
//      */
//     public function can($userId, $permissionName)
//     {
//         // Feedback-- Should be present in the User Model Breaking MVC Conventions
//         $stmt = $this->pdo->prepare('SELECT id FROM permissions WHERE name = ?');
//         $stmt->execute([$permissionName]);
//         $permission = $stmt->fetch(PDO::FETCH_ASSOC);

//         if (! $permission) {
//             return false;
//         }

//         $permissionId = $permission['id'];

//         // Feedback-- Should be present in the User Model Breaking MVC Conventions
//         // 2. Check direct user permission
//         $stmt = $this->pdo->prepare('
//             SELECT 1 FROM user_permissions
//             WHERE user_id = ? AND permission_id = ?
//         ');
//         $stmt->execute([$userId, $permissionId]);
//         if ($stmt->fetch()) {
//             return true;
//         }

//         // Feedback-- Should be present in the User Model Breaking MVC Conventions
//         //  Check role-based permission
//         $stmt = $this->pdo->prepare('
//             SELECT 1
//             FROM roles r
//             JOIN role_permissions rp ON r.id = rp.role_id
//             JOIN users u ON u.role_id = r.id
//             WHERE u.id = ? AND rp.permission_id = ?
//         ');
//         $stmt->execute([$userId, $permissionId]);

//         return $stmt->fetch() ? true : false;
//     }
// }
