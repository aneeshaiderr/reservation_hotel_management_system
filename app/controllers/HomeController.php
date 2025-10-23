<?php
// HomeController.php
namespace App\Controllers;

use App\Controllers\BaseController;
class HomeController extends BaseController
{
    public function __construct()
    {
        $this->view = 'Frontend/index.php';
    }
}
