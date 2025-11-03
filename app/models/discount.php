<?php

namespace App\Models;

// Feedback-- Need proper indentation as per PSR-12 standards
// Feedback-- How did yoy handle SQL Injections?
class Discount extends BaseModel
{
    public function getAll()
    {
        return $this->db->fetchAll('
            SELECT 
                id,
                discount_type,
                discount_name,
                value,
                start_date,
                end_date,
                status
            FROM discounts
            WHERE deleted_at IS NULL
            ORDER BY start_date DESC
        ');
    }

    public function find($id)
    {
        return $this->db->query('
            SELECT 
                id,
                discount_type,
                discount_name,
                value,
                start_date,
                end_date,
                status
            FROM discounts
            WHERE id = ? AND deleted_at IS NULL
        ', [$id])->find();
    }

    public function create($data)
    {
        return $this->db->query('
            INSERT INTO discounts 
                (discount_type, discount_name, value, start_date, end_date, status, created_at)
            VALUES (?, ?, ?, ?, ?, ?, NOW())
        ', [
            $data['discount_type'],
            $data['discount_name'],
            $data['value'],
            $data['start_date'],
            $data['end_date'],
            $data['status'],
        ]);
    }

    public function update($id, $data)
    {
        return $this->db->query('
            UPDATE discounts
            SET 
                discount_type = ?, 
                discount_name = ?,
                value = ?, 
                start_date = ?, 
                end_date = ?, 
                status = ?, 
                updated_at = NOW()
            WHERE id = ? AND deleted_at IS NULL
        ', [
            $data['discount_type'],
            $data['discount_name'],
            $data['value'],
            $data['start_date'],
            $data['end_date'],
            $data['status'],
            $id,
        ]);
    }

    public function softDelete($id)
    {
        return $this->db->query('
            UPDATE discounts SET deleted_at = NOW() WHERE id = ?
        ', [$id]);
    }
}
