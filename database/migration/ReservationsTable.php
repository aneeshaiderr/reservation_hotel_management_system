<?php
use App\Database\Migration\BaseMigration;

class ReservationsTable extends BaseMigration
{
    public function up()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS reservations (
                id INT(11) AUTO_INCREMENT PRIMARY KEY,
                hotel_code VARCHAR(50) NULL,
                user_id INT(11) NOT NULL,
                guest_id INT(11) NOT NULL,
                hotel_id INT(11) NOT NULL,
                room_id INT(11) NOT NULL,
                staff_id INT(11) NULL,
                discount_id INT(11) NULL,
                check_in DATE NOT NULL,
                check_out DATE NOT NULL,
                status ENUM('active','cancelled','completed') NULL DEFAULT 'active',
                created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                deleted_at TIMESTAMP NULL,
                INDEX idx_hotel_code (hotel_code),
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                FOREIGN KEY (guest_id) REFERENCES users(id) ON DELETE CASCADE,
                FOREIGN KEY (hotel_id) REFERENCES hotels(id) ON DELETE CASCADE,
                FOREIGN KEY (room_id) REFERENCES rooms(id) ON DELETE CASCADE,
                FOREIGN KEY (staff_id) REFERENCES users(id) ON DELETE SET NULL,
                FOREIGN KEY (discount_id) REFERENCES discount(id) ON DELETE SET NULL
            ) ENGINE=InnoDB;
        ";

        $this->conn->exec($sql);
        echo "reservations table created.\n";
    }
}

