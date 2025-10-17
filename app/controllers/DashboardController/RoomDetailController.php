<?php
namespace App\Controllers\DashboardController;

use App\Models\RoomDetail; // Model ka naam
use App\Core\Database;

class RoomDetailController
{
    protected $room;

    public function __construct()
    {
        $config = require BASE_PATH . 'config.php';
        $db = new Database($config['database']);
        $this->room = new RoomDetail($db); // Model instance
    }

    // Show room edit form
    public function index($id = null)
    {
        if (!$id && isset($_GET['id'])) {
            $id = (int) $_GET['id'];
        }

        $room = $this->room->find($id);

        if (!$room) {
            abort(404);
        }
   
        return view('dashboard/roomDetail.view.php', [
            'room' => $room
        ]);

    }


    public function update()
    {
         
        $id = (int) $_POST['id'];
        
        $this->room->update($id, $_POST); 

        redirect(url('/rooms')); 
        exit;
    }
}
// namespace App\Controllers\DashboardController;
// use App\Models\Rooms;
// use App\Models\RoomDetail;
// use App\Core\Database;

// class RoomDetailController
// {
//     protected $room;

//     public function __construct(){
    // {
    //     $config = require BASE_PATH . 'config.php';
    //     $db = new Database($config['database']);
    //     $this->room = new RoomDetail($db);
    // }
// $config = require BASE_PATH . 'config.php';
//         $db = new Database($config['database']);
//         $this->room = new Rooms($db); // Rooms table ke liye model
//     }

    // Show room edit form
    // public function index($id = null)
    // {
    //     if (!$id && isset($_GET['id'])) {
    //         $id = (int) $_GET['id'];
    //     }

    //     $room = $this->room->find($id); 

    //     if (!$room) {
    //         abort(404);
    //     }

    //     return view('dashboard/roomDetail.view.php', [
    //         'room' => $room
    //     ]);
    // }
    /**
     * Show room details
     */
    // public function index($id = null)
    // {
    //     if (!$id && isset($_GET['id'])) {
    //         $id = (int) $_GET['id']; 
    //     }

    //     $room = $this->room->find($id); 

    //     if (!$room) { 
    //         abort(404); 
    //     }

    //     return view('dashboard/roomDetail.view.php', [
    //         'room' => $room  
    //     ]);
    // }

    /**
     * Update room details
     */
//     public function update()
//     {
//         $id = (int) $_POST['id'];
//         $this->room->update($id, $_POST);
//         redirect(url('/rooms')); 
//         exit;
//     }
// }

