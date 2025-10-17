<?php

namespace App\Controllers\DashboardController;

use App\Core\Database;
use App\Models\HotelCreate;

class HotelCreateController
{
    protected $db;
    protected $hotel;

    public function __construct()
    {
        // Database connection
        $config = require BASE_PATH . 'config.php';
        $this->db = new Database($config['database']);

        // Initialize Hotel Model
        $this->hotel = new HotelCreate($this->db);
    }

    //  Show the create hotel form
    public function index()
    {
        // Optional: show all hotels on same page
        $hotels = $this->db->fetchAll("
            SELECT id, hotel_name, address, contact_no
            FROM hotels
            WHERE deleted_at IS NULL
            ORDER BY id DESC
        ");

        return view('dashboard/hotelCreate.view.php', [
            'hotels' => $hotels
        ]);
    }
    public function create()
    {
        //  Sirf form show karega
        return view('dashboard/hotelCreate.view.php');
    }
   
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'hotel_name' => $_POST['hotel_name'] ?? '',
                'address'    => $_POST['address'] ?? '',
                'contact_no' => $_POST['contact_no'] ?? ''
            ];

          
          

            // Save data using model
            $this->hotel->create($data);

            //  Redirect after success
            $_SESSION['success'] = "Hotel created successfully!";
            redirect(url('/hotel'));
        } 
        
    }
}
