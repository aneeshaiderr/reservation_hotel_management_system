<?php


namespace App\Models;

use App\Core\Database;


class User extends BaseModel
{
   



    public function getUserById($id)
    {
        return $this->db->query(
            "SELECT id, first_name, last_name, user_email, contact_no, address 
             FROM users 
             WHERE id = :id",
            [':id' => $id]
        )->find();
    }

    public function softDelete($id)
    {
        $query = "UPDATE users SET deleted_at = NOW() WHERE id = ?";
        return $this->db->query($query, [$id]);
    }

    public function create($data)
    {
        return $this->db->query(
            "INSERT INTO users (first_name, last_name, user_email, contact_no, address, status, role_id, created_at) 
             VALUES (?, ?, ?, ?, ?, ?, ?, NOW())",
            [
                $data['first_name'],
                $data['last_name'],
                $data['user_email'],
                $data['contact_no'],
                $data['address'],
                $data['status'],
                $data['role_id']
            ]
        );
    }

    public function find($id)
    {
        if (!$id) {
            return null;
        }

        $stmt = $this->db->query("SELECT * FROM users WHERE id = ?", [$id]);
        return $stmt ? $stmt->fetch() : null;
    }

    public function update($id, $data)
    {
        $existingUser = $this->db->query(
            "SELECT id FROM users WHERE user_email = ? AND id != ?",
            [$data['user_email'], $id]
        )->fetch();

        if ($existingUser) {
            throw new \Exception("Email '{$data['user_email']}' is already used by another account.");
        }

        return $this->db->query(
            "UPDATE users 
             SET first_name = ?, last_name = ?, user_email = ?, contact_no = ?, address = ?, status = ?, updated_at = NOW() 
             WHERE id = ?",
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

    public function getAllUsers()
    {
        return $this->db->fetchAll("SELECT * FROM users WHERE deleted_at IS NULL");
    }

    public function findUserById($id)
    {
        return $this->db->findUserById($id);
    }



    public function findUserDetails($id)
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

    public function updateUserDetails($id, $data)
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

