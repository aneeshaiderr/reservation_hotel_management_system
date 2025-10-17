<?php
namespace App\Models;

use App\Core\Database;

class EditReservation
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
      
    }

    public function find($id)
    {
        return $this->db->query("SELECT * FROM reservations WHERE id = ?", [$id])->find();
    }
 
  public function update($id, $data)
{    $sql = "
        UPDATE reservations
        SET 
            hotel_id = ?, 
            discount_id=?,
            hotel_code=?,
            check_in = ?, 
            check_out = ?, 
            status = ?, 
            updated_at = NOW()
        WHERE id = ?
    ";

    return $this->db->query($sql, [
        $data['hotel_id'],   
         $data['discount_id'],
         $data['hotel_code'],  
        $data['check_in'],
        $data['check_out'],
        $data['status'],
        $id
    ]);
}

public function getHotelNameById($hotelId)
{
    $stmt = $this->db->query("SELECT hotel_name FROM hotels WHERE id = ?", [$hotelId]);
    $row = $stmt->fetch();
    return $row ? $row['hotel_name'] : null;
}


    // Get discount name by ID (single name)
    public function getDiscountNameById($discountId)
    {
        $stmt = $this->db->query("SELECT name FROM discounts WHERE id = ?", [$discountId]);
        $row = $stmt->fetch();
        return $row ? $row['name'] : null;
    }
    public function getAllReservation()
    {
        return $this->db->query("SELECT * FROM reservations")->get();
    }
}

