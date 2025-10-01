<?php

class BaseController
{
    protected $view;

    public function index($data = [])
    {
        return view($this->view, $data);
    }
}

