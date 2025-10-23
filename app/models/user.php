<?php


namespace App\Models;

use App\Core\Database;

      use App\Middleware\AuthMiddleware;
//         $auth = new AuthMiddleware();
// $auth->checkAccess();
class User
{
    protected $db;

    public function __construct()
    {
        $config = require BASE_PATH . 'config.php';
        $this->db = new Database($config['database']);
    }

    public function getUserById($id)
    {
        return $this->db->query(
            "SELECT id, first_name, last_name, user_email, contact_no, address 
             FROM users 
             WHERE id = :id",
            [':id' => $id]
        )->find();
    
    }

  
// public function softDelete($id)
// {
//     return $this->db->query("UPDATE users SET deleted_at = NOW() WHERE id = ?", [$id]);
// }
 public function softDelete($id)
    {
        $query = "UPDATE users SET deleted_at = NOW() WHERE id = ?";
        return $this->db->query($query, [$id]);
    }
// public function hardDelete($id)
// {
//     return $this->db->query("DELETE FROM users WHERE id = ?", [$id]);
// }

 //  Create New User
   public function create($data) {
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

    // Update user details with duplicate email check
    public function update($id, $data)
    {
        // Check if email already exists for another user
        $existingUser = $this->db->query(
            "SELECT id FROM users WHERE user_email = ? AND id != ?",
            [$data['user_email'], $id]
        )->fetch();

        if ($existingUser) {
            throw new \Exception("Email '{$data['user_email']}' is already used by another account.");
        }

        // Proceed with update
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
}
