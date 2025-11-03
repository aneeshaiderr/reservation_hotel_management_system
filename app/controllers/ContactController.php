<?php

// ContactController.php

namespace App\Controllers;

class ContactController extends BaseController
{
    public function __construct()
    {
        $this->view = 'Frontend/contact.php';
    }
}
