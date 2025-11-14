<?php
use App\Database\Migration\BaseMigration;
class PermissionsTable extends BaseMigration
{
    public function up()
    {
         $sql = "
            CREATE TABLE IF NOT EXISTS permissions (
                id INT(11) AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME NULL,
                deleted_at DATETIME NULL,
                UNIQUE KEY name_unique (name)
            ) ENGINE=InnoDB;
        ";

        $this->conn->exec($sql);
        echo "permissions table created.\n";
    }
}

