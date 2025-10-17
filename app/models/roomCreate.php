<?php
namespace App\Models;

use App\Core\Database;

class RoomCreate
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    // Fetch all rooms
    public function getAll()
    {
        return $this->db->fetchAll("SELECT * FROM rooms");
    }

    // Find a single room
    public function find($id)
    {
        return $this->db->query("SELECT * FROM rooms WHERE id = ?", [$id])->fetch();
    }

    // Create new room
    public function create($data)
    {
         $rooms = $this->db->query("
        SELECT 
            rooms.id,
            rooms.room_number,
            rooms.floor,
            rooms.beds,
            rooms.max_guests,
            rooms.status,
            hotels.hotel_name AS hotel_name
        FROM rooms
        LEFT JOIN hotels ON rooms.hotel_id = hotels.id
    ");
    //     return $this->db->query(
    //     "INSERT INTO rooms (room_number, floor, beds, max_guests, status, hotel_id, created_at) 
    //      VALUES (?, ?, ?, ?, ?, ?, NOW())",
    //     [
    //         (int)$data['room_number'],
    //         (int)$data['floor'],
    //         (int)$data['room_bed'],
    //         (int)$data['Max_guests'],
    //         $data['status'],
    //         (int)$data['hotel_id'] 
    //     ]
    // );

    }

    // Update existing room
    // public function update($id, $data)
    // {
    //     return $this->db->query(
    //         "UPDATE rooms SET room_number=?, floor=?, beds=?, max_guests=?, status=?, updated_at=NOW() WHERE id=?",
    //         [
    //             (int)$data['room_number'],
    //             (int)$data['floor'],
    //             (int)$data['room_bed'],
    //             (int)$data['Max_guests'],
    //             $data['status'],
    //             (int)$id
    //         ]
    //     );
    // }

  
}

