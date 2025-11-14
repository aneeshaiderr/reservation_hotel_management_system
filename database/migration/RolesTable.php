<?php

use App\Database\Migration\BaseMigration;

class RolesTable extends BaseMigration
{
    public function up()
    {

        $sql = "
            CREATE TABLE IF NOT EXISTS roles (
                id INT(11) AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(50) NOT NULL,
                created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                UNIQUE KEY name_unique (name)
            ) ENGINE=InnoDB;
        ";
        $this->conn->exec($sql);
        echo "roles table created.\n";
    }
}

