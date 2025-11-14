<?php
use App\Core\Database;


class RoleSeeder
{
    public function run()
    {
        $config = require __DIR__ . '/../../config.php';
        $db = new Database($config['database']);
       $conn = $db->getPdo();

        // Insert roles
        $roles = ['superadmin', 'staff', 'user'];

        foreach ($roles as $role) {
            $stmt = $conn->prepare("INSERT INTO roles (name) VALUES (?)");
            $stmt->execute([$role]);
        }

        echo "Roles seeded.\n";
    }
}
