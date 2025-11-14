<?php
require_once __DIR__ . '/../faker.php';

class DiscountFactory
{
    protected $conn;

    public function __construct($pdo)
    {
        $this->conn = $pdo;
    }

    public function create()
    {
        $type = Faker::enum(['percentage','fixed']);
        $name = Faker::text(10);
        $value = ($type === 'percentage') ? Faker::number(5,50) : Faker::number(100,1000);
        $start = Faker::date('2025-01-01', '2025-06-30');
        $end = Faker::date('2025-07-01', '2025-12-31');
        $status = Faker::enum(['active','pending','expired']);

$sql = "INSERT INTO discounts (discount_type, discount_name, value, start_date, end_date, status) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        // $stmt->execute([$type, $name, $value, $start, $end, $status]);

        return $this->conn->lastInsertId();
    }
}
