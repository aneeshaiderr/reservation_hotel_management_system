<?php
use App\Database\Migration\BaseMigration;
class DiscountTable extends BaseMigration
{
    public function up()
    {
         $sql = "
            CREATE TABLE IF NOT EXISTS discount (
                id BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                discount_type VARCHAR(100) NOT NULL,
                discount_name VARCHAR(255) NULL,
                value DECIMAL(10,2) NOT NULL,
                start_date DATE NOT NULL,
                end_date DATE NOT NULL,
                status ENUM('active','pending','expired') NULL,
                created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                deleted_at DATETIME NULL
            ) ENGINE=InnoDB;
        ";

        $this->conn->exec($sql);
        echo "discount table created.\n";
    }
}


