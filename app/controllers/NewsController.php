<?php
// NewsController.php
namespace App\Controllers;

use App\Controllers\BaseController;
class NewsController extends BaseController
{
    public function __construct()
    {
        $this->view = 'Frontend/news.php';
    }
}
