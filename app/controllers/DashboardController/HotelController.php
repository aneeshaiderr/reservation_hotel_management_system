<?php


namespace App\Controllers\DashboardController;

use App\Core\Database;
use App\Models\Hotel;
use App\Middleware\ExceptionHandler;

class HotelController extends BaseController
{
    protected $hotelModel;
    protected $hotelCreateModel;
    protected $hotelDetailModel;

    public function __construct()
    {
       
      

        // Initialize models
        $this->hotelModel = new Hotel($this->db);
       
    }

    //  Show all hotels
    public function index()
    {
  
        $hotels = $this->hotelModel->getAllHotels();
         $this-> view('dashboard/Hotel/hotel.view.php', ['hotels' => $hotels]);
          return view('Layouts/dashboard.layout.php');
    }

    //  Show create hotel 
    public function create()
    {
        $hotels = $this->hotelModel->getAll();
      $this-> view('dashboard/Hotel/hotelCreate.view.php', ['hotels' => $hotels]);
        return view('Layouts/dashboard.layout.php');
    }

    //  Store new hotel
    public function store()
    {
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $hotel_name = $_POST['hotel_name'] ?? '';
        $address    = $_POST['address'] ?? '';
        $contact_no = $_POST['contact_no'] ?? '';

        if (!$hotel_name || !$address || !$contact_no) {
          
            redirect(url('/hotel'));
        }
            $data = [
                'hotel_name' => $_POST['hotel_name'] ?? '',
                'address'    => $_POST['address'] ?? '',
                'contact_no' => $_POST['contact_no'] ?? ''
            ];
             try {
            $this->hotelModel->create($data);
            $_SESSION['success'] = "Hotel created successfully!";
            redirect(url('/hotel'));
        } catch (\PDOException $e) {
            
            ExceptionHandler::handle($e, $_SERVER['HTTP_REFERER']);
        }
   
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

       $this->view('dashboard/Hotel/hotelDetail.view.php', [
            'hotel' => $hotel
        ]);
         return view('Layouts/dashboard.layout.php');
    }

    // Update existing hotel
    public function update()
    {
      
      
        try {
              $id = $_POST['id'];
           $this->hotelModel->update($id, $_POST);
            $_SESSION['success'] = "Hotel update successfully!";
            redirect(url('/hotel'));
        } catch (\PDOException $e) {
            
            ExceptionHandler::handle($e, $_SERVER['HTTP_REFERER']);
        }
   
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
