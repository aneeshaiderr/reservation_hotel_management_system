<?php

namespace App\Models;

use App\Core\Database;



class Reservation
{
    protected $db;

  

   public function __construct(Database $db)
    {
        $this->db = $db;
    }
//   public function __construct(Database $db ,$config)
//     {
//         $this->db = new Database($config['database']);
//     }
    public function getAllReservations($userId = null, $roleId = null)
    {
        $query = "
            SELECT 
                r.id,
                r.hotel_code,
                r.room_id,
                r.discount_id,
                r.check_in,
                r.check_out,
                r.status,
                u.user_email AS user_email,
                h.hotel_name AS hotel_name,
                d.discount_name AS discount_name
            FROM reservations r
            LEFT JOIN users u ON r.user_id = u.id
            LEFT JOIN hotels h ON r.hotel_id = h.id
            LEFT JOIN discounts d ON r.discount_id = d.id
            WHERE r.deleted_at IS NULL
        ";

        $params = [];

        // Restrict for normal users (role_id = 4)
        if ((int)$roleId === 4 && $userId !== null) {
            $query .= " AND r.user_id = ?";
            $params[] = (int)$userId;
        }

        $query .= " ORDER BY r.id ";
        return $this->db->fetchAll($query, $params);
    }

public function deleteByHotelCode($hotelCode)
{
    return $this->db->query("
        UPDATE reservations 
        SET deleted_at = NOW() 
        WHERE hotel_code = ?
    ", [$hotelCode]);
}
    public function create(array $data)
    {
        return $this->db->query("
            INSERT INTO reservations 
                (hotel_code, user_id, hotel_id, room_id, discount_id, check_in, check_out, status, created_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())
        ", [
            $data['hotel_code'],
            $data['user_id'],
            $data['hotel_id'],
            $data['room_id'],
            $data['discount_id'] ?? null, 
            $data['check_in'],
            $data['check_out'],
            $data['status']
        ]);
    }

    public function getAllRooms()
    {
        return $this->db->fetchAll("SELECT id FROM rooms WHERE deleted_at IS NULL");
    }

    public function getUserEmailById($userId)
    {
        $stmt = $this->db->query("SELECT user_email FROM users WHERE id = ?", [$userId]);
        $row = $stmt->fetch();
        return $row ? $row['user_email'] : null;
    }

    public function getHotelNameById($hotelId)
    {
        $stmt = $this->db->query("SELECT hotel_name FROM hotels WHERE id = ?", [$hotelId]);
        $row = $stmt->fetch();
        return $row ? $row['hotel_name'] : null;
    }

    public function getReservationById($id)
    {
        return $this->db->fetch("
            SELECT 
                r.*, 
                u.user_email AS user_email, 
                h.hotel_name AS hotel_name, 
                d.discount_name AS discount_name
            FROM reservations r
            LEFT JOIN users u ON r.user_id = u.id
            LEFT JOIN hotels h ON r.hotel_id = h.id
            LEFT JOIN discounts d ON r.discount_id = d.id
            WHERE r.id = ? AND r.deleted_at IS NULL
        ", [$id]);
    }

    // ===============================
    // Merged EditReservation Methods
    // ===============================

    public function find($id)
    {
        return $this->db->query("SELECT * FROM reservations WHERE id = ?", [$id])->find();
    }

    public function update($id, $data)
    {
        $sql = "
            UPDATE reservations
            SET 
                hotel_id = ?, 
                discount_id = ?,
                hotel_code = ?,
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

