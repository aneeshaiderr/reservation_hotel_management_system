<?php
namespace App\Models;

use App\Core\Database;

      use App\Middleware\AuthMiddleware;
      
class Rooms
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
          $auth = new AuthMiddleware();
         $auth->checkAccess();
    }

    public function getAllRooms()
    {
        return $this->db->fetchAll("SELECT * FROM rooms WHERE deleted_at IS NULL");
    }

    public function softDelete($id)
    {
        return $this->db->query(
            "UPDATE rooms SET deleted_at = NOW() WHERE id = ?",
            [$id]
        );
    }
}
