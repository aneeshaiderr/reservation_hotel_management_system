<?php

namespace App\Models;

class RolePermission extends BaseModel
{
    public function all()
    {
        return $this->db->fetchAll('SELECT * FROM permissions');
    }

    public function getRolePermissions($roleId)
    {
        $data =  $this->db->fetchAll(
            'SELECT permission_id FROM role_permissions WHERE role_id = ?',
            [$roleId]
        );

        return array_column($data, 'permission_id');
    }
}
