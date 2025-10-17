<?php
namespace App\Models;

use App\Core\Database;

class EditDiscount
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    // Find a single discount record by ID
    public function find($id)
    {
        return $this->db->query("SELECT * FROM discounts WHERE id = ?", [$id])->find();
    }

    // Update an existing discount
    public function update($id, $data)
    {
        $sql = "
            UPDATE discounts
            SET 
                discount_type = ?, 
                discount_name=?,
                value = ?, 
                start_date = ?, 
                end_date = ?, 
                status = ?, 
                updated_at = NOW()
            WHERE id = ?
        ";

        return $this->db->query($sql, [
            $data['discount_type'],
            $data['discount_name'],
            $data['value'],
            $data['start_date'],
            $data['end_date'],
            $data['status'],
            $id
        ]);
    }

    // Get all discounts (for list or reference)
    public function getAllDiscounts()
    {
        return $this->db->fetchAll("SELECT * FROM discounts ORDER BY start_date DESC");
    }
}

