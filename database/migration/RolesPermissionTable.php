<?php
use App\Database\Migration\BaseMigration;

class RolePermissionsTable extends BaseMigration
{
    public function up()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS role_permissions (
                id INT(11) AUTO_INCREMENT PRIMARY KEY,
                role_id INT(11) NOT NULL,
                permission_id INT(11) NOT NULL,
                UNIQUE KEY role_perm_unique (role_id, permission_id),
                INDEX idx_role_id (role_id),
                INDEX idx_permission_id (permission_id),
                FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE,
                FOREIGN KEY (permission_id) REFERENCES permissions(id) ON DELETE CASCADE
            ) ENGINE=InnoDB;
        ";
        $this->conn->exec($sql);
        echo "role_permissions table created.\n";
    }
}

