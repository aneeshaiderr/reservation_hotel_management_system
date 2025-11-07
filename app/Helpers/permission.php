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

        $this->roleId = $_SESSION['role_id'];

        $this->loadPermissions();
    }

    private function loadPermissions()
    {

        $perms = $this->roleModel->getPermission($this->roleId);


        $this->permissions = array_column($perms, 'name');
    }

    public function can($permission)
    {
        return in_array($permission, $this->permissions);
    }

}

?>


