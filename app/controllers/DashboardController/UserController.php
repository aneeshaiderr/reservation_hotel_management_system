<?php

namespace App\Controllers\DashboardController;

use App\Models\User;
use App\Core\Database;

// class UserController
// {
//     protected $model;

// public function __construct()
// {
//     $config = require BASE_PATH . 'config.php';
//         $db = new Database($config['database']);
//         $this->model = new User($db);   
// }

//     public function index()
//     {
//          if (!isset($_SESSION['user_id'])) {
//         redirect(url('/login'));
//         exit;
//     }

//     $userId = $_SESSION['user_id'];

//     // sirf ek user ka record nikalna
//     $user = $this->model->getUserById($userId);
//         $users = $this->model->getAllUsers();

//         return view('dashboard/user.view.php', [
//             'users' => $users
//         ]);
//     }
//       // Show Create Form
//     public function create()
//     {
//         return view('dashboard/create.view.php');
//     }

//     // Store New User
//     public function store()
//     {
//         $data = [
//             'first_name' => $_POST['first_name'],
//             'last_name'  => $_POST['last_name'],
//             'email'      => $_POST['email'],
//             'contact_no' => $_POST['contact_no'],
//             'address'    => $_POST['address'],
//             'status'     => $_POST['status'],
//             'role_id'    => $_POST['role_id'],
//         ];

//         $this->model->create($data);

//         redirect(url('/user'));
//         exit;
//     }
//     // Delete user (soft + hard delete)
//     public function destroy()
//     {
//         $id = $_POST['id'] ?? null;

//         if ($id) {
//             // Step 1: Soft delete (set deleted_at)
//             $this->model->softDelete($id);

//             // Step 2: Hard delete (remove from DB)
//             // $this->model->hardDelete($id);
//         }

//         redirect(url('/user'));
//         exit;
//     }
// }

namespace App\Controllers\DashboardController;

use App\Models\User;
use App\Core\Database;

class UserController
{
    protected $model;

    public function __construct()
    {
        $config = require BASE_PATH . 'config.php';
        $db = new Database($config['database']);
        $this->model = new User($db);   
    }

    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            redirect(url('/login'));
            exit;
        }

        $roleId = $_SESSION['role_id'];
        $userId = $_SESSION['user_id'];

        if ($roleId == 1) {
            // superadmin -> sab ka data
            $users = $this->model->getAllUsers();
            return view('dashboard/superAdmin.view.php', [
                'users' => $users
            ]);
            
        } else {
            // normal user/staff/guest -> sirf apni detail
            $user = $this->model->findUserById($userId);
            return view('dashboard/user.view.php', [
                'user' => $user
            ]);
        }
    }
}


// class UserController
// {
//     public function index()
//     {
//         if (!isset($_SESSION['user_id'])) {
//             redirect(url('/login'));
//             exit;
//         }

//         $roleId = $_SESSION['role_id'];

//         if ($roleId == 1) {
//             // superadmin -> sab kuch dikhayega
//             return view('dashboard/superAdmin.view.php');
//         } else {
//             // normal user / staff / guest -> sirf apna dashboard
//             return view('dashboard/user.view.php');
//         }
//     }
// }

// class UserController
// {
//     protected $model;

//     public function __construct()
//     {
//         $this->model = new User();
//     }

//     // Show only logged-in user's profile
//     public function index()
//     {
//         if (!isset($_SESSION['user_id'])) {
//             redirect(url('/login'));
//             exit;
//         }

//         $userId = $_SESSION['user_id'];
//         $user = $this->model->getUserById($userId);

//         return view('dashboard/user.view.php', [
//             'user' => $user
//         ]);
//     }

//     // (Optional) agar tum admin ko allow karna chahte ho sab users dikhane ka
//     public function all()
//     {
//         if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1) { 
//             // 1 = super admin for example
//             redirect(url('/unauthorized'));
//             exit;
//         }

//         $users = $this->model->getAllUsers();

//         return view('dashboard/users.view.php', [
//             'users' => $users
//         ]);
//     }
// }
