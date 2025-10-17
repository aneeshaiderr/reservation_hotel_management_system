<?php
namespace App\Controllers\DashboardController;

use App\Core\Database;
use App\Models\Discount;

class DiscountController
{
    protected $discount;
protected $discountModel;
    public function __construct()
    {
      //  $this->discount = new Discount(new Database()); 
        $config = require BASE_PATH . 'config.php';
        $db = new Database($config);
        $this->discount = new Discount($db);
        $this->discountModel = new Discount($db);
    }

    public function index()
    {
        $discounts = $this->discount->getAll();
      
return view('dashboard/discount.view.php', [
            'discounts' => $discounts 
        ]);
       
    }
      public function delete()
    {
     

        if (!isset($_POST['id'])) {
            header('Location: ' . BASE_URL . '/discount');
            exit;
        }

        $id = (int)$_POST['id'];
        $this->discountModel->softDelete($id);

        header('Location: ' . BASE_URL . '/discount');
        exit;
    }
//     public function delete()
// {
//     $discountCode = $_POST['discount_code'] ?? null;

//     if (!$discountCode) {
//         die("Discount code missing!");
//     }

//     // Call model function to delete
//     $this->discount->deleteById($discountCode);

//     // Redirect after delete
//     header("Location: " . BASE_URL . "/discount");
//     exit;
// }
}
