<?php

namespace App\Controllers\DashboardController;

use App\Core\Database;
use App\Models\CreateDiscount;

class DiscountCreateController
{
    protected $db;
    protected $discount;

    public function __construct()
    {
        // Database connection
        $config = require BASE_PATH . 'config.php';
        $this->db = new Database($config['database']);

        // Initialize Model
        $this->discount = new CreateDiscount($this->db);
    }

    // ✅ Show the create discount form
    public function index()
    {
        $hotels = $this->db->fetchAll("SELECT id, discount_type,discount_name,value,status FROM discounts", []);


        
        return view('dashboard/createDiscount.view.php');
    }

    // ✅ Handle form submission (insert discount)
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'discount_type' => $_POST['discount_type'],
                'discount_name'          =>  $_POST['discount_name'],        
                'value'         => $_POST['value'],
                'start_date'    => $_POST['start_date'],
                'end_date'      => $_POST['end_date'],
                'status'        => $_POST['status']
            ];

            $this->discount->create($data);

            // Redirect back to discount list page
            redirect(url('/discount'));
        } else {
            redirect(url('/discount/create'));
        }
    }
}
