<?php
namespace App\Controllers\DashboardController;

use App\Models\EditDiscount;
use App\Core\Database;

class EditDiscountController
{
    protected $discount;

    public function __construct()
    {
        $config = require BASE_PATH . 'config.php';
        $db = new Database($config['database']);
        $this->discount = new EditDiscount($db);
    }

    // Show edit discount form
    public function show($id = null)
    {
        if (!$id && isset($_GET['id'])) {
            $id = (int) $_GET['id'];
        }

        $discount = $this->discount->find($id);

        if (!$discount) {
            abort(404);
        }

        return view('dashboard/editDiscount.view.php', [
            'discount' => $discount
        ]);
    }

    // Handle form submission for updating discount
    public function update()
    {
        $id = $_POST['id'];
        $data = [
            'discount_type' => $_POST['discount_type'],
            'discount_name' =>$_POST['discount_name'],
            'value' => $_POST['value'],
            'start_date' => $_POST['start_date'],
            'end_date' => $_POST['end_date'],
            'status' => $_POST['status']
        ];

        $this->discount->update($id, $data);

        header('Location: ' . url('/discount'));
        exit;
    }
}
