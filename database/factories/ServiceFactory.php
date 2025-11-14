<?php
require_once __DIR__ . '/../faker.php';

class ServiceFactory
{
    protected $conn;

    public function __construct($pdo)
    {
        $this->conn = $pdo;
    }

    public function create()
    {
        $name = Faker::text(10);
        $status = Faker::enum(['active','inactive']);
        $price = Faker::number(50,500);

        $sql = "INSERT INTO services (service_name, status, price) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$name, $status, $price]);

        return $this->conn->lastInsertId();
    }
}
