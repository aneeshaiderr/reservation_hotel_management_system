<?php

namespace App\Controllers\DashboardController;

use App\Models\Analytics;

;

class AnalyticsController extends BaseController
{
    // Feedback3-- Is this functional? If not whats the ETC?
    protected $analytics;

    public function __construct()
    {
        $this->analytics = new Analytics();
    }

    public function index()
    {
        $data = $this->analytics->getData();

        $this->render('dashboard/Analytics/analytics.view.php', [
            'latestProjects' => $data['latestProjects'],
            'monthlyReport' => $data['monthlyReport'],
        ]);
    }
}
