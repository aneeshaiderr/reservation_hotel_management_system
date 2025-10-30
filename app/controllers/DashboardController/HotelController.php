<?php


namespace App\Controllers\DashboardController;

use App\Core\Database;
use App\Models\Hotel;
use App\Middleware\ExceptionHandler;

// Feedback-- Need proper indentation as per PSR-12 standards
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
        // Feedback-- This view function in the base controller should be used to render the layout while the function
        // Call here should pass data to the view.

        // Feedback-- Layout should accept the view name and include or require the view passed here current approach incorrect
  
        $hotels = $this->hotelModel->getAllHotels();
         $this-> view('dashboard/Hotel/hotel.view.php', ['hotels' => $hotels]);
          return view('Layouts/dashboard.layout.php');
    }

    //  Show create hotel 
    public function create()
    {
        // Feedback-- This view function in the base controller should be used to render the layout while the function
        // Call here should pass data to the view.

        // Feedback-- Layout should accept the view name and include or require the view passed here current approach incorrect
        $hotels = $this->hotelModel->getAll();
      $this-> view('dashboard/Hotel/hotelCreate.view.php', ['hotels' => $hotels]);
        return view('Layouts/dashboard.layout.php');
    }

    //  Store new hotel
    public function store()
    {
        // Feedback-- Did you use Request Class?
        // Feedback-- Did you use concept of CSRF tokens in this form submission?
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
            
            // Feedback-- Besids ExceptionHandler, did you use any other error handling method for human readable error messages?S
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

        // Feedback-- This view function in the base controller should be used to render the layout while the function
        // Call here should pass data to the view.

        // Feedback-- Layout should accept the view name and include or require the view passed here current approach incorrect
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
