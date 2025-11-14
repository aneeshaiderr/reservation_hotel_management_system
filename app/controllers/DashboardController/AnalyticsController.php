<?php

namespace App\Controllers\DashboardController;

use App\Models\Analytics;


class AnalyticsController extends BaseController
{
    protected $analytics;

    public function __construct()
    {

        $this->analytics = new Analytics();
    }

    public function index()
    {
        try {

            $data = $this->analytics->getData();


            $latestProjects = $data['latestProjects'] ?? [];
            $monthlyReport = $data['monthlyReport'] ?? [];


            $this->render('dashboard/Analytics/analytics.view.php', [
                'latestProjects' => $latestProjects,
                'monthlyReport'  => $monthlyReport,
            ]);

        } catch (\Exception $e) {

            $_SESSION['error'] = 'Unable to load analytics data. Please try again later.';
            redirect(url('/dashboard'));
        }
    }
}


