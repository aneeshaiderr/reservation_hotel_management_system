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
