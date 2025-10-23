<?php

namespace App\Models;

use App\Core\Database;
use App\Middleware\AuthMiddleware;

class Services
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
        // Agar auth check chahiye to uncomment karo:
        // $auth = new AuthMiddleware();
        // $auth->checkAccess();
    }

    // ===============================
    // From "Services" Model
    // ===============================

    // Get all services (excluding deleted ones)
    public function getAll()
    {
        return $this->db->fetchAll("
            SELECT 
                id, 
                service_name, 
                price, 
                status
            FROM services
            WHERE deleted_at IS NULL
        ");
    }

    // Soft delete service
    public function softDelete($id)
    {
        return $this->db->query("
            UPDATE services SET deleted_at = NOW() WHERE id = ?
        ", [$id]);
    }

    // ===============================
    // From "CreateService" Model
    // ===============================

    //  Fetch all services (same name getAll — keeping both)
    public function getAllServicesList()
    {
        return $this->db->fetchAll("
            SELECT 
                id,
                service_name,
                price,
                status
            FROM services
            WHERE deleted_at IS NULL
            ORDER BY id DESC
        ");
    }

    // Create new service
    public function create($data)
    {
        return $this->db->query("
            INSERT INTO services (service_name, price, status, created_at)
            VALUES (?, ?, ?, NOW())
        ", [
            $data['service_name'],
            $data['price'],
            $data['status']
        ]);
    }

    // ===============================
    // From "EditService" Model
    // ===============================

    // Find a single service record by ID
    public function find($id)
    {
        return $this->db->query("SELECT * FROM services WHERE id = ?", [$id])->find();
    }

    // Update an existing service
    public function update($id, $data)
    {
        $sql = "
            UPDATE services
            SET 
                service_name = ?, 
                price = ?, 
                status = ?, 
                updated_at = NOW()
            WHERE id = ?
        ";

        return $this->db->query($sql, [
            $data['service_name'],
            $data['price'],
            $data['status'],
            $id
        ]);
    }

    // Get all services (for list or reference)
    public function getAllServices()
    {
        return $this->db->fetchAll("SELECT * FROM services ORDER BY created_at");
    }
}

// namespace App\Models;

// use App\Core\Database;
//       use App\Middleware\AuthMiddleware;
      
// class Services
// {

//     protected $db;

//     public function __construct(Database $db)
//     {
//         $this->db = $db;
//         //   $auth = new AuthMiddleware();
//         //   $auth->checkAccess();
//     }

//     // Get all services (excluding deleted ones)
//     public function getAll()
//     {
//         return $this->db->fetchAll("
//             SELECT 
//                 id, 
//                 id, 
//                 service_name, 
//                 status, 
//                 price, 
                
//                 status
//             FROM services
//             WHERE deleted_at IS NULL
//         ");
//     }

//     // Soft delete service
//     public function softDelete($id)
//     {
//         return $this->db->query("
//             UPDATE services SET deleted_at = NOW() WHERE id = ?
//         ", [$id]);
//     }
    
// }
