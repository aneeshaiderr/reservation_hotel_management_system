<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Core\Database;

class RoleModel extends BaseModel
{
    public function __construct()
    {
        $config = require BASE_PATH . '/config.php';
        $this->db = new Database($config['database']);
    }
public function all()
{
    return $this->db->fetchAll("SELECT * FROM roles ORDER BY id ASC");
}

public function getPermission($roleId)
{
    $sql = "
        SELECT p.name
        FROM permissions p
        JOIN role_permissions rp ON rp.permission_id = p.id
        WHERE rp.role_id = ?
    ";

    return $this->db->fetchAll($sql, [$roleId], \PDO::FETCH_COLUMN);
}

public function deleteRolePermissions($roleId)
{
    $sql = "DELETE FROM role_permissions WHERE role_id = ?";
    return $this->db->execute($sql, [$roleId]);
}

public function assignPermission($roleId, $permissionId)
{
    $sql = "INSERT INTO role_permissions (role_id, permission_id) VALUES (?, ?)";
    return $this->db->execute($sql, [$roleId, $permissionId]);
}


    // public function all()
    // {
    //     return $this->db->fetchAll("SELECT * FROM roles ORDER BY id ASC");
    // }

    // public function getPermission($roleId)
    // {
    //     $sql = "
    //         SELECT p.name
    //         FROM permissions p
    //         JOIN role_permissions rp ON rp.permission_id = p.id
    //         WHERE rp.role_id = ?
    //     ";

    //     return $this->db->fetchAll($sql, [$roleId], \PDO::FETCH_COLUMN);
    // }


    public function allRolesWithPermissions()
    {
        $roles = $this->all();

        foreach ($roles as &$role) {
            $role['permissions'] = $this->getPermission($role['id']);
        }

        return $roles;
    }
}

// namespace App\models;

// use App\Models\BaseModel;

// class RoleModel extends BaseModel
// {
//     public function getPermission($roleId)
//     {
//         $roleQuery = '
//         SELECT p.name
//         FROM permissions p
//         JOIN role_permissions rp ON rp.permission_id = p.id
//         WHERE rp.role_id = ?
//     ';

//         return $this->db->fetchAll($roleQuery, [$roleId], \PDO::FETCH_COLUMN);
//     }

// }
