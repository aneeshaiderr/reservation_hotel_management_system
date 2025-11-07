<?php

namespace App\Models;

use App\Core\Database;

// Feedback2-- Need proper indentation as per PSR-12 standards
class User extends BaseModel
{
    public function getUserById($id)
    {
        return $this->db->query(
            'SELECT id, first_name, last_name, user_email, contact_no, address
             FROM users
             WHERE id = :id',
            [':id' => $id]
        )->find();
    }

    public function softDelete($id)
    {
        $query = 'UPDATE users SET deleted_at = NOW() WHERE id = ?';

        return $this->db->query($query, [$id]);
    }

    public function create($data)
    {
        return $this->db->query(
            'INSERT INTO users (first_name, last_name, user_email, contact_no, address, status, role_id, created_at)
             VALUES (?, ?, ?, ?, ?, ?, ?, NOW())',
            [
                $data['first_name'],
                $data['last_name'],
                $data['user_email'],
                $data['contact_no'],
                $data['address'],
                $data['status'],
                $data['role_id'],
            ]
        );
    }

    public function find($id)
    {
        if (! $id) {
            return null;
        }

        $stmt = $this->db->query('SELECT * FROM users WHERE id = ?', [$id]);

        return $stmt ? $stmt->fetch() : null;
    }

    public function update($id, $data)
    {
        $existingUser = $this->db->query(
            'SELECT id FROM users WHERE user_email = ? AND id != ?',
            [$data['user_email'], $id]
        )->fetch();

        if ($existingUser) {
            throw new \Exception("Email '{$data['user_email']}' is already used by another account.");
        }

        return $this->db->query(
            'UPDATE users
             SET first_name = ?, last_name = ?, user_email = ?, contact_no = ?, address = ?, status = ?, updated_at = NOW()
             WHERE id = ?',
            [
                $data['first_name'],
                $data['last_name'],
                $data['user_email'],
                $data['contact_no'],
                $data['address'],
                $data['status'],
                $id,
            ]
        );
    }

    public function getAllUsers()
    {
        return $this->db->fetchAll('SELECT * FROM users WHERE deleted_at IS NULL');
    }

    public function findUserById($id)
    {
        return $this->db->findUserById($id);
    }

    public function findUserDetails($id)
    {
        if (! $id) {
            return null;
        }

        $stmt = $this->db->query('SELECT * FROM users WHERE id = ?', [$id]);
        if ($stmt) {
            $result = $stmt->fetch();

            return $result ?: null;
        }

        return null;
    }

    public function updateUserDetails($id, $data)
    {
        return $this->db->query(
            'UPDATE users SET first_name=?, last_name=?, user_email=?, contact_no=?, address=?, status=?, updated_at=NOW() WHERE id=?',
            [
                $data['first_name'],
                $data['last_name'],
                $data['user_email'],
                $data['contact_no'],
                $data['address'],
                $data['status'],
                $id,
            ]
        );
    }

    public function getAllReservationsByUser($userId)
    {
        $sql = '
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
        ';

        return $this->db->query($sql, [':user_id' => $userId])->getAll();
    }
    public function delete($id)
    {
        $this->db->query('DELETE FROM reservations WHERE id = :id', ['id' => $id]);
    }

    public function getCurrentReservation($userId)
    {
        $sql = 'SELECT
                    r.id,
                    r.hotel_code,
                    r.user_id,
                    r.guest_id,
                    r.hotel_id,
                    r.room_id,
                    r.staff_id,
                    r.discount_id,
                    r.check_in,
                    r.check_out,
                    r.status,
                    h.hotel_name AS hotel_name,
                    rm.room_number
                FROM reservations r
                JOIN hotels h ON h.id = r.hotel_id
                JOIN rooms rm ON rm.id = r.room_id
                WHERE r.user_id = :user_id
                ORDER BY r.check_in ';

        return $this->db->query($sql, ['user_id' => $userId])->fetch();
    }
    public function findByEmail(string $email)
    {
        // Uses your Database wrapper's prepared query method (placeholder :email)
        // This is safe against SQL injection because value is bound by the query() method.
        $stmt = $this->db->query(
            'SELECT
            u.id,
            u.user_email,
            u.password,
            u.first_name,
            u.last_name,
            u.role_id,
            r.name AS role_name
         FROM users u
         LEFT JOIN roles r ON u.role_id = r.id
         WHERE u.user_email = :email
         LIMIT 1',
            [':email' => $email]
        );

        // Depending on your Database wrapper, ->find() or ->fetch()
        // Your User model already used ->find() in other methods, so:
        return $stmt->find();
    }
    // app/Models/User.php
    public function signup(array $data)
    {
        return $this->db->query(
            'INSERT INTO users (first_name, last_name, user_email, contact_no, password, role_id)
         VALUES (:first_name, :last_name, :user_email, :contact_no, :password, :role_id)',
            [
                ':first_name' => $data['first_name'],
                ':last_name' => $data['last_name'],
                ':user_email' => $data['user_email'],
                ':contact_no' => $data['contact_no'],
                ':password' => $data['password'],
                ':role_id' => $data['role_id'],
            ]
        );
    }
    // stafflogin
    public function findEmail($email)
    {
        return $this->db->query('SELECT * FROM users WHERE user_email = :user_email', [
            ':user_email' => $email,
        ])->find();
    }

    public function verifyPassword($user, $password)
    {
        return password_verify($password, $user['password']);
    }
    // User.php (Model)
    public function staffsignup($data)
    {
        return $this->db->query(
            'INSERT INTO users (first_name, last_name, user_email, contact_no, password, role_id)
         VALUES (:first_name, :last_name, :user_email, :contact_no, :password, :role_id)',
            [
                ':first_name' => $data['first_name'],
                ':last_name' => $data['last_name'],
                ':user_email' => $data['user_email'],
                ':contact_no' => $data['contact_no'],
                ':password' => $data['password'],
                ':role_id' => $data['role_id'],
            ]
        );
    }
    // app/Models/User.php

    public function getRoleId(bool $flag = true, int $userId = null)
    {
        if ($flag === true) {
            return $_SESSION['role_id'] ?? null;
        }

        if ($userId === null) {
            return null;
        }

        $query = 'SELECT role_id FROM users WHERE id = ?';
        $result = $this->db->fetch($query, [$userId]);

        return $result['role_id'] ?? null;
    }



}
