<?php
require_once __DIR__ . '/../faker.php';

class HotelFactory
{
    protected $conn;

    public function __construct($pdo)
    {
        $this->conn = $pdo;
    }

    public function create()
    {
        $name = Faker::text(10);
        $address = Faker::text(50);
        $contact = Faker::phone();

        $sql = "INSERT INTO hotels (hotel_name, address, contact_no) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$name, $address, $contact]);

        return $this->conn->lastInsertId();
    }
}
