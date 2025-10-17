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
    // Bas SQL string bhejna hai, query() call nahi karna
    return $this->db->fetchAll("SELECT * FROM users WHERE deleted_at IS NULL");
}
     public function findUserById($id)
    {
        return $this->db->findUserById($id);
    }
}

// class User {
//     protected $db;

//     public function __construct(Database $db) {
//         $this->db = $db;
//     }
// public function getUserById($id)
// {
//     $stmt = $this->db->query("SELECT * FROM users WHERE id = :id", [
//         ':id' => $id
//     ]);
//     return $stmt->find();
// }
//     public function getAllUsers() {
//         return $this->db->allUsers();
//     }
//     public function softDelete($id)
// {
//     return $this->db->query("UPDATE users SET deleted_at = NOW() WHERE id = ?", [$id]);
// }

// public function hardDelete($id)
// {
//     return $this->db->query("DELETE FROM users WHERE id = ?", [$id]);
// }

//  // ✅ Create New User
//    public function create($data) {
//     return $this->db->query(
//         "INSERT INTO users (first_name, last_name, email, contact_no, address, status, role_id, created_at) 
//          VALUES (?, ?, ?, ?, ?, ?, ?, NOW())",
//         [
//             $data['first_name'],
//             $data['last_name'],
//             $data['email'],
//             $data['contact_no'],
//             $data['address'],
//             $data['status'],
//             $data['role_id']  
//         ]
//     );
// }

// }

// namespace App\Models;

// use App\Core\Database;

// class User {
//     protected $db;

//     public function __construct(Database $db) {
//         $this->db = $db;
//     }

//     // ✅ all users except deleted
//     public function getAllUsers() {
//         $stmt = $this->db->query("SELECT * FROM users WHERE deleted_at IS NULL");
//         // return $stmt->fetchAll(\PDO::FETCH_ASSOC);
//     }

//     // ✅ find single user by id
//     public function find($id) {
//         $stmt = $this->db->query("SELECT * FROM users WHERE id = ? AND deleted_at IS NULL", [$id]);
//         // return $stmt->fetch(\PDO::FETCH_ASSOC);
//     }

//     // ✅ update user
//     public function update($id, $data) {
//         return $this->db->query(
//             "UPDATE users 
//              SET first_name=?, last_name=?, email=?, contact_no=?, address=?, status=?, updated_at=NOW() 
//              WHERE id=?",
//             [
//                 $data['first_name'],
//                 $data['last_name'],
//                 $data['email'],
//                 $data['contact_no'],
//                 $data['address'],
//                 $data['status'],
//                 $id
//             ]
//         );
//     }

//     // ✅ soft delete
//     public function delete($id) {
//         return $this->db->query("UPDATE users SET deleted_at=NOW() WHERE id=?", [$id]);
//     }
// }

// namespace App\Models;

// use App\Core\Database;

// class User {
//     protected $db;

//     public function __construct(Database $db) {
//         $this->db = $db;
//     }

//     public function getAllUsers() {
//         return $this->db->allUsers();
//     }
// }

// namespace App\Models;

// use App\Core\Database;

// class User
// {
//     protected $db;

//     public function __construct(Database $database)
//     {
//         $this->db = $database;
//     }

//     public function getAllUsers()
//     {
//         return $this->db->allUsers();
//     }
// }
