<?php

namespace App\Models;

class Rooms extends BaseModel
{
    //  All  rooms
    public function getAllRooms()
    {
        return $this->db->fetchAll('SELECT * FROM rooms WHERE deleted_at IS NULL');
    }

    public function getAll()
    {
        return $this->db->fetchAll('SELECT * FROM rooms');
    }

    public function find($id)
    {
        return $this->db->query('SELECT * FROM rooms WHERE id = ?', [$id])->find();
    }

    public function create($data)
    {
        return $this->db->query('
            INSERT INTO rooms (room_number, floor, beds, max_guests, hotel_id, status)
            VALUES (:room_number, :floor, :room_bed, :Max_guests, :hotel_id, :status)
        ', $data);
    }

    //  Update room
    public function update($id, $data)
    {
        return $this->db->query(
            'UPDATE rooms 
             SET room_number = ?, 
                 floor = ?, 
                 beds = ?, 
                 max_guests = ?, 
                 status = ?, 
                 updated_at = NOW()
             WHERE id = ?',
            [
                (int) $data['room_number'],
                (int) $data['floor'],
                (int) $data['room_bed'],
                (int) $data['Max_guests'],
                $data['status'],
                $id,
            ]
        );
    }

    // Soft delete
    public function softDelete($id)
    {
        return $this->db->query(
            'UPDATE rooms SET deleted_at = NOW() WHERE id = ?',
            [$id]
        );
    }

    public function getAllHotels()
    {
        return $this->db->fetchAll('SELECT id, hotel_name FROM hotels', []);
    }
}
