<?php
namespace App\Middleware;
use PDO;
// use App\Helpers\Permission;

class Permission
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function hasPermission($userId, $permissionName)
    {
        // 1️⃣ Permission ID get karo
        $stmt = $this->db->prepare("SELECT id FROM permissions WHERE name = ?");
        $stmt->execute([$permissionName]);
        $permission = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$permission) return false;
        $permissionId = $permission['id'];

        // 2️⃣ User ka role nikal lo
        $stmt = $this->db->prepare("SELECT role_id FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $role = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$role) return false;

        $roleId = $role['role_id'];

        // 3️⃣ Check role-based permission
        $stmt = $this->db->prepare("
            SELECT COUNT(*) FROM role_permissions 
            WHERE role_id = ? AND permission_id = ?
        ");
        $stmt->execute([$roleId, $permissionId]);
        $hasRolePermission = $stmt->fetchColumn() > 0;

        // 4️⃣ Check user-based permission (agar direct assign hui ho)
        $stmt = $this->db->prepare("
            SELECT COUNT(*) FROM user_permissions 
            WHERE user_id = ? AND permission_id = ?
        ");
        $stmt->execute([$userId, $permissionId]);
        $hasUserPermission = $stmt->fetchColumn() > 0;

        return $hasRolePermission || $hasUserPermission;
    }
}

// class Permission {
//  protected $db;

//     public function __construct($db, $requiredPermission) {
//         $this->db = $db;
//     }

//     public function handle($userId, $requiredPermission) {
//         if (!$userId) {
//             http_response_code(401);
//             echo "Unauthorized - Please login first.";
//             exit;
//         }

//         // Check direct user permissions
//         $stmt = $this->db->prepare("
//             SELECT COUNT(*) 
//             FROM user_permissions up
//             JOIN permissions p ON up.permission_id = p.id
//             WHERE up.user_id = ? AND p.name = ?
//         ");
//         $stmt->execute([$userId, $requiredPermission]);
//         $hasDirect = $stmt->fetchColumn();

//         // Check role-based permissions
//         $stmt = $this->db->prepare("
//             SELECT COUNT(*)
//             FROM role_permissions rp
//             JOIN permissions p ON rp.permission_id = p.id
//             JOIN roles r ON rp.role_id = r.id
//             JOIN user_roles ur ON ur.role_id = r.id
//             WHERE ur.user_id = ? AND p.name = ?
//         ");
//         $stmt->execute([$userId, $requiredPermission]);
//         $hasRole = $stmt->fetchColumn();

//         if (!$hasDirect && !$hasRole) {
//             http_response_code(403);
//             echo "403 - Permission denied!";
//             exit;
//         }
//     }
// }

// function can($userId, $permissionName, $pdo) {
   
//     $stmt = $pdo->prepare("SELECT id FROM permissions WHERE name = ?");
//     $stmt->execute([$permissionName]);
//     $permission = $stmt->fetch(PDO::FETCH_ASSOC);

//     if (!$permission) {
//         return false; 
//     }

//     $permissionId = $permission['id'];

//     // 2. check user direct permissions
//     $stmt = $pdo->prepare("
//         SELECT 1 FROM user_permissions 
//         WHERE user_id = ? AND permission_id = ?
//     ");
//     $stmt->execute([$userId, $permissionId]);
//     if ($stmt->fetch()) {
//         return true;
//     }

    
//     $stmt = $pdo->prepare("
//         SELECT 1 
//         FROM roles r
//         JOIN role_permissions rp ON r.id = rp.role_id
//         JOIN users u ON u.role_id = r.id
//         WHERE u.id = ? AND rp.permission_id = ?
//     ");
//     $stmt->execute([$userId, $permissionId]);

//     return $stmt->fetch() ? true : false;
// }
