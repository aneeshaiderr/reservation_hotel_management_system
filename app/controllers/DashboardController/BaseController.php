<?php

namespace App\Controllers\DashboardController;

use App\Core\Database;
abstract class BaseController
{
    protected $db;

    protected function db()
    {
        $config = require BASE_PATH.'config.php';
        $db = new Database($config['database']);
    }
    protected function render(string $view, array $data = [])
    {
    extract($data); 
    $viewPath = BASE_PATH.'app/view/'.$view.'.php';
    require BASE_PATH.'app/view/Layouts/dashboard.layout.php';
}
}
