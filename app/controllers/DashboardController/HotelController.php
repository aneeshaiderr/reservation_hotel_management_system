<?php


namespace App\Controllers\DashboardController;

use App\Core\Database;
use App\Models\Hotel;
// use App\Models\HotelCreate;
// use App\Models\HotelDetail;

class HotelController
{
    protected $hotelModel;
    protected $hotelCreateModel;
    protected $hotelDetailModel;

    public function __construct()
    {
        // Load configuration
        $config = require BASE_PATH . 'config.php';
        $db = new Database($config['database']);

        // Initialize models
        $this->hotelModel = new Hotel($db);
        // $this->hotelCreateModel = new HotelCreate($db);
        // $this->hotelDetailModel = new HotelDetail($db);
    }

    // ✅ Show all hotels
    public function index()
    {
        $hotels = $this->hotelModel->getAllHotels();
        return view('dashboard/hotel.view.php', ['hotels' => $hotels]);
    }

    // ✅ Show create hotel form + hotel list
    public function create()
    {
        // $hotels = $this->hotelCreateModel->getAll();
        $hotels = $this->hotelModel->getAll();
        return view('dashboard/hotelCreate.view.php', ['hotels' => $hotels]);
    }

    // ✅ Store new hotel
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'hotel_name' => $_POST['hotel_name'] ?? '',
                'address'    => $_POST['address'] ?? '',
                'contact_no' => $_POST['contact_no'] ?? ''
            ];

            $this->hotelModel->create($data);

            $_SESSION['success'] = "Hotel created successfully!";
            redirect(url('/hotel'));
        }
    }

    // ✅ Show hotel detail for edit
    public function show($id = null)
    {
        if (!$id && isset($_GET['id'])) {
            $id = (int) $_GET['id'];
        }

        $hotel = $this->hotelModel->find($id);

        if (!$hotel) {
            abort(404);
        }

        return view('dashboard/hotelDetail.view.php', [
            'hotel' => $hotel
        ]);
    }

    // ✅ Update existing hotel
    public function update()
    {
        $id = $_POST['id'];
        $this->hotelModel->update($id, $_POST);
        redirect(url('/hotel'));
        exit;
    }

    // ✅ Soft delete hotel
    public function delete()
    {
        session_start();

        if (!isset($_POST['id'])) {
            header('Location: ' . BASE_URL . '/hotel');
            exit;
        }

        $id = (int)$_POST['id'];
        $this->hotelModel->softDelete($id);

        header('Location: ' . BASE_URL . '/hotel');
        exit;
    }
}

// namespace App\Controllers\DashboardController;
// use App\Core\Database;
// use App\Models\Hotel;


// class HotelController
// {
//     protected $hotelModel;

//     public function __construct()
//     {
//         //  Load config
//         $config = require BASE_PATH . 'config.php';

//         //  Create DB instance
//         $db = new Database($config['database']);

//         //  Inject DB into Hotel model
//         $this->hotelModel = new Hotel($db);
//     }

//     //  Show all hotels
//     public function index()
//     {
//         $hotels = $this->hotelModel->getAllHotels();
//         return view('dashboard/hotel.view.php', ['hotels' => $hotels]);
//     }

  
//     //  Soft delete hotel
//    public function delete()
// {
//     session_start();

//     if (!isset($_POST['id'])) {
//         header('Location: ' . BASE_URL . '/hotel');
//         exit;
//     }

//     $id = (int)$_POST['id'];

//     // Soft delete hotel (set deleted_at timestamp)
//     $this->hotelModel->softDelete($id);

//     // Redirect back
//     header('Location: ' . BASE_URL . '/hotel');
//     exit;
// }
// }

  