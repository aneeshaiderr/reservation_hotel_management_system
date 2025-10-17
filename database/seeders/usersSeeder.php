<?php
namespace Database\Seeders;

use PDO;

class UsersSeeder
{
    protected $db;

    public function __construct()
    {
        // Database connection
        $this->db = new PDO("mysql:host=localhost;dbname=practice", "root", "");
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function run()
    {
        $stmt = $this->db->prepare("
            INSERT INTO users (name, email, password) VALUES 
            ('Test User 1', 'user1@example.com', '123456'),
            ('Test User 2', 'user2@example.com', 'abcdef'),
            ('Test User 3', 'user3@example.com', 'password')
        ");
        $stmt->execute();
    }
}
