<?php
use App\Database\Migration\BaseMigration;
class UsersTable extends BaseMigration
{
    public function up()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS users (
                id BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                role_id INT(11) UNSIGNED NULL,
                first_name VARCHAR(100) NOT NULL,
                last_name VARCHAR(100) NOT NULL,
                user_email VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL,
                contact_no VARCHAR(50) NULL,
                address TEXT NULL,
                status ENUM('active','inactive') NULL DEFAULT 'active',
                created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                deleted_at TIMESTAMP NULL,
                UNIQUE KEY user_email_unique (user_email),
                INDEX idx_role_id (role_id),
                FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE SET NULL
            ) ENGINE=InnoDB;
        ";
        $this->conn->exec($sql);
        echo "users table created.\n";
    }
}

