<?php

// namespace App\Models;

// use App\Models\BaseModel;
// use App\Core\Database;

// class RoleModel extends BaseModel
// {
//     public function __construct()
//     {
//         $config = require BASE_PATH . '/config.php';
//         $this->db = new Database($config['database']);
//     }

//     // ✅ Your existing function
//     public function all()
//     {
//         return $this->db->fetchAll("SELECT * FROM roles ORDER BY id ASC");
//     }

//     // ✅ Your existing function
//     public function getPermission($roleId)
//     {
//         $sql = "
//             SELECT p.name
//             FROM permissions p
//             JOIN role_permissions rp ON rp.permission_id = p.id
//             WHERE rp.role_id = ?
//         ";

//         return $this->db->fetchAll($sql, [$roleId], \PDO::FETCH_COLUMN);
//     }

//     // ✅ New function to load roles + permissions together
//     public function allRolesWithPermissions()
//     {
//         $roles = $this->all();

//         foreach ($roles as &$role) {
//             $role['permissions'] = $this->getPermission($role['id']);
//         }

//         return $roles;
//     }
// }

namespace App\models;

use App\Models\BaseModel;

class RoleModel extends BaseModel
{
    public function getPermission($roleId)
    {
        $roleQuery = '
        SELECT p.name
        FROM permissions p
        JOIN role_permissions rp ON rp.permission_id = p.id
        WHERE rp.role_id = ?
    ';

        return $this->db->fetchAll($roleQuery, [$roleId], \PDO::FETCH_COLUMN);
    }

}
