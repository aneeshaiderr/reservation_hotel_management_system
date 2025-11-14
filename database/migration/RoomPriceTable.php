<?php
use App\Database\Migration\BaseMigration;

class RoomPricesTable extends BaseMigration
{
    public function up()
    {

        $sql = "
            CREATE TABLE IF NOT EXISTS room_prices (
                id BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                hotel_id BIGINT(20) UNSIGNED NOT NULL,
                room_id BIGINT(20) UNSIGNED NOT NULL,
                rate DECIMAL(10,2) NOT NULL,
                start_date DATE NULL,
                end_date DATE NULL,
                created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                INDEX idx_hotel_id (hotel_id),
                INDEX idx_room_id (room_id),
                INDEX idx_start_date (start_date),
                INDEX idx_end_date (end_date),
                FOREIGN KEY (hotel_id) REFERENCES hotels(id) ON DELETE CASCADE,
                FOREIGN KEY (room_id) REFERENCES rooms(id) ON DELETE CASCADE
            ) ENGINE=InnoDB;
        ";

        $this->conn->exec($sql);
        echo "room_prices table created.\n";
    }
}

