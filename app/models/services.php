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
          $auth = new AuthMiddleware();
          $auth->checkAccess();
    }

    // Get all services (excluding deleted ones)
    public function getAll()
    {
        return $this->db->fetchAll("
            SELECT 
                id, 
                id, 
                service_name, 
                status, 
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
    
}
