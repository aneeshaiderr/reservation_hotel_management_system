<?php
namespace App\Models;

use App\Core\Database;

class RoomDetail
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function find($id)
    {
        return $this->db->query("SELECT * FROM rooms WHERE id = ?", [$id])->find();
    }
 
    public function update($id, $data)
    {
        return $this->db->query(
            "UPDATE rooms SET room_number=?, floor=?, beds=?, max_guests=?, status=?, updated_at=NOW() WHERE id=?",
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

    public function getAllRooms()
    {
        return $this->db->query("SELECT * FROM rooms")->get();
    }
}

// class RoomDetail
// {
//     protected $db;

//     public function __construct(Database $db)
//     {
//         $this->db = $db;
//     }

//     public function find($id)
//     {
//         return $this->db->query("SELECT * FROM rooms WHERE id = ?", [$id])->fetch();
//     }

//     public function update($id, $data)
//     {
//         return $this->db->query(
//             "UPDATE rooms SET room_number=?, floor=?, beds=?, max_guests=?, status=?, updated_at=NOW() WHERE id=?",
//             [
//                 (int)$data['room_number'],
//                 (int)$data['floor'],
//                 (int)$data['beds'],
//                 (int)$data['max_guests'],
//                 $data['status'],
//                 $id
//             ]
//         );
//     }
// }

// class RoomDetail
// {
//     protected $db;

//     public function __construct(Database $database)
//     {
//         $this->db = $database;
//     }

//     /**
//      * Find a room by ID
//      */
//     public function find(int $id)
//     {
//         if (!$id) {
//             return null;
//         }

//         $stmt = $this->db->query("SELECT * FROM rooms WHERE id = ?", [$id]);
//         if ($stmt) {
//             $result = $stmt->fetch();
//             return $result ?: null;
//         }

//         return null;
//     }

//     /**
//      * Update room details
//      */
//     public function update(int $id, array $data)
//     {
//         return $this->db->query(
//             "UPDATE rooms 
//              SET room_number = ?, floor = ?, room_bed = ?, Max_guest = ?, status = ?, updated_at = NOW()
//              WHERE id = ?",
//             [
//                 (int)$data['room_number'],
//                 (int)$data['floor'],
//                 (int)$data['room_bed'],
//                 (int)$data['Max_guest'],
//                 $data['status'],
//                 $id
//             ]
//         );
//     }
// }

