<?php

use App\Core\Database;


class PermissionSeeder
{
    public function run()
    {
        $config = require __DIR__ . '/../../config.php';
        $db = new Database($config['database']);
        $conn = $db->getPdo();

        $permissions = [
            "view_user",
            "create_user",
            "edit_user",
            "delete_user",
            "view_discount",
            "edit_discount",
            "delete_discount",
        ];

        foreach ($permissions as $perm) {
            $stmt = $conn->prepare("INSERT INTO permissions (name) VALUES (?)");
            $stmt->execute([$perm]);
        }

        echo "Permissions seeded.\n";
    }
}

