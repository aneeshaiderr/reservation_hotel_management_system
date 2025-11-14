<?php
use App\Database\Migration\BaseMigration;

class ServicesTable extends BaseMigration
{
    public function up()
    {
         $sql = "
            CREATE TABLE IF NOT EXISTS services (
                id BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                service_name VARCHAR(150) NOT NULL,
                status ENUM('active','inactive') NULL DEFAULT 'active',
                price DECIMAL(10,2) NULL DEFAULT 0.00,
                created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                deleted_at DATETIME NULL,
                UNIQUE KEY service_name_unique (service_name)
            ) ENGINE=InnoDB;
        ";
        $this->conn->exec($sql);
        echo "services table created.\n";
    }
}

