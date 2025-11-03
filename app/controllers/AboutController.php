<?php

namespace App\Controllers;

class AboutController extends BaseController
{
    public function __construct()
    {
        $this->view = 'Frontend/about.php';
    }
}
