<?php
namespace App\Models;

use App\Core\Database;

class Rooms
{
    protected $db;

    public function __construct(Database $database)
    {
        $this->db = $database;
    }
public function getAllRooms()
{
    return $this->db->all('rooms');
}

//    public function getAllRooms()
// {
//     return $this->db->fetchAll("SELECT * FROM rooms");
// }

}
