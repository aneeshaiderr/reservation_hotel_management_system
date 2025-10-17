<?php


namespace App\Models;

use App\Core\Database;

      use App\Middleware\AuthMiddleware;
        $auth = new AuthMiddleware();
$auth->checkAccess();
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

  
public function softDelete($id)
{
    return $this->db->query("UPDATE users SET deleted_at = NOW() WHERE id = ?", [$id]);
}

public function hardDelete($id)
{
    return $this->db->query("DELETE FROM users WHERE id = ?", [$id]);
}

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



   public function getAllUsers()
{
    
    return $this->db->fetchAll("SELECT * FROM users WHERE deleted_at IS NULL");
}
     public function findUserById($id)
    {
        return $this->db->findUserById($id);
    }
}
