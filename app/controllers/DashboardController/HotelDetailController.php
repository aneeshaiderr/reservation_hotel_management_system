<?php
namespace App\Controllers\DashboardController;

use App\Models\HotelDetail; 
use App\Core\Database;

class HotelDetailController
{
    protected $hotel;

    public function __construct()
    {
        $config = require BASE_PATH . 'config.php';
        $db = new Database($config['database']);
        $this->hotel = new HotelDetail($db); 
    }

    // Show room edit form
    public function show($id = null)
    {
        if (!$id && isset($_GET['id'])) {
            $id = (int) $_GET['id'];
        }

        $hotel = $this->hotel->find($id);

        if (!$hotel) {
            abort(404);
        }
   
        return view('dashboard/hotelDetail.view.php', [
            'hotel' => $hotel
        ]);

    }
   public function update()
    {
        $id = $_POST['id'];
        $this->hotel->update($id, $_POST);
        redirect(url('/hotel')); 
        exit;
    }
}
