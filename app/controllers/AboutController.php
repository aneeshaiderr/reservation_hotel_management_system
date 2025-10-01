<?php


class AboutController
{
   
 public function index()
    {
        return view('Frontend/about.php', [
            
            'message' => 'Welcome to Home Page!'
        ]);
    }
}
