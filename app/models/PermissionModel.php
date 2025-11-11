<?php

namespace App\Models;

use App\Core\Database;

class PermissionModel
{
    protected $db;

    public function __construct()
    {
        $config = require BASE_PATH.'config.php';
        $this->db = new Database($config['database']);
    }

    // ✅ Get all permissions
    public function all()
    {
        $sql = "SELECT * FROM permissions";
        return $this->db->query($sql)->fetchAll($sql);
        // fetchAll() returns all rows
    }
public function create($name)
{
    $sql = "INSERT INTO permissions (name) VALUES (?)";
    $this->db->execute($sql, [$name]);

    return $this->db->getPdo()->lastInsertId();
}

    // ✅ Get single permission ID by name
    public function getIdByName($name)
    {
        $sql = "SELECT id FROM permissions WHERE name = ?";
        $row = $this->db->fetch($sql, [$name]); // fetch() returns single row
        return $row['id'] ?? null;
    }
}
