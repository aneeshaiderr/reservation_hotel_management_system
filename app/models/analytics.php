<?php
namespace App\Models;
      use App\Middleware\AuthMiddleware;
//         $auth = new AuthMiddleware();
// $auth->checkAccess();
class Analytics
{
    // No database needed for static view
    public function getData()
    {
        // Return empty array or static placeholders if needed
        return [
            'latestProjects' => [
                [
                    'name' => 'Project Apollo',
                    'author' => 'Vanessa Tucker',
                    'status' => '65%',
                    'description' => 'Web, UI/UX Design'
                ]
            ],
            'monthlyReport' => [] // For charts if needed
        ];
    }
}
