<?php
namespace App\Models;

use App\Core\Database;

class HotelCreate
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    //  Fetch all hotels
    public function getAll()
    {
        return $this->db->fetchAll("
            SELECT 
                id,
                hotel_name,
                address,
                contact_no
            FROM hotels
            WHERE deleted_at IS NULL
            ORDER BY id DESC
        ");
    }

    //  Create a new hotel
    public function create($data)
    {
        return $this->db->query("
            INSERT INTO hotels (hotel_name, address, contact_no, created_at)
            VALUES (?, ?, ?, NOW())
        ", [
            $data['hotel_name'],
            $data['address'],
            $data['contact_no']
        ]);
    }

    //Soft delete 
    public function delete($id)
    {
        return $this->db->query("
            UPDATE hotels SET deleted_at = NOW() WHERE id = ?
        ", [$id]);
    }
}
