<?php

namespace App\Controllers\DashboardController;

use App\Controllers\DashboardController\BaseController;
use App\Models\RoleModel;
use App\Models\PermissionModel;
use App\Models\RolePermission;

class RoleController extends BaseController
{
    protected $roleModel;
    protected $permissionModel;

    public function __construct()
    {
       // BaseController ka DB initialize hota rahe

        $this->roleModel = new RoleModel();
            $roleModel = new RoleModel();
        $this->permissionModel = new PermissionModel();

$roles = $roleModel->RolesWithPermissions();

    }

    public function index()
    {
        $roles = $this->roleModel->RolesWithPermissions();

        $this->render("dashboard/User/permission.view.php", [
            "roles" => $roles
        ]);
    }

    public function assignPermissionForm()
    {
        $roles = $this->roleModel->all();
        $permissions = $this->permissionModel->all();

        $this->render('dashboard/User/createPermission.view.php', [
            'roles'        => $roles,
            'permissions'  => $permissions
        ]);
    }
    public function edit()
{
    $id = $_GET['id'] ?? null;
    if (!$id) {
        exit('No role ID provided');
    }
    $roleModel = new RoleModel();
    $role = $roleModel->findRoleById($id);
    $permissions = $roleModel->allPermissions();
    $assignedPermissions = $roleModel->getPermission($id); // already assigned

    $this->render('dashboard/User/editPermission.view.php', [
        'role' => $role,
        'permissions' => $permissions,
        'assignedPermissions' => $assignedPermissions
    ]);
}


public function update()
{
    $roleId = $_POST['role_id'] ?? null;
    $roleName = $_POST['role_name'] ?? null;
    $permissionsInput = $_POST['permissions'] ?? [];

    if (!$roleId) {
        exit('Role ID is required');
    }

    // Ensure array format
    $permissions = is_array($permissionsInput)
        ? $permissionsInput
        : array_map('trim', explode(',', $permissionsInput));

    if (!empty($roleName)) {
        $this->roleModel->updateRoleName($roleId, trim($roleName));
    }
     if (!empty($permissions)) {
        $this->roleModel->updatePermissions($roleId, $permissions);
    }
    $this->roleModel->updatePermissions($roleId, $permissions);

    $_SESSION['success'] = 'Permissions updated successfully!';
    header('Location: ' . url('/permission'));
    exit();
}

public function assignPermissionStore()
{
    $roleId = $_POST['role_id'] ?? null;
    $permissions = $_POST['permissions'] ?? [];

    if (!$roleId) {
        die("Role is required.");
    }

    $existingPermissions = $this->roleModel->getPermission($roleId);
    $existingPermissionIds = array_column($existingPermissions, 'id');

    foreach ($permissions as $permissionId) {
        if (!in_array($permissionId, $existingPermissionIds)) {
            $this->roleModel->assignPermission($roleId, $permissionId);
        }
    }

    $_SESSION['success'] = "Permissions Assigned Successfully!";
    redirect(url('/permission'));
}


public function storeRolePermissions()
{


    $roleId = $_POST['role_id'] ?? null;
    $permissionsInput = $_POST['permissions'] ?? '';

    if (!$roleId || trim($permissionsInput) === '') {
        $_SESSION['errors'] = ["Please select a role and enter at least one permission."];
        header('Location: ' . url('/permission'));
        exit;
    }


    $permissions = array_map('trim', explode(',', $permissionsInput));


    $existingPermissions = $this->roleModel->getPermission($roleId);
    $existingPermissionNames = array_column($existingPermissions, 'name');

    foreach ($permissions as $permName) {
        if (in_array($permName, $existingPermissionNames)) {
            continue;
        }


        $perm = $this->roleModel->findPermissionByName($permName);

        if (!$perm) {
            $permId = $this->roleModel->createPermission($permName);
        } else {
            $permId = $perm['id'];
        }

        $this->roleModel->assignPermission($roleId, $permId);
    }

    $_SESSION['success'] = "Permissions assigned successfully!";
    header('Location: ' . url('/permission'));
    exit;
}

public function deletePermission()
{

    $permissionName = $_POST['name'] ?? null;

if (!$permissionName) {
    exit('Permission name is required');
}

$roleModel = new RoleModel();
$roleModel->softDeletePermissionByName($permissionName);

$_SESSION['success'] = "Permission removed successfully!";
header('Location: ' . url('/permission'));
exit();

}




}
