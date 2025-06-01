<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Task;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Get job statistics
        $totalJobs = Job::where('user_id', $user->id)->count();
        $interviews = Task::where('user_id', $user->id)
            ->where('type', 'interview')
            ->where('deadline', '>=', Carbon::now())
            ->where('status', '!=', 'done')
            ->count();
        $offers = Job::where('user_id', $user->id)
            ->where('application_status', 'Offer')
            ->count();
        $rejected = Job::where('user_id', $user->id)
            ->where('application_status', 'Rejected')
            ->count();

        // Get monthly progress
        $monthlyJobs = Job::where('user_id', $user->id)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();
        $progress = min(($monthlyJobs / 30) * 100, 100);

        // Get recent jobs
        $recentJobs = Job::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Get upcoming tasks
        $upcomingTasks = Task::where('user_id', $user->id)
            ->where('deadline', '>=', Carbon::now())
            ->where('status', '!=', 'done')
            ->orderBy('deadline')
            ->take(5)
            ->get();

        // Get applications per month for chart
        $appsPerMonth = Job::where('user_id', $user->id)
            ->whereYear('created_at', Carbon::now()->year)
            ->get()
            ->groupBy(function ($job) {
                return Carbon::parse($job->created_at)->format('M');
            })
            ->map(function ($jobs) {
                return $jobs->count();
            })
            ->map(function ($count, $month) {
                return [
                    'label' => $month,
                    'count' => $count
                ];
            })
            ->values();

        return view('dashboard', compact(
            'totalJobs',
            'interviews',
            'offers',
            'rejected',
            'progress',
            'monthlyJobs',
            'recentJobs',
            'upcomingTasks',
            'appsPerMonth'
        ));
    }
}