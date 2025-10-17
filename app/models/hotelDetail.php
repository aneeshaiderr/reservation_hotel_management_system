<?php
namespace App\Models;

use App\Core\Database;

class HotelDetail
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function find($id)
    {
        return $this->db->query("SELECT * FROM hotels WHERE id = ?", [$id])->find();
    }
 
  public function update($id, $data)
{ $sql = "
        UPDATE hotels 
        SET 
            hotel_name = ?, 
            address = ?, 
            contact_no = ?, 
   
            updated_at = NOW()
        WHERE id = ?
    ";

    return $this->db->query($sql, [
        $data['hotel_name'],
        $data['address'],
        $data['contact_no'],
       
        $id
    ]);
}


    public function getAllHotel()
    {
        return $this->db->query("SELECT * FROM hotels")->get();
    }
}
