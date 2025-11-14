<?php

use App\Core\Database;


// Require all factories
require_once __DIR__ . '/../factories/UserFactory.php';
require_once __DIR__ . '/../factories/HotelFactory.php';
require_once __DIR__ . '/../factories/RoomFactory.php';
require_once __DIR__ . '/../factories/RoomPriceFactory.php';
require_once __DIR__ . '/../factories/ServiceFactory.php';
require_once __DIR__ . '/../factories/DiscountFactory.php';
require_once __DIR__ . '/../factories/ReservationFactory.php';

class UserSeeder
{
    protected $pdo;

    public function __construct()
    {
        $config = require __DIR__ . '/../../config.php';
        $db = new Database($config['database']);
        $this->pdo = $db->getPdo();
    }

    public function run()
    {
        echo "Seeding Users & related data...\n";

        // --- Factories ---
        $userFactory = new UserFactory($this->pdo);
        $hotelFactory = new HotelFactory($this->pdo);
        $roomFactory = new RoomFactory($this->pdo);
        $roomPriceFactory = new RoomPriceFactory($this->pdo);
        $serviceFactory = new ServiceFactory($this->pdo);
        $discountFactory = new DiscountFactory($this->pdo);
        $reservationFactory = new ReservationFactory($this->pdo);

        // --- Users ---
        $usersData = [
            [1, "Super", "Admin", "admin@example.com"],
            [2, "Staff", "Member", "staff@example.com"],
            [4, "Normal", "User", "user@example.com"],
        ];

        foreach ($usersData as $u) {
            list($role_id, $first, $last, $email) = $u;

            // Check if user exists
            $check = $this->pdo->prepare("SELECT id FROM users WHERE user_email = ?");
            $check->execute([$email]);
            if ($check->fetch()) continue;

            $password = password_hash("12345678", PASSWORD_BCRYPT);
            $stmt = $this->pdo->prepare("INSERT INTO users (role_id, first_name, last_name, user_email, password) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$role_id, $first, $last, $email, $password]);
        }

        echo "Users seeded.\n";

        // --- Hotels ---
        $hotelIds = [];
        for ($i = 0; $i < 3; $i++) {
            $hotelIds[] = $hotelFactory->create();
        }
        echo "Hotels seeded.\n";

        // --- Rooms ---
        $roomIds = [];
        foreach ($hotelIds as $hotelId) {
            for ($i = 0; $i < 5; $i++) {
                $roomIds[] = $roomFactory->create($hotelId);
            }
        }
        echo "Rooms seeded.\n";

        // --- Room Prices ---
        foreach ($hotelIds as $hotelId) {
            foreach ($roomIds as $roomId) {
                $roomPriceFactory->create($hotelId, $roomId);
            }
        }
        echo "Room prices seeded.\n";

        // --- Services ---
        for ($i = 0; $i < 5; $i++) {
            $serviceFactory->create();
        }
        echo "Services seeded.\n";

        // --- Discounts ---
        for ($i = 0; $i < 3; $i++) {
            $discountFactory->create();
        }
        echo "Discounts seeded.\n";

        // --- Reservations ---
        // Using first user as example, and first room/hotel
        $allUsers = $this->pdo->query("SELECT id FROM users")->fetchAll(PDO::FETCH_COLUMN);
        $allRooms = $this->pdo->query("SELECT id, hotel_id FROM rooms")->fetchAll(PDO::FETCH_ASSOC);
       $allDiscounts = $this->pdo->query("SELECT id FROM discounts")->fetchAll(PDO::FETCH_COLUMN);


        foreach ($allUsers as $userId) {
            foreach ($allRooms as $room) {
                $hotelId = $room['hotel_id'];
                $roomId = $room['id'];
                $guestId = $userId;
                $staffId = null; // optional
                $discountId = $allDiscounts[array_rand($allDiscounts)];
                $reservationFactory->create($hotelId, $roomId, $userId, $guestId, $staffId, $discountId);
            }
        }
        echo "Reservations seeded.\n";

        echo "All data seeded successfully.\n";
    }
}



// class UserSeeder
// {
//     public function run()
//     {
//         $config = require __DIR__ . '/../../config.php';
//         $db = new App\Core\Database($config['database']);
//         $conn = $db->getPdo();

//         echo "Seeding Users...\n";

//         $sql = "INSERT INTO users (role_id, first_name, last_name, user_email, password) VALUES (?, ?, ?, ?, ?)";
//         $stmt = $conn->prepare($sql);


//         $password = password_hash("12345678", PASSWORD_BCRYPT);

//         // Users data
//         $users = [
//             [1, "Super", "Admin", "admin@example.com", $password],
//             [2, "Staff", "Member", "staff@example.com", $password],
//             [4, "Normal", "User", "user@example.com", $password],
//         ];

//         foreach ($users as $user) {

//             $check = $conn->prepare("SELECT id FROM users WHERE user_email = ?");
//             $check->execute([$user[3]]);
//             if ($check->fetch()) {
//                 continue;
//             }

//             $stmt->execute($user);
//         }

//         echo "Users seeded.\n";
//     }
// }
