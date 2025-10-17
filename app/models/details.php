<?php

namespace App\Models; 

use App\Core\Database;
      use App\Middleware\AuthMiddleware;
        $auth = new AuthMiddleware();
$auth->checkAccess();
class Details
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


// namespace App\Models;

// use App\Core\Database;

// class Details
// {
//     protected $db;

//     public function __construct(Database $db)
//     {
//         $this->db = $db;
//     }

//     // Find user by ID
//     public function find($id)
//     {
//         return $this->db->query("SELECT * FROM users WHERE id = :id", ['id' => $id])->fetch();
//     }

//     // Update user
//     public function update($id, $data)
//     {
//         return $this->db->query(
//             "UPDATE users 
//              SET first_name = :first_name, last_name = :last_name, email = :email, 
//                  contact_no = :contact_no, address = :address, status = :status,
//                  updated_at = NOW()
//              WHERE id = :id",
//             [
//                 'first_name' => $data['first_name'],
//                 'last_name'  => $data['last_name'],
//                 'email'      => $data['email'],
//                 'contact_no' => $data['contact_no'],
//                 'address'    => $data['address'],
//                 'status'     => $data['status'],
//                 'id'         => $id
//             ]
//         );
//     }

//     // Delete user
//     public function delete($id)
//     {
//         return $this->db->query("DELETE FROM users WHERE id = :id", ['id' => $id]);
//     }
// }
