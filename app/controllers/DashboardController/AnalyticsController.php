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
        // Fetch data (static in this case)
        $data = $this->analytics->getData();

        // Render the view and pass data if needed
        return view('dashboard/analytics.view.php', [
            'latestProjects' => $data['latestProjects'],
            'monthlyReport' => $data['monthlyReport']
        ]);
    }
}
