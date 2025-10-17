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
// public function createHotel($hotel_name, $address, $contact_no)
// {
//     $sql = "INSERT INTO hotels (hotel_name, address, contact_no) VALUES (?, ?, ?)";
//     return $this->db->query($sql, [$hotel_name, $address, $contact_no]);
// }


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


// namespace App\Models;

// use App\Core\Database;


// class Hotel
// {
//     protected $db;

//       public function __construct()
//     {
//         $config = require BASE_PATH . 'config.php';
//         $this->db = new Database($config['database']);
//     }

//     // Get all hotels
//     public function getAllHotels()
//     {
//         return $this->db->fetchAll("SELECT id, name, address, contact_no FROM hotels ");
//     }
//     // public function all()
//     // {
//     //  $query = "SELECT id, name, address, contact_no FROM hotels";
//     //     return $this->db->query($query)->get();
//     // }

//     // Get a single hotel
//     public function find($id)
//     {
//         $query = "SELECT id, name, address, contact_no FROM hotels WHERE id = :id";
//         return $this->db->query($query, ['id' => $id])->find();
//     }
// }

// class Hotel
// {
//     protected $db;

   
//     public function __construct()
//     {
//         $config = require BASE_PATH . 'config.php';
//         $this->db = new Database($config['database']);
//     }


//     // Get all hotels
//     public function all()
//     {
//         $query = "SELECT * FROM hotels";
//         return $this->db->query($query)->get();
//     }

//     // Get single hotel by ID
//     public function find($id)
//     {
//         $query = "SELECT * FROM hotels WHERE id = :id";
//         return $this->db->query($query, ['id' => $id])->find();
//     }

//     // Add new hotel
//     public function create($data)
//     {
//         $query = "INSERT INTO hotels (name, location) VALUES (:name, :location)";
//         return $this->db->query($query, [
//             'name' => $data['name'],
//             'location' => $data['location']
//         ]);
//     }

//     // Update hotel info
//     public function update($id, $data)
//     {
//         $query = "UPDATE hotels SET name = :name, location = :location WHERE id = :id";
//         return $this->db->query($query, [
//             'id' => $id,
//             'name' => $data['name'],
//             'location' => $data['location']
//         ]);
//     }

//     // Delete hotel
//     public function delete($id)
//     {
//         $query = "DELETE FROM hotels WHERE id = :id";
//         return $this->db->query($query, ['id' => $id]);
//     }
// }
