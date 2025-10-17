<?php
namespace App\Models;

use App\Core\Database;

class EditService
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

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
        return $this->db->fetchAll("SELECT * FROM services ORDER BY created_at ");
    }
}

