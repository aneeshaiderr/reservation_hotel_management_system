<?php
use App\Database\Migration\BaseMigration;

class HotelsTable extends BaseMigration
{
    public function up()
    {
         $sql = "
            CREATE TABLE IF NOT EXISTS hotels (
                id BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                hotel_name VARCHAR(100) NOT NULL,
                address TEXT NOT NULL,
                contact_no VARCHAR(50) NOT NULL,
                created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                deleted_at DATETIME NULL
            ) ENGINE=InnoDB;
        ";

        $this->conn->exec($sql);
        echo "hotels table created.\n";
    }
}

