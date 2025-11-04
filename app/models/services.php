<?php

namespace App\Models;

// Feedback2-- Need proper indentation as per PSR-12 standards
class Services extends BaseModel
{
    public function getAll()
    {
        return $this->db->fetchAll('
            SELECT 
                id, 
                service_name, 
                price, 
                status
            FROM services
            WHERE deleted_at IS NULL
        ');
    }

    // Soft delete service
    public function softDelete($id)
    {
        return $this->db->query('
            UPDATE services SET deleted_at = NOW() WHERE id = ?
        ', [$id]);
    }
 public function all()
    {
        return $this->db->fetchAll("
            SELECT id, service_name, price, status
            FROM services
            WHERE deleted_at IS NULL
        ");
    }
    public function getAllServicesList()
    {
        return $this->db->fetchAll('
            SELECT 
                id,
                service_name,
                price,
                status
            FROM services
            WHERE deleted_at IS NULL
            ORDER BY id DESC
        ');
    }

    // Create new service
    public function create($data)
    {
        return $this->db->query('
            INSERT INTO services (service_name, price, status, created_at)
            VALUES (?, ?, ?, NOW())
        ', [
            $data['service_name'],
            $data['price'],
            $data['status'],
        ]);
    }

    public function find($id)
    {
        return $this->db->query('SELECT * FROM services WHERE id = ?', [$id])->find();
    }

    // Update an existing service
    public function update($id, $data)
    {
        $sql = '
            UPDATE services
            SET 
                service_name = ?, 
                price = ?, 
                status = ?, 
                updated_at = NOW()
            WHERE id = ?
        ';

        return $this->db->query($sql, [
            $data['service_name'],
            $data['price'],
            $data['status'],
            $id,
        ]);
    }

    // Get all services (for list or reference)
    public function getAllServices()
    {
        return $this->db->fetchAll('SELECT * FROM services ORDER BY created_at');
    }
}
