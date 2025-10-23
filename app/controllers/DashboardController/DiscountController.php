<?php
namespace App\Controllers\DashboardController;

use App\Core\Database;
use App\Models\Discount;


class DiscountController
{
    protected $discount;

    public function __construct()
    {
        $config = require BASE_PATH . 'config.php';
        $db = new Database($config['database']);
        $this->discount = new Discount($db);
        
    }

   
    public function index()
    {
        $discounts = $this->discount->getAll();
        return view('dashboard/discount.view.php', [
            'discounts' => $discounts
        ]);
    }


    public function create()
    {
        return view('dashboard/createDiscount.view.php');
    }

  
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'discount_type' => $_POST['discount_type'] ?? '',
                'discount_name' => $_POST['discount_name'] ?? '',
                'value'         => $_POST['value'] ?? 0,
                'start_date'    => $_POST['start_date'] ?? '',
                'end_date'      => $_POST['end_date'] ?? '',
                'status'        => $_POST['status'] ?? 'inactive'
            ];

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

        return view('dashboard/editDiscount.view.php', [
            'discount' => $discount
        ]);
    }

  
       public function update()
    {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
                'status'        => $_POST['status'] ?? 'inactive'
            ];

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

// class DiscountController
// {
//     protected $discount;
// protected $discountModel;
//     public function __construct()
//     {
//       //  $this->discount = new Discount(new Database()); 
//         $config = require BASE_PATH . 'config.php';
//         $db = new Database($config);
//         $this->discount = new Discount($db);
//         $this->discountModel = new Discount($db);
//     }

//     public function index()
//     {
//         $discounts = $this->discount->getAll();
      
// return view('dashboard/discount.view.php', [
//             'discounts' => $discounts 
//         ]);
       
//     }
//       public function delete()
//     {
     

//         if (!isset($_POST['id'])) {
//             header('Location: ' . BASE_URL . '/discount');
//             exit;
//         }

//         $id = (int)$_POST['id'];
//         $this->discountModel->softDelete($id);

//         header('Location: ' . BASE_URL . '/discount');
//         exit;
//     }

// }
