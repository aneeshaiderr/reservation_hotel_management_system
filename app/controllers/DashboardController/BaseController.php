<?php
namespace App\Controllers\DashboardController;
use App\Core\Database;

// Feedback-- Need proper indentation as per PSR-12 standards

// Feedback--Why there are two base controllers in the project?

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