<?php

// HomeController.php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function __construct()
    {
        $this->view = 'Frontend/index.php';
    }
}
