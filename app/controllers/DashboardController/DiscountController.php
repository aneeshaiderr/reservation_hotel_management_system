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
      $content = view('dashboard/Discount/discount.view.php', [
            'discounts' => $discounts
        ]);
         return view('Layouts/dashboard.layout.php', ['content' => $content]);
    }


    public function create()
    {
        
       $content = view('dashboard/Discount/createDiscount.view.php');
         return view('Layouts/dashboard.layout.php', ['content' => $content]);
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

       $content = view('dashboard/Discount/editDiscount.view.php', [
            'discount' => $discount
        ]);
         return view('Layouts/dashboard.layout.php', ['content' => $content]);
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
                'status'        => $_POST['status'] ?? ''
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

