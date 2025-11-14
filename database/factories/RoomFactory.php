<?php
require_once __DIR__ . '/../faker.php';

class RoomFactory
{
    protected $conn;

    public function __construct($pdo)
    {
        $this->conn = $pdo;
    }

    public function create($hotel_id)
    {
        $roomNumber = 'R' . Faker::number(100,999);
        $floor = Faker::number(1,10);
        $status = Faker::enum(['available','booked','maintenance']);
        $beds = Faker::number(1,4);
        $max_guests = Faker::number($beds, $beds+2);

        $sql = "INSERT INTO rooms
            (hotel_id, room_number, floor, status, beds, max_guests)
            VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$hotel_id, $roomNumber, $floor, $status, $beds, $max_guests]);

        return $this->conn->lastInsertId();
    }
}
