<?php

namespace App\Models;

use App\Core\Database;

class Hotel extends BaseModel
{
  

   
    public function getAllHotels()
    {
        return $this->db->fetchAll("SELECT * FROM hotels WHERE deleted_at IS NULL OR deleted_at = ''");
    }

    // Soft delete 
    public function softDelete($id)
    {
        return $this->db->query(
            "UPDATE hotels SET deleted_at = NOW() WHERE id = ?",
            [$id]
        );
    }

    public function getHotelById($id)
    {
        if (!$id) {
            return null;
        }

        $stmt = $this->db->query(
            "SELECT * FROM hotels WHERE id = ? AND deleted_at IS NULL",
            [$id]
        );
    }


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

    
    // Create a new hotel
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

    // Soft delete (duplicate from Hotel)
    public function delete($id)
    {
        return $this->db->query("
            UPDATE hotels SET deleted_at = NOW() WHERE id = ?
        ", [$id]);
    }


    public function find($id)
    {
        return $this->db->query("SELECT * FROM hotels WHERE id = ?", [$id])->find();
    }

    public function update($id, $data)
    {
        $sql = "
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

