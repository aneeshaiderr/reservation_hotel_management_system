<?php


namespace App\Controllers\DashboardController;

use App\Core\Database;
use App\Models\Hotel;


class HotelController
{
    protected $hotelModel;
    protected $hotelCreateModel;
    protected $hotelDetailModel;

    public function __construct()
    {
       
        $config = require BASE_PATH . 'config.php';
        $db = new Database($config['database']);

        // Initialize models
        $this->hotelModel = new Hotel($db);
       
    }

    //  Show all hotels
    public function index()
    {
  
        $hotels = $this->hotelModel->getAllHotels();
         $content = view('dashboard/Hotel/hotel.view.php', ['hotels' => $hotels]);
          return view('Layouts/dashboard.layout.php', ['content' => $content]);
    }

    //  Show create hotel 
    public function create()
    {
        $hotels = $this->hotelModel->getAll();
      $content = view('dashboard/Hotel/hotelCreate.view.php', ['hotels' => $hotels]);
        return view('Layouts/dashboard.layout.php', ['content' => $content]);
    }

    //  Store new hotel
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

    // Show hotel detail for edit
    public function show($id = null)
    {
        if (!$id && isset($_GET['id'])) {
            $id = (int) $_GET['id'];
        }

        $hotel = $this->hotelModel->find($id);

        if (!$hotel) {
            abort(404);
        }

       $content = view('dashboard/Hotel/hotelDetail.view.php', [
            'hotel' => $hotel
        ]);
         return view('Layouts/dashboard.layout.php', ['content' => $content]);
    }

    // Update existing hotel
    public function update()
    {
        $id = $_POST['id'];
        $this->hotelModel->update($id, $_POST);
        redirect(url('/hotel'));
        exit;
    }

    // Soft delete hotel
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
