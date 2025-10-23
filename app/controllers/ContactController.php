<?php
// ContactController.php
namespace App\Controllers;

use App\Controllers\BaseController;
class ContactController extends BaseController
{
    public function __construct()
    {
        $this->view = 'Frontend/contact.php';
    }
}
