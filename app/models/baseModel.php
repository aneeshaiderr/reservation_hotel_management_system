<?php 
namespace App\Models;
use App\Core\Database;
// Feedback-- Need proper indentation as per PSR-12 standards
abstract class BaseModel {
    protected Database $db;

    public function __construct(?Database $db = null) {
        if ($db) { $this->db = $db; return; }
        $config = require BASE_PATH . 'config.php';
        $this->db = new Database($config['database']);
    }

    protected function now(): string { return date('Y-m-d H:i:s'); }
}

?>
