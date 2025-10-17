<?php

namespace App\Models; 

use App\Core\Database;

class UserDetails
{
protected $db;

    public function __construct(Database $database)
    {
        $this->db = $database;
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
        return $this->db->query("UPDATE users SET first_name=?, last_name=?, user_email=?, contact_no=?, address=?, status=?, updated_at=NOW() WHERE id=?", [
            $data['first_name'],
            $data['last_name'],
            $data['user_email'],
            $data['contact_no'],
            $data['address'],
            $data['status'],
            $id
        ]);
    }


}