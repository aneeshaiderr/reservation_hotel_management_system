<?php
use App\Core\Database;

class RolePermissionSeeder
{
    public function run()
    {
        $config = require __DIR__ . '/../../config.php';
        $db = new Database($config['database']);
        $conn = $db->getPdo();

        // Superadmin → All Permissions
        $stmt = $conn->query("SELECT id FROM permissions");
        $permissions = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($permissions as $p) {
            $stmt2 = $conn->prepare("INSERT INTO role_permissions (role_id, permission_id) VALUES (1, ?)");
            $stmt2->execute([$p['id']]);
        }

        echo "Role-Permissions seeded.\n";
    }
}

