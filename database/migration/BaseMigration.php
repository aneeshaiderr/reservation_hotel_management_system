<?php
namespace App\Database\Migration;
use App\Core\Database;
abstract class BaseMigration
{
    protected $conn;

    public function __construct()
    {
        $config = require __DIR__ . '/../../config.php';
        $db = new Database($config['database']);
        $this->conn = $db->getPdo();
    }

    abstract public function up();
}

