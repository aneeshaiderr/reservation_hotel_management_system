<?php

namespace App\Models;

use App\Core\Database;
use App\Middleware\AuthMiddleware;


class Hotel
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
        $auth = new AuthMiddleware();
$auth->checkAccess();
    }

    //  Get all hotels
    public function getAllHotels()
    {
        return $this->db->fetchAll("SELECT * FROM hotels WHERE deleted_at IS NULL OR deleted_at = ''");
    }

    // Soft delete (optional)
    public function softDelete($id)
    {
        return $this->db->query(
            "UPDATE hotels SET deleted_at = NOW() WHERE id = ?",
            [$id]
        );
    }


 public function getHotelById($id)
    {
        if (!$id) {
            return null;
        }

        // Query run karo
        $stmt = $this->db->query(
            "SELECT * FROM hotels WHERE id = ? AND deleted_at IS NULL ",
            [$id]
        );
      }
}
