<?php

namespace App\Models;

class Analytics
{
    public function getData()
    {
        return [
            'latestProjects' => [
                [
                    'name' => 'Project Apollo',
                    'author' => 'Vanessa Tucker',
                    'status' => '65%',
                    'description' => 'Web, UI/UX Design',
                ],
            ],
            'monthlyReport' => [],
        ];
    }
}
