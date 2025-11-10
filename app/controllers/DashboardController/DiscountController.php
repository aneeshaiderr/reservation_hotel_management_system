<?php

namespace App\Controllers\DashboardController;

use App\Core\Csrf;
use App\Helpers\Permission;
use App\Models\Discount;
use App\Models\RoleModel;
use App\Request\DiscountRequest;

// Feedback3-- Remove unnecessary comments from the controller keep the codebase clean

class DiscountController extends BaseController
{
    protected $discount;
    protected $userModel;
    protected $permission;


    protected $roleModel;
    public function __construct()
    {
        $this->discount = new Discount($this->db);
        $this->roleModel = new RoleModel($this->db);

        // Permission class ko proper objects do
        $this->permission = new Permission($this->userModel, $this->roleModel);
    }

    public function index()
    {
        // var_dump($_SESSION);
        // exit();
        $discounts = $this->discount->getAll();

        // var_dump($_SESSION['role_name']); // ye dekh lo
        // $roleName = $_SESSION['role_name'] ?? null;
        $this->render('dashboard/Discount/discount.view.php', [
            'discounts' => $discounts,
        ]);
    }

    public function create()
    {
        if (! $this->permission->can('Create_user')) {
            // $_SESSION['error'] = "You do not have permission to delete users.";
            // Feedback3-- Return to the previous page with error message user journey should not end at any point.
            die('You do not have permission to create discount.');
            // redirect(url('/user'));
            // exit;
        }
        $this->render('dashboard/Discount/createDiscount.view.php');
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['csrf_token'] ?? '';
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
        if (! $this->permission->can('edit_user')) {
            // $_SESSION['error'] = "You do not have permission to delete users.";
            abort(403);
            // redirect(url('/user'));
            // exit;
        }
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

            $this->discount->update($id, $data);
            redirect(url('/discount'));
        }
    }

    public function delete()
    {
        if (! $this->permission->can('delete_discount')) {
            abort(403);
            // $_SESSION['error'] = "You do not have permission to delete users.";
            // die("You do not have permission to delete discount.");
            // redirect(url('/user'));
            // exit;
        }
        if (isset($_POST['id'])) {
            $id = (int) $_POST['id'];
            $this->discount->softdelete($id);
        }

        redirect(url('/discount'));
    }
}
