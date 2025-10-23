<?php


namespace App\Models;

use App\Core\Database;

class UserAllDetails
{
    protected $db;

    // Constructor accepts a Database instance
    public function __construct($db)
    {
        $this->db = $db;
    }


    public function find($id)
    {
        if (!$id) {
            return null;
        }

        $stmt = $this->db->query("SELECT * FROM users WHERE id = ?", [$id]);
        if ($stmt) {
            $result = $stmt->fetch();
            return $result ?: null;  
        }

        return null;
    }


  
    public function update($id, $data)
    {
        return $this->db->query(
            "UPDATE users SET first_name=?, last_name=?, user_email=?, contact_no=?, address=?, status=?, updated_at=NOW() WHERE id=?", 
            [
                $data['first_name'],
                $data['last_name'],
                $data['user_email'],
                $data['contact_no'],
                $data['address'],
                $data['status'],
                $id
            ]
        );
    }


    public function getAllReservationsByUser($userId)
    {
        $sql = "
            SELECT 
                r.id,
                r.hotel_code,
                r.user_id,
                r.hotel_id,
                h.hotel_name AS hotel_name,
                r.room_id,
                rm.room_number,
                r.staff_id,
                r.discount_id,
                r.check_in,
                r.check_out,
                r.status,
                r.created_at,
                r.updated_at
            FROM reservations r
            JOIN hotels h ON h.id = r.hotel_id
            JOIN rooms rm ON rm.id = r.room_id
            WHERE r.user_id = :user_id
            ORDER BY r.check_in 
        ";

        return $this->db->query($sql, [':user_id' => $userId])->getAll();
    }
}

// namespace App\Models;

// use App\Core\Database;

// class UserAllDetails
// {
//     protected $db;

//     public function __construct($db)
//     {
//         $this->db = $db;
//     }

// public function getAllReservationsByUser($userId)
// {
//     $sql = "
//         SELECT 
//             r.id,
//             r.hotel_code,
//             r.user_id,
//             r.hotel_id,
//             h.hotel_name AS hotel_name,
//             r.room_id,
//             rm.room_number,
//             r.staff_id,
//             r.discount_id,
//             r.check_in,
//             r.check_out,
//             r.status,
//             r.created_at,
//             r.updated_at
//         FROM reservations r
//         JOIN hotels h ON h.id = r.hotel_id
//         JOIN rooms rm ON rm.id = r.room_id
//         WHERE r.user_id = :user_id
//         ORDER BY r.check_in 
//     ";

//     return $this->db->query($sql, [':user_id' => $userId])->getAll();

    
// }

// }
