<?php
namespace App\Controllers\DashboardController;
use App\Core\Database;
abstract class BaseController {
     protected  $db;

  protected function db() {
    $config = require BASE_PATH . 'config.php';
        $db = new Database($config['database']);
       
    }

    protected function view(string $path, array $data = []): void { view($path, $data); }
    protected function redirect(string $path): void { redirect($path); }
}

?>