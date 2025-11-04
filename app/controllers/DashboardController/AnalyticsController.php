<?php

namespace App\Controllers\DashboardController;

use App\Models\Analytics;

class AnalyticsController extends BaseController
{
    // Feedback2-- Is this functional? If not whats the ETC?
    protected $analytics;

    public function __construct()
    {
        $this->analytics = new Analytics();
    }

    public function index()
    {
        $data = $this->analytics->getData();

        $this->view('dashboard/Analytics/analytics.view.php', [
            'latestProjects' => $data['latestProjects'],
            'monthlyReport' => $data['monthlyReport'],
        ]);

        return view('Layouts/dashboard.layout.php');
    }
}
