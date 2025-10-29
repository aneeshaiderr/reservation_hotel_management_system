<?php
namespace App\Middleware\Middelware;
use PDO;


class Middleware
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Ensure user is logged in
     */
    public function handle()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit();
        }
    }

    /**
     * Check if user has a specific permission 
     */
    public function can($userId, $permissionName)
    {
        
        $stmt = $this->pdo->prepare("SELECT id FROM permissions WHERE name = ?");
        $stmt->execute([$permissionName]);
        $permission = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$permission) {
            return false;
        }

        $permissionId = $permission['id'];

        // 2. Check direct user permission
        $stmt = $this->pdo->prepare("
            SELECT 1 FROM user_permissions 
            WHERE user_id = ? AND permission_id = ?
        ");
        $stmt->execute([$userId, $permissionId]);
        if ($stmt->fetch()) {
            return true;
        }

        //  Check role-based permission
        $stmt = $this->pdo->prepare("
            SELECT 1 
            FROM roles r
            JOIN role_permissions rp ON r.id = rp.role_id
            JOIN users u ON u.role_id = r.id
            WHERE u.id = ? AND rp.permission_id = ?
        ");
        $stmt->execute([$userId, $permissionId]);
        return $stmt->fetch() ? true : false;
    }
}
