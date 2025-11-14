<?php
require_once __DIR__ . '/../faker.php';

class ReservationFactory
{
    protected $conn;

    public function __construct($pdo)
    {
        $this->conn = $pdo;
    }

    public function create($hotel_id, $room_id, $user_id, $guest_id, $staff_id = null, $discount_id = null)
    {
        $hotel_code = 'J' . Faker::number(100088,999988);
        $check_in = Faker::date('2025-01-01','2025-06-30');
        $check_out = Faker::date('2025-07-01','2025-12-31');
        $status = Faker::enum(['active','cancelled','completed']);

        $sql = "INSERT INTO reservations
            (hotel_code, user_id, guest_id, hotel_id, room_id, staff_id, discount_id, check_in, check_out, status)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$hotel_code, $user_id, $guest_id, $hotel_id, $room_id, $staff_id, $discount_id, $check_in, $check_out, $status]);

        return $this->conn->lastInsertId();
    }
}
