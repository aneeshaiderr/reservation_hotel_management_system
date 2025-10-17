<?php
namespace App\Models;

use App\Core\Database;
      use App\Middleware\AuthMiddleware;
        $auth = new AuthMiddleware();
$auth->checkAccess();
class Discount
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    // Get all discounts
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

    // Soft delete (optional)
    public function softDelete($id)
    {
        return $this->db->query(
            "UPDATE discounts SET deleted_at = NOW() WHERE id = ?",
            [$id]
        );
    }
}
