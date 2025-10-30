<?php
namespace App\Controllers\DashboardController;

use App\Core\Database;
use App\Models\Discount;

// Feedback-- Need proper indentation as per PSR-12 standards

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
    
        // Feedback-- This view function in the base controller should be used to render the layout while the function
        // Call here should pass data to the view.

        // Feedback-- Layout should accept the view name and include or require the view passed here current approach incorrect

      $this->view('dashboard/Discount/discount.view.php', [
            'discounts' => $discounts
        ]);
         return view('Layouts/dashboard.layout.php');
    }


    public function create()
    {

        // Feedback-- This view function in the base controller should be used to render the layout while the function
        // Call here should pass data to the view.

        // Feedback-- Layout should accept the view name and include or require the view passed here current approach incorrect
        
      $this->view('dashboard/Discount/createDiscount.view.php');
         return view('Layouts/dashboard.layout.php');
    }

    public function store()
    {
     
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Feedback-- Did you use Request Class and Concept of Request Validation?
        // Feedback-- Did you use concept of CSRF tokens in this form submission?

        $discount_type = $_POST['discount_type'] ?? '';
        $discount_name = $_POST['discount_name'] ?? '';

        if (!$discount_type || !$discount_name) {
            redirect(url('/discount'));
        }

            $data = [
                'discount_type' => $_POST['discount_type'] ?? '',
                'discount_name' => $_POST['discount_name'] ?? '',
                'value'         => $_POST['value'] ?? 0,
                'start_date'    => $_POST['start_date'] ?? '',
                'end_date'      => $_POST['end_date'] ?? '',
                'status'        => $_POST['status'] ?? 'inactive'
            ];

            // Feedback-- How are you handling the sql injections and unsafe queries?

            $this->discount->create($data);
        }

        redirect(url('/discount'));
    }

    public function edit($id = null)
    {
        if (!$id && isset($_GET['id'])) {
            $id = (int)$_GET['id'];
        }

        $discount = $this->discount->find($id);

        if (!$discount) {
            abort(404);
        }

        
        // Feedback-- This view function in the base controller should be used to render the layout while the function
        // Call here should pass data to the view.

        // Feedback-- Layout should accept the view name and include or require the view passed here current approach incorrect
       $this-> view('dashboard/Discount/editDiscount.view.php', [
            'discount' => $discount
        ]);
         return view('Layouts/dashboard.layout.php');
    }

  
       public function update()
    {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Feedback-- Did you use Request Class and Concept of Request Validation on all required fields?
            // Feedback-- Did you use concept of CSRF tokens in this form submission?

            $id = $_POST['id'] ?? null;
            if (!$id) {
                redirect(url('/discount'));
            }

            $data = [
                'discount_type' => $_POST['discount_type'] ?? '',
                'discount_name' => $_POST['discount_name'] ?? '',
                'value'         => $_POST['value'] ?? 0,
                'start_date'    => $_POST['start_date'] ?? '',
                'end_date'      => $_POST['end_date'] ?? '',
                'status'        => $_POST['status'] ?? ''
            ];

            // Feedback-- How are you handling the sql injections and unsafe queries?
            $this->discount->update($id, $data);
        }

        redirect(url('/discount'));
    }

   
    public function delete()
    {
        if (isset($_POST['id'])) {
            $id = (int)$_POST['id'];
            $this->discount->softdelete($id);
        }

        redirect(url('/discount'));
    }
}

