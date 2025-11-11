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
        $this->permissionModel = new PermissionModel();
         $permissionModel = new RolePermission();

    }

    public function indexx()
    {
        $roles = $this->roleModel->allRolesWithPermissions();

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
public function assignPermissionStore()
{
    $roleId = $_POST['role_id'] ?? null;
    $permissionsInput = $_POST['permissions'] ?? '';

    if (!$roleId) {
        die("Role is required.");
    }

    // Convert comma separated permissions into array
    $permissions = array_map('trim', explode(',', $permissionsInput));

    // Purani permissions remove
    $this->roleModel->deleteRolePermissions($roleId);

    // Assign new permissions
    foreach ($permissions as $permissionName) {

        // Permission ID get karo
        $permissionId = $this->permissionModel->getIdByName($permissionName);

        // Agar permission exist nahi karti → create new
        if (!$permissionId) {
            $permissionId = $this->permissionModel->create($permissionName);
        }

        // Ab assign kar do
        $this->roleModel->assignPermission($roleId, $permissionId);
    }

    $_SESSION['success'] = "Permissions Assigned Successfully!";
    redirect(url('/permission'));
}


}
