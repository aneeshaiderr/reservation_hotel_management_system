<?php
namespace App\Controllers\DashboardController;
use App\Core\Database;
use App\Models\Hotel;


class HotelController
{
    protected $hotelModel;

    public function __construct()
    {
        //  Load config
        $config = require BASE_PATH . 'config.php';

        //  Create DB instance
        $db = new Database($config['database']);

        //  Inject DB into Hotel model
        $this->hotelModel = new Hotel($db);
    }

    //  Show all hotels
    public function index()
    {
        $hotels = $this->hotelModel->getAllHotels();
        return view('dashboard/hotel.view.php', ['hotels' => $hotels]);
    }

  
    //  Soft delete hotel
   public function delete()
{
    session_start();

    if (!isset($_POST['id'])) {
        header('Location: ' . BASE_URL . '/hotel');
        exit;
    }

    $id = (int)$_POST['id'];

    // Soft delete hotel (set deleted_at timestamp)
    $this->hotelModel->softDelete($id);

    // Redirect back
    header('Location: ' . BASE_URL . '/hotel');
    exit;
}
}

  