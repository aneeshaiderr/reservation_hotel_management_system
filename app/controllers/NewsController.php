<?php

// NewsController.php

namespace App\Controllers;

class NewsController extends BaseController
{
    public function __construct()
    {
        $this->view = 'Frontend/news.php';
    }
}
