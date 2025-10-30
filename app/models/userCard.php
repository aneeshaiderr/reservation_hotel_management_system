<?php

namespace App\Models; 

use App\Core\Database;

// Feedback-- Should be moved into the user model

class UserCard  extends BaseModel
{
   
    public function delete($id)
{
    $this->db->query("DELETE FROM reservations WHERE id = :id", ['id' => $id]);
}
    public function getCurrentReservation($userId)
    {
        $sql = "SELECT 
                    r.id,
                    r.hotel_code,
                    r.user_id,
                    r.guest_id,
                    r.hotel_id,
                    r.room_id,
                    r.staff_id,
                    r.discount_id,
                    r.check_in,
                    r.check_out,
                    r.status,
                    h.hotel_name AS hotel_name,
                    rm.room_number
                FROM reservations r
                JOIN hotels h ON h.id = r.hotel_id
                JOIN rooms rm ON rm.id = r.room_id
                WHERE r.user_id = :user_id
                ORDER BY r.check_in ";  

        return $this->db->query($sql, ['user_id' => $userId])->fetch();
    }
}
