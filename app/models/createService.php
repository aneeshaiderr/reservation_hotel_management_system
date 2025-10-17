<?php
namespace App\Models;

use App\Core\Database;

class CreateService
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    //  Fetch all services
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

   
}
