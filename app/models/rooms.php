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

// class Rooms
// {
//     protected $db;

//     public function __construct(Database $database)
//     {
//         $this->db = $database;
//     }
// public function getAllRooms()
// {
//     return $this->db->all('rooms');
// }
// public function softDelete($id)
// {
//     return $this->db->query("UPDATE rooms SET deleted_at = NOW() WHERE id = ?", [$id]);
// }

// public function hardDelete($id)
// {
//     return $this->db->query("DELETE FROM rooms WHERE id = ?", [$id]);
// }

  // Soft delete room
    // public function softDelete($id)
    // {
    //     return $this->db->query("UPDATE rooms SET deleted_at=NOW() WHERE id=?", [(int)$id]);
    // }
//    public function getAllRooms()
// {
//     return $this->db->fetchAll("SELECT * FROM rooms");
// }


