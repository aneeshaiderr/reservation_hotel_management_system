<?php


namespace App\Controllers\DashboardController;

use App\Models\Details;
// use App\Views\Dashboard\Models\User;
use App\Core\Database;


class DetailsController
{
    protected $user;

    public function __construct()
    {
        $config = require BASE_PATH . 'config.php';
        $db = new Database($config);
        $this->user = new Details($db);
    }
    
    public function index($id = null)
    {
        if (!$id && isset($_GET['id'])) {
            $id = $_GET['id']; 
        }
    
        $user = $this->user->find($id); 
    
        if (!$user || $user === false) { 
            abort(404); 
        }
        return view('dashboard/details.view.php', [
            'user' => $user  
        ]);
    }

    // Update User
    public function update()
    {
        $id = $_POST['id'];
        $this->user->update($id, $_POST);
        redirect(url('/user')); 
        exit;
    }
}

// namespace App\Controllers;


// namespace App\Controllers\DashboardController;
// use App\Core\Database;

// class DetailsController
// {
//     // Show user details form
//    public function show()
//     {
//         $config = require base_path('config.php');
//         $db = new Database($config['database']);

//         if (!isset($_GET['id'])) die("User ID not provided.");
//         $id = $_GET['id'];

//         $user = $db->query("SELECT * FROM users WHERE id = :id", ['id' => $id])->find();
//         if (!$user) die("User not found.");

//         require base_path("app/views/dashboard/models/details.php");
//     }

//     public function update()
//     {
//         $config = require base_path('config.php');
//         $db = new Database($config['database']);

//         if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['_method'] ?? '') === 'PATCH') {
//             $id = $_POST['id'] ?? null;
//             if (!$id) ;
//                 // die("Invalid request: ID is missing.");

//             $db->query("UPDATE users 
//                         SET first_name = :first_name,
//                             last_name = :last_name,
//                             email = :email,
//                             contact_no = :contact_no,
//                             address = :address,
//                             status = :status,
//                             updated_at = NOW()
//                         WHERE id = :id", [
//                 'id' => $id,
//                 'first_name' => $_POST['first_name'],
//                 'last_name' => $_POST['last_name'],
//                 'email' => $_POST['email'],
//                 'contact_no' => $_POST['contact_no'],
//                 'address' => $_POST['address'],
//                 'status' => $_POST['status']
//             ]);
//             // Redirect back to details page
//             header("Location: /details?id=" . $id);
//             exit;
//         }

//         // die("Invalid request.");
//     }
// }
