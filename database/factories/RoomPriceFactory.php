<?php
require_once __DIR__ . '/../faker.php';

class RoomPriceFactory
{
    protected $conn;

    public function __construct($pdo)
    {
        $this->conn = $pdo;
    }

    public function create($hotel_id, $room_id)
    {
        $rate = Faker::number(50, 500);
        $start_date = Faker::date('2025-01-01', '2025-06-30');
        $end_date = Faker::date('2025-07-01', '2025-12-31');

        $sql = "INSERT INTO room_prices
            (hotel_id, room_id, rate, start_date, end_date)
            VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$hotel_id, $room_id, $rate, $start_date, $end_date]);

        return $this->conn->lastInsertId();
    }
}
