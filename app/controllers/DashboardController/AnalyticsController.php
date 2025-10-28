<?php
namespace App\Controllers\DashboardController;

use App\Models\Analytics;

class AnalyticsController
{
    protected $analytics;

    public function __construct()
    {
        $this->analytics = new Analytics();
    }

    public function index()
    {
        $data = $this->analytics->getData();

      
        return view('dashboard/analytics.view.php', [
            'latestProjects' => $data['latestProjects'],
            'monthlyReport' => $data['monthlyReport']
        ]);
    }
}
