<?php

namespace App\Controllers;

use App\Controllers\BaseController;
class AboutController extends BaseController
{
    public function __construct()
    {
        $this->view = 'Frontend/about.php';
    }

}
