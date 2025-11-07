<?php

// namespace App\Controllers\DashboardController;

// use App\Controllers\DashboardController\BaseController;
// use App\Models\RoleModel;
// use App\Models\RolePermission;

// class RoleController extends BaseController
// {
// public function indexx()
// {
//   $roleModel = new RoleModel();
// $roles = $roleModel->allRolesWithPermissions();

//     // Add permissions for each role
//     foreach ($roles as &$role) {
//         $role['permissions'] = $roleModel->getPermission($role['id']);
//     }

//     $this->render("dashboard/User/permission.view.php", [
//         "roles" => $roles
//     ]);
// }

// }
