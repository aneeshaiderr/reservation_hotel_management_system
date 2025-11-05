<?php

namespace App\Controllers\DashboardController;

use App\Core\Csrf;
use App\Models\Discount;
use App\Request\DiscountRequest;

// Feedback2-- Need proper indentation as per PSR-12 standards

class DiscountController extends BaseController
{
    protected $discount;

    public function __construct()
    {
        $this->discount = new Discount($this->db);
    }

    public function index()
    {
        $discounts = $this->discount->getAll();

        $this->render('dashboard/Discount/discount.view.php', [
            'discounts' => $discounts,
        ]);
    }

    public function create()
    {
        $this->render('dashboard/Discount/createDiscount.view.php');
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['csrf_token'] ?? '';
            // Feedback2-- Return user to the login page if token is invalid with proper message
            if (!Csrf::validateToken($token)) {
                $_SESSION['error'] = 'Token are expire. Please try again.';
                header('Location: '.BASE_URL.'/login');
                exit();
            }


            $validatedData = DiscountRequest::validate($_POST);

            //  Using validated and sanitized input data
            $data    = [
                'discount_type' => $validatedData['discount_type'],
                'discount_name' => $validatedData['discount_name'],
                'value' => $validatedData['value'],
                'start_date' => $validatedData['start_date'],
                'end_date' => $validatedData['end_date'],
                'status' => $validatedData['status'],
            ];

            //  Using prepared statements (handled in the Model)
            $this->discount->create($data);
        }

        //  Redirect back to the discount listing after successful creation
        redirect(url('/discount'));
    }

    public function edit($id = null)
    {
        if (! $id && isset($_GET['id'])) {
            $id = (int) $_GET['id'];
        }

        $discount = $this->discount->find($id);


        if (!$discount) {
            $_SESSION['error'] = 'Discount not found or invalid.';
            header('Location: '.BASE_URL.'/login');
            exit();
        }
        $this->render('dashboard/Discount/editDiscount.view.php', [
            'discount' => $discount,
        ]);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['csrf_token'] ?? '';
            // Feedback2-- Return user to the login page if token is invalid with proper message
            if (!Csrf::validateToken($token)) {
                $_SESSION['error'] = 'Token are expire. Please try again.';
                header('Location: '.BASE_URL.'/login');
                exit();
            }

            // Basic Validation
            $id = $_POST['id'] ?? null;
            if (! $id || empty($_POST['discount_type']) || empty($_POST['discount_name'])) {
                $_SESSION['error'] = 'Please fill all required fields.';
                redirect(url('/discount/edit?id='.$id));
                exit;
            }

            $data = [
                'discount_type' => $_POST['discount_type'] ,
                'discount_name' => $_POST['discount_name'],
                'value'         => $_POST['value'] ,
                'start_date'    => $_POST['start_date'] ,
                'end_date'      => $_POST['end_date'] ,
                'status'        => $_POST['status']
            ];

            // Feedback-- How are you handling the sql injections and unsafe queries?
            $this->discount->update($id, $data);
            redirect(url('/discount'));
        }
    }

    public function delete()
    {
        if (isset($_POST['id'])) {
            $id = (int) $_POST['id'];
            $this->discount->softdelete($id);
        }

        redirect(url('/discount'));
    }
}
