<?php
namespace App\Models;

use App\Core\Database;
use App\Middleware\AuthMiddleware;


class Reservation
{
    protected $db;

    public function __construct(Database $db)
    {
        
        $this->db = $db;
        $auth = new AuthMiddleware();
       $auth->checkAccess();
    }

   
         public function getAllReservations($userId = null, $roleId = null)
    {
        $query = "
            SELECT 
                r.id,
                r.hotel_code,
                r.room_id,
                r.discount_id,
                r.check_in,
                r.check_out,
                r.status,
                u.user_email AS user_email,
                h.hotel_name AS hotel_name,
                d.discount_name AS discount_name
            FROM reservations r
            LEFT JOIN users u ON r.user_id = u.id
            LEFT JOIN hotels h ON r.hotel_id = h.id
            LEFT JOIN discounts d ON r.discount_id = d.id
            WHERE r.deleted_at IS NULL
        ";

        $params = [];

        //  Restrict for normal users (role_id = 4)
        if ((int)$roleId === 4 && $userId !== null) {
            $query .= " AND r.user_id = ?";
            $params[] = (int)$userId;
        }

        $query .= " ORDER BY r.id ";

        return $this->db->fetchAll($query, $params);
       // Delete reservation if form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'], $_POST['hotel_code'])) {
    $hotelCode = $_POST['hotel_code'];
    $reservation = $reservationModel->findByHotelCode($hotelCode);

    if (!$reservation) {
        $error = "Reservation not found!";
    } else {
        // Permission check
        if($roleId == 4 && $reservation['user_id'] != $userId){
            $error = "Unauthorized: You cannot delete this reservation!";
        } else {
            $reservationModel->deleteByHotelCode($hotelCode);
            $success = "Reservation deleted successfully!";
        }
    
    }

    
}

// Fetch reservations for display
if($roleId == 4){
    $reservations = $reservationModel->getReservationsByUser($userId);
} else {
    $reservations = $reservationModel->getAllReservations();
} 
    }


 public function softDeleteByHotelCode($hotelCode)
{
    $query = "UPDATE reservations SET deleted_at = 1 WHERE hotel_code = :code";
    $this->db->query($query, ['code' => $hotelCode]);
}
    //   Soft delete a reservation by hotel code
    
    
    public function deleteByHotelCode($hotelCode)
    {
        return $this->db->query("
            UPDATE reservations 
            SET deleted_at = NOW() 
            WHERE hotel_code = ?
        ", [$hotelCode]);
    }

 
    //   Create new reservation (with optional discount)
     
    public function create(array $data)
    {
        return $this->db->query("
            INSERT INTO reservations 
                (hotel_code, user_id, hotel_id, room_id, discount_id, check_in, check_out, status, created_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())
        ", [
            $data['hotel_code'],
            $data['user_id'],
            $data['hotel_id'],
            $data['room_id'],
            $data['discount_id'] ?? null, 
            $data['check_in'],
            $data['check_out'],
            $data['status']
        ]);
        
    }

    /**
     * Get all room IDs
     */
    public function getAllRooms()
    {
        return $this->db->fetchAll("SELECT id FROM rooms WHERE deleted_at IS NULL");
    }

    /**
     * Get user email by user ID
     */
    
    public function getUserEmailById($userId)
    {
        $stmt = $this->db->query("SELECT user_email FROM users WHERE id = ?", [$userId]);
        $row = $stmt->fetch();
        return $row ? $row['user_email'] : null;
    }

    /**
     * Get hotel name by hotel ID
     */
    public function getHotelNameById($hotelId)
    {
        $stmt = $this->db->query("SELECT hotel_name FROM hotels WHERE id = ?", [$hotelId]);
        $row = $stmt->fetch();
        return $row ? $row['hotel_name'] : null;
    }

    /**
     * Get reservation by ID (optional future use)
     */
    public function getReservationById($id)
    {
        return $this->db->fetch("
            SELECT 
                r.*, 
                u.user_email AS user_email, 
                h.hotel_name AS hotel_name, 
                d.discount_name AS discount_name
            FROM reservations r
            LEFT JOIN users u ON r.user_id = u.id
            LEFT JOIN hotels h ON r.hotel_id = h.id
            LEFT JOIN discounts d ON r.discount_id = d.id
            WHERE r.id = ? AND r.deleted_at IS NULL
        ", [$id]);
    }
}
