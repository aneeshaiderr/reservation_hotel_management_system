<?php
namespace App\Controllers\DashboardController;
use App\Models\hotel; 
use App\Models\EditReservation; 
use App\Core\Database;
use App\Models\Discount; 
class EditReservationController
{
protected $discount;    protected $reservation;
    protected  $hotelModel;
    public function __construct()
    {
        $config = require BASE_PATH . 'config.php';
        $db = new Database($config['database']);
        $this->reservation = new EditReservation($db); 
             $this->hotelModel = new Hotel($db);
    $this->discount = new Discount($db);
    }

    // Show room edit form
    public function show($id = null)
    {
        if (!$id && isset($_GET['id'])) {
            $id = (int) $_GET['id'];
            
        }
    
        $reservation = $this->reservation->find($id);

        if (!$reservation) {
            abort(404);
        }
    

     $hotels = $this->hotelModel->getAllHotels();
       $discounts = $this->discount->getAll();
        return view('dashboard/editReservation.view.php', [
            'reservation' => $reservation,
            'hotels'=>$hotels,
              'discounts' => $discounts 

        ]);

    }
    public function update()
{
    $id = $_POST['id'];
    $data = [
        'hotel_id' => $_POST['hotel_id'],
      
         'hotel_code' => $_POST['hotel_code'],
           'discount_id'=> $_POST['discount_id'],
        'check_in' => $_POST['check_in'],
        'check_out' => $_POST['check_out'],
        'status' => $_POST['status']
    ];

    $this->reservation->update($id, $data);

    header('Location: ' . url('/reservation'));
    exit;
}

}

