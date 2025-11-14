<?php
use App\Database\Migration\BaseMigration;
class RoomsTable extends BaseMigration
{
    public function up()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS rooms (
                id BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                hotel_id BIGINT(20) UNSIGNED NOT NULL,
                room_number VARCHAR(20) NOT NULL,
                floor INT(11) NOT NULL,
                status ENUM('available','booked','maintenance') NOT NULL DEFAULT 'available',
                beds TINYINT(3) UNSIGNED NOT NULL,
                max_guests TINYINT(3) UNSIGNED NOT NULL,
                created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                deleted_at DATETIME NULL,
                INDEX idx_hotel_id (hotel_id),
                INDEX idx_room_number (room_number),
                FOREIGN KEY (hotel_id) REFERENCES hotels(id) ON DELETE CASCADE
            ) ENGINE=InnoDB;
        ";
        $this->conn->exec($sql);
        echo "rooms table created.\n";
    }
}

