<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class DashboardController extends Controller
{
    public function index()
    {
        // Summary
        $totalJobs = Job::count();
        $interviews = Job::where('application_status', 'Interview')->count();
        $offers = Job::where('application_status', 'Offer')->count();
        $rejected = Job::where('application_status', 'Rejected')->count();

        // Progress (target 30 jobs per bulan)
        $month = now()->format('m');
        $year = now()->format('Y');
        $monthlyJobs = Job::whereYear('date_applied', $year)
            ->whereMonth('date_applied', $month)
            ->count();
        $progress = min(100, round($monthlyJobs / 30 * 100));

        // Chart: Applications per Month (6 bulan terakhir)
        $appsPerMonth = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $appsPerMonth[] = [
                'label' => $date->translatedFormat('M'),
                'count' => Job::whereYear('date_applied', $date->year)
                    ->whereMonth('date_applied', $date->month)
                    ->count(),
            ];
        }

        // Recent Activity (4 terakhir)
        $recentJobs = Job::orderBy('created_at', 'desc')->take(4)->get();

        // Upcoming Events (dummy, karena belum ada tabel Task/Event)
        $upcomingEvents = [
            [
                'type' => 'Interview',
                'position' => 'Frontend Developer',
                'company' => 'Google',
                'date' => now()->addDay()->format('Y-m-d'),
                'time' => '10:00 AM',
            ],
            [
                'type' => 'Task',
                'title' => 'Follow up email',
                'date' => now()->format('Y-m-d'),
                'time' => '4:00 PM',
            ],
        ];

        return view('dashboard', compact(
            'totalJobs',
            'interviews',
            'offers',
            'rejected',
            'progress',
            'monthlyJobs',
            'appsPerMonth',
            'recentJobs',
            'upcomingEvents'
        ));
    }
}