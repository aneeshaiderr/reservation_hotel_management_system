<?php

namespace App\Middleware;

use PDO;

// Feedback2-- This needs to be updated completely
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
        $stmt = $this->db->prepare('SELECT id FROM permissions WHERE name = ?');
        $stmt->execute([$permissionName]);
        $permission = $stmt->fetch(PDO::FETCH_ASSOC);

        if (! $permission) {
            return false;
        }
        $permissionId = $permission['id'];

        // User ka role
        $stmt = $this->db->prepare('SELECT role_id FROM users WHERE id = ?');
        $stmt->execute([$userId]);
        $role = $stmt->fetch(PDO::FETCH_ASSOC);
        if (! $role) {
            return false;
        }

        $roleId = $role['role_id'];

        // Check role-based permission
        $stmt = $this->db->prepare('
            SELECT COUNT(*) FROM role_permissions 
            WHERE role_id = ? AND permission_id = ?
        ');
        $stmt->execute([$roleId, $permissionId]);
        $hasRolePermission = $stmt->fetchColumn() > 0;

        // 4Check user-based permission
        $stmt = $this->db->prepare('
            SELECT COUNT(*) FROM user_permissions 
            WHERE user_id = ? AND permission_id = ?
        ');
        $stmt->execute([$userId, $permissionId]);
        $hasUserPermission = $stmt->fetchColumn() > 0;

        return $hasRolePermission || $hasUserPermission;
    }
}
