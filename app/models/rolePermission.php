<?php

namespace App\Models;

class RolePermission extends BaseModel
{
 // Get all permissions from permissions table
    public function all()
    {
        return $this->db->fetchAll("SELECT * FROM permissions ORDER BY name ASC");
    }

    // Delete permissions for a role
    // public function deleteRolePermissions($roleId)
    // {
    //     return $this->db->execute("DELETE FROM role_permissions WHERE role_id = ?", [$roleId]);
    // }

    // Assign permission to a role
    public function assignPermission($roleId, $permissionId)
    {
        return $this->db->execute(
            "INSERT INTO role_permissions (role_id, permission_id) VALUES (?, ?)",
            [$roleId, $permissionId]
        );
    }
}
