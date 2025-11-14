<?php


namespace App\Helpers;

use App\Models\RoleModel;
use App\Models\User;

class Permission
{
    protected $user;
    protected $roleModel;
    protected $roleId;
    protected $permissions = [];

    public function __construct()
    {
        $this->user = new User();
        $this->roleModel = new RoleModel();

        $this->roleId = $_SESSION['role_id'] ?? null;

        $this->loadPermissions();
    }

    private function loadPermissions()
    {

        if ($this->roleId == 1) {
            $this->permissions = ['ALL'];
            return;
        }


        $perms = $this->roleModel->getPermission($this->roleId);

        $this->permissions = array_column($perms, 'name');


        $_SESSION['permissions'] = $this->permissions;
    }

    public function can($permission)
    {

        if ($this->roleId == 1) {
            return true;
        }

        return in_array($permission, $this->permissions);
    }
}


?>


