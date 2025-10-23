<?php
namespace App\Middleware;
use PDO;


class Permission
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function hasPermission($userId, $permissionName)
    {
        // 1Permission ID get 
        $stmt = $this->db->prepare("SELECT id FROM permissions WHERE name = ?");
        $stmt->execute([$permissionName]);
        $permission = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$permission) return false;
        $permissionId = $permission['id'];

        // User ka role 
        $stmt = $this->db->prepare("SELECT role_id FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $role = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$role) return false;

        $roleId = $role['role_id'];

        // Check role-based permission
        $stmt = $this->db->prepare("
            SELECT COUNT(*) FROM role_permissions 
            WHERE role_id = ? AND permission_id = ?
        ");
        $stmt->execute([$roleId, $permissionId]);
        $hasRolePermission = $stmt->fetchColumn() > 0;

        // 4Check user-based permission 
        $stmt = $this->db->prepare("
            SELECT COUNT(*) FROM user_permissions 
            WHERE user_id = ? AND permission_id = ?
        ");
        $stmt->execute([$userId, $permissionId]);
        $hasUserPermission = $stmt->fetchColumn() > 0;

        return $hasRolePermission || $hasUserPermission;
    }
}


// class Permission
// {
//     // $permission can be e.g. 'users.edit'
//     public function handle($permission)
//     {
//         if (session_status() === PHP_SESSION_NONE) session_start();

//         // not logged in
//         if (empty($_SESSION['user_id'])) {
//             header('Location: ' . BASE_URL . '/login');
//             exit;
//         }

//         $perms = $_SESSION['permissions'] ?? [];

//         // if super_admin, allow everything (optional)
//         if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) {
//             return; // super admin bypass
//         }

//         if (!in_array($permission, $perms)) {
//             http_response_code(403);
//             echo "403 - Unauthorized: You don't have access to this page.";
//             exit;
//         }
//     }
// }

