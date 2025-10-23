<?php
namespace App\Models;

use App\Core\Database;


class Rooms
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
        // Optional authentication middleware
        // $auth = new AuthMiddleware();
        // $auth->checkAccess();
    }

    // ----------------------------
    // 🔹 Fetch All Rooms
    // ----------------------------
    public function getAllRooms()
    {
        return $this->db->fetchAll("SELECT * FROM rooms WHERE deleted_at IS NULL");
    }

    // Alternate getAll method (from RoomCreate)
    public function getAll()
    {
        return $this->db->fetchAll("SELECT * FROM rooms");
    }

    // ----------------------------
    // 🔹 Find Room by ID
    // ----------------------------
    public function find($id)
    {
        return $this->db->query("SELECT * FROM rooms WHERE id = ?", [$id])->find();
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
    }
    // public function create($data)
    // {
    //     // Example: logic to create or fetch joined data (you can replace with INSERT if needed)
    //     return $this->db->query("
    //         SELECT 
    //             rooms.id,
    //             rooms.room_number,
    //             rooms.floor,
    //             rooms.beds,
    //             rooms.max_guests,
    //             rooms.status,
    //             hotels.hotel_name AS hotel_name
    //         FROM rooms
    //         LEFT JOIN hotels ON rooms.hotel_id = hotels.id
    //     ")->fetchAll();
    // }

    // ----------------------------
    // 🔹 Update Room Data
    // ----------------------------
    public function update($id, $data)
    {
        return $this->db->query(
            "UPDATE rooms 
             SET room_number = ?, 
                 floor = ?, 
                 beds = ?, 
                 max_guests = ?, 
                 status = ?, 
                 updated_at = NOW()
             WHERE id = ?",
            [
                (int)$data['room_number'],
                (int)$data['floor'],
                (int)$data['room_bed'],
                (int)$data['Max_guests'],
                $data['status'],
                $id
            ]
        );
    }

    // ----------------------------
    // 🔹 Soft Delete
    // ----------------------------
    public function softDelete($id)
    {
        return $this->db->query(
            "UPDATE rooms SET deleted_at = NOW() WHERE id = ?",
            [$id]
        );
    }
}

//       use App\Middleware\AuthMiddleware;
      
// class Rooms
// {
//     protected $db;

//     public function __construct(Database $db)
//     {
//         $this->db = $db;
//         //   $auth = new AuthMiddleware();
//         //  $auth->checkAccess();
//     }

//     public function getAllRooms()
//     {
//         return $this->db->fetchAll("SELECT * FROM rooms WHERE deleted_at IS NULL");
//     }

//     public function softDelete($id)
//     {
//         return $this->db->query(
//             "UPDATE rooms SET deleted_at = NOW() WHERE id = ?",
//             [$id]
//         );
//     }
// }
