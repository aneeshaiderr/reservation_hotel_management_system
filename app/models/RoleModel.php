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

public function findRoleById(int $id): ?array
{
    $sql = "SELECT * FROM roles WHERE id = ?";
    return $this->db->fetch($sql, [$id]);
}
public function getPermission(int $roleId): array
{
    $sql = "
        SELECT p.id, p.name
        FROM permissions p
        INNER JOIN role_permissions rp ON rp.permission_id = p.id
        WHERE rp.role_id = ? AND p.deleted_at IS NULL
    ";

    return $this->db->fetchAll($sql, [$roleId]);
}


public function getAllRolesWithPermissions(): array
{
    $sql = "SELECT r.id AS role_id, r.name AS role_name, p.name AS permission_name
            FROM roles r
            LEFT JOIN role_permissions rp ON rp.role_id = r.id
            LEFT JOIN permissions p ON p.id = rp.permission_id AND p.deleted_at IS NULL
            ORDER BY r.id";

    $rows = $this->db->fetchAll($sql);

    $roles = [];

    foreach ($rows as $row) {
        $roleId = $row['role_id'];

        if (!isset($roles[$roleId])) {
            $roles[$roleId] = [
                'id' => $roleId,
                'name' => $row['role_name'],
                'permissions' => []
            ];
        }

        if (!empty($row['permission_name'])) {
            $roles[$roleId]['permissions'][] = $row['permission_name'];
        }
    }

    return array_values($roles);
}


public function softDeletePermissionByName(string $permissionName)
{
    $sql = "UPDATE permissions
            SET deleted_at = NOW()
            WHERE name = ? AND deleted_at IS NULL";
    $this->db->execute($sql, [$permissionName]);
}


// Fetch all roles
public function all(): array
{
    $sql = "SELECT * FROM roles ORDER BY id ASC";
    return $this->db->fetchAll($sql);
}
public function assignPermission(int $roleId, int $permissionId)
{
    // Avoid duplicate insert
    $sqlCheck = "SELECT COUNT(*) as count FROM role_permissions WHERE role_id = ? AND permission_id = ?";
    $exists = $this->db->fetch($sqlCheck, [$roleId, $permissionId]);

    if (!$exists || $exists['count'] == 0) {
        $sql = "INSERT INTO role_permissions (role_id, permission_id) VALUES (?, ?)";
        $this->db->execute($sql, [$roleId, $permissionId]);
    }
}

// Fetch all permissions
public function allPermissions(): array
{
    $sql = "SELECT * FROM permissions ORDER BY name ASC";
    return $this->db->fetchAll($sql);
}
// Find permission by name
public function findPermissionByName(string $name): ?array
{
    $sql = "SELECT * FROM permissions WHERE name = ?";
    return $this->db->fetch($sql, [$name]);
}

// Create new permission
public function createPermission(string $name): int
{
    $sql = "INSERT INTO permissions (name) VALUES (?)";
    $this->db->execute($sql, [$name]);
    return $this->db->getPdo()->lastInsertId();
}


// Fetch permissions assigned to a role

public function getAssignedPermissions(int $roleId): array
{
    $sql = "
        SELECT p.name
        FROM permissions p
        INNER JOIN role_permissions rp ON rp.permission_id = p.id
        WHERE rp.role_id = ? AND p.deleted_at IS NULL
    ";

    $permissions = $this->db->fetchColumn($sql, [$roleId]);

    return $permissions ?: [];
}

// Fetch all roles with assigned permissions
public function RolesWithPermissions(): array
{
    $roles = $this->all();

    foreach ($roles as &$role) {

        $role['permissions'] = $this->getAssignedPermissions($role['id']);
    }

    return $roles;
}

public function updatePermissions(int $roleId, array $permissions)
{

    $existingPermissions = $this->getPermission($roleId);
    $existingIds = array_column($existingPermissions, 'id');
    $existingNames = array_column($existingPermissions, 'name');


    $newPermissionIds = [];

    foreach ($permissions as $perm) {

        if (!is_numeric($perm)) {
            $permRecord = $this->findPermissionByName($perm);

            if (!$permRecord) {
                $permId = $this->createPermission($perm);
            } else {
                $permId = $permRecord['id'];
            }
        } else {
            $permId = $perm;
        }

        $newPermissionIds[] = $permId;
    }


    foreach ($newPermissionIds as $permId) {
        if (!in_array($permId, $existingIds)) {
            $sql = "INSERT INTO role_permissions (role_id, permission_id) VALUES (?, ?)";
            $this->db->execute($sql, [$roleId, $permId]);
        }
    }


    foreach ($existingIds as $permId) {
        if (!in_array($permId, $newPermissionIds)) {
            $sql = "DELETE FROM role_permissions WHERE role_id = ? AND permission_id = ?";
            $this->db->execute($sql, [$roleId, $permId]);
        }
    }

    return true;
}
public function updateRoleName(int $roleId, string $newName): bool
{
    $sql = "UPDATE roles SET name = ? WHERE id = ?";
    return $this->db->execute($sql, [$newName, $roleId]);
}
}
