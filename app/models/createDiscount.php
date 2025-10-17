<?php
namespace App\Models;

use App\Core\Database;
// use App\Middleware\AuthMiddleware;

// $auth = new AuthMiddleware();
// $auth->checkAccess();
class CreateDiscount
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    // Fetch all discounts
    public function getAll()
    {
        return $this->db->fetchAll("
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
            ORDER BY start_date 
        ");
    }

    // Find a single discount by ID
    public function find($id)
    {
        return $this->db->query("
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
        ", [$id])->fetch();
    }

    // Create a new discount
    public function create($data)
    {
        return $this->db->query("
            INSERT INTO discounts (discount_type,discount_name, value, start_date, end_date, status)
            VALUES (?, ?, ?, ?, ?, ?)
        ", [
            $data['discount_type'],
            $data['discount_name'],
            $data['value'],
            $data['start_date'],
            $data['end_date'],
            $data['status']
        ]);
    }

    // Soft delete a discount
    public function delete($id)
    {
        return $this->db->query("
            UPDATE discounts SET deleted_at = NOW() WHERE id = ?
        ", [$id]);
    }
}
