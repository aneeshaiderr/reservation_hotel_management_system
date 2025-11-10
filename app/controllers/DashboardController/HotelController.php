<?php

namespace App\Controllers\DashboardController;

use App\Core\Csrf;
use App\Middleware\ExceptionHandler;
use App\Models\Hotel;
use App\Request\HotelRequest;

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
        $hotels = $this->hotelModel->getAllHotels();
        $this->render('dashboard/Hotel/hotel.view.php', ['hotels' => $hotels]);
    }

    //  Show create hotel
    public function create()
    {
        $hotels = $this->hotelModel->getAll();
        $this->render('dashboard/Hotel/hotelCreate.view.php', ['hotels' => $hotels]);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $validated = HotelRequest::validate($_POST);

            try {
                $this->hotelModel->create($validated);
                $_SESSION['success'] = 'Hotel created successfully!';
            } catch (\PDOException $e) {
                if ($e->getCode() == 23000) {
                    // Feedback3-- Would the exception always be for hotel already exists? in this cases
                    $_SESSION['error'] = 'Hotel already exists!';
                    redirect($_SERVER['HTTP_REFERER']);
                }

                $_SESSION['error'] = 'Something went wrong!';
                redirect($_SERVER['HTTP_REFERER']);
            }

            redirect(url('/hotel'));
        }
    }
    // Show hotel detail for edit
    public function show($id = null)
    {
        if (! $id && isset($_GET['id'])) {
            $id = (int) $_GET['id'];
        }

        $hotel = $this->hotelModel->find($id);

        if (!$hotel) {
            $_SESSION['error'] = 'Hotel details not found or invalid.';
            header('Location: '.BASE_URL.'/login');
            exit();
        }



        $this->render('dashboard/Hotel/hotelDetail.view.php', [
            'hotel' => $hotel,
        ]);
    }

    // Update existing hotel
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['csrf_token'] ?? '';
            if (!Csrf::validateToken($token)) {
                $_SESSION['error'] = 'Token are expire. Please try again.';
                header('Location: '.BASE_URL.'/login');
                exit();
            }

        }
        try {
            $id = $_POST['id'];
            $this->hotelModel->update($id, $_POST);
            $_SESSION['success'] = 'Hotel update successfully!';
            redirect(url('/hotel'));
        } catch (\PDOException $e) {
            ExceptionHandler::handle($e, $_SERVER['HTTP_REFERER']);
        }


    }

    // Soft delete hotel
    public function delete()
    {
        session_start();

        if (! isset($_POST['id'])) {
            header('Location: '.BASE_URL.'/hotel');
            exit;
        }

        $id = (int) $_POST['id'];
        $this->hotelModel->softDelete($id);

        header('Location: '.BASE_URL.'/hotel');
        exit;
    }
}
