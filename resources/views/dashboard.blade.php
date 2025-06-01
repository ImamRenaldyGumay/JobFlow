@extends('layouts.app')
@section('title', 'Dashboard - JobFlow')
@section('content')
    <!-- Quick Actions -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-3">
        <h1 class="text-2xl font-bold text-gray-800">My Job Search Dashboard</h1>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-6 rounded-lg shadow flex flex-col items-start">
            <div class="flex items-center mb-2"><i class="fa fa-briefcase text-blue-600 text-xl mr-2"></i><span class="text-gray-500">Total Jobs Applied</span></div>
            <div class="text-2xl font-bold text-gray-800">{{ $totalJobs }}</div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow flex flex-col items-start">
            <div class="flex items-center mb-2"><i class="fa fa-calendar-check text-green-600 text-xl mr-2"></i><span class="text-gray-500">Interviews Scheduled</span></div>
            <div class="text-2xl font-bold text-gray-800">{{ $interviews }}</div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow flex flex-col items-start">
            <div class="flex items-center mb-2"><i class="fa fa-handshake text-yellow-600 text-xl mr-2"></i><span class="text-gray-500">Offers Received</span></div>
            <div class="text-2xl font-bold text-gray-800">{{ $offers }}</div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow flex flex-col items-start">
            <div class="flex items-center mb-2"><i class="fa fa-times-circle text-red-600 text-xl mr-2"></i><span class="text-gray-500">Jobs Rejected</span></div>
            <div class="text-2xl font-bold text-gray-800">{{ $rejected }}</div>
        </div>
    </div>

    <!-- Progress & Chart -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">
        <div class="bg-white p-6 rounded-lg shadow flex flex-col items-center justify-center">
            <div class="font-semibold mb-2">Job Search Progress</div>
            <canvas id="progressChart" width="120" height="120"></canvas>
            <div class="mt-4 text-center">
                <div class="text-lg font-bold text-green-700">{{ $progress }}% of your target</div>
                <div class="text-gray-500 text-sm">Target: 30 jobs this month ({{ $monthlyJobs }} applied)</div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow col-span-2 flex flex-col">
            <div class="font-semibold mb-2">Applications per Month</div>
            <canvas id="appsChart" height="100"></canvas>
        </div>
    </div>

    <!-- Upcoming Events & Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">
        <!-- Upcoming Events -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Upcoming Tasks</h2>
            @if($upcomingTasks->count() > 0)
                <div class="space-y-4">
                    @foreach($upcomingTasks as $task)
                        <div class="flex items-start gap-4 p-3 rounded-lg hover:bg-gray-50 transition">
                            <div class="flex-shrink-0">
                                @switch($task->type)
                                    @case('interview')
                                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                            <i class="fa fa-video-camera text-blue-600"></i>
                                        </div>
                                        @break
                                    @case('followup')
                                        <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center">
                                            <i class="fa fa-envelope text-yellow-600"></i>
                                        </div>
                                        @break
                                    @case('assessment')
                                        <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center">
                                            <i class="fa fa-tasks text-purple-600"></i>
                                        </div>
                                        @break
                                    @default
                                        <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                                            <i class="fa fa-check text-green-600"></i>
                                        </div>
                                @endswitch
                            </div>
                            <div class="flex-grow">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-medium text-gray-900">{{ $task->title }}</h3>
                                        <p class="text-sm text-gray-600">
                                            {{ ucfirst($task->type) }}
                                            @if($task->location)
                                                • {{ $task->location }}
                                            @endif
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ \Carbon\Carbon::parse($task->deadline)->format('M d, Y') }}
                                        </div>
                                        <div class="text-sm text-gray-600">
                                            {{ \Carbon\Carbon::parse($task->deadline)->format('h:i A') }}
                                        </div>
                                    </div>
                                </div>
                                @if($task->description)
                                    <p class="mt-1 text-sm text-gray-600">{{ Str::limit($task->description, 100) }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <div class="text-gray-400 mb-2">
                        <i class="fa fa-calendar text-4xl"></i>
                    </div>
                    <p class="text-gray-500">No upcoming tasks</p>
                </div>
            @endif
        </div>
        <!-- Recent Activity -->
        <div class="bg-white p-6 rounded-lg shadow flex flex-col col-span-2">
            <div class="font-semibold mb-4">Recent Activity</div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="text-left text-gray-500">
                            <th class="py-2">Position</th>
                            <th>Company</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentJobs as $job)
                        <tr class="border-t">
                            <td class="py-2">{{ $job->position }}</td>
                            <td>{{ $job->company_name }}</td>
                            <td>
                                @php
                                    $statusColor = match($job->application_status) {
                                        'Interview' => 'green',
                                        'Offer' => 'blue',
                                        'Rejected' => 'red',
                                        default => 'yellow',
                                    };
                                @endphp
                                <span class="bg-{{ $statusColor }}-100 text-{{ $statusColor }}-700 px-2 py-1 rounded text-xs">{{ $job->application_status ?? 'Applied' }}</span>
                            </td>
                            <td>{{ $job->date_applied ? \Carbon\Carbon::parse($job->date_applied)->format('Y-m-d') : $job->created_at->format('Y-m-d') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center text-gray-400 py-4">No recent activity</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Motivational Quote -->
    <div class="bg-white p-6 rounded-lg shadow flex items-center justify-center text-center text-gray-600 text-lg italic">
        "Success is not the key to happiness. Happiness is the key to success. If you love what you are doing, you will be successful."
    </div>
@endsection
@push('modals')
    <!-- Modal scripts (dummy) -->
    <script>
        // Modal logic for Add Job
        const openAddJobModal = document.getElementById('openAddJobModal');
        const addJobModal = document.getElementById('addJobModal');
        const closeAddJobModal = document.getElementById('closeAddJobModal');
        openAddJobModal && openAddJobModal.addEventListener('click', () => addJobModal.classList.remove('hidden'));
        closeAddJobModal && closeAddJobModal.addEventListener('click', () => addJobModal.classList.add('hidden'));
        addJobModal && addJobModal.addEventListener('click', (e) => { if (e.target === addJobModal) addJobModal.classList.add('hidden'); });
        // Modal logic for Add Task
        const openAddTaskModal = document.getElementById('openAddTaskModal');
        const addTaskModal = document.getElementById('addTaskModal');
        const closeAddTaskModal = document.getElementById('closeAddTaskModal');
        openAddTaskModal && openAddTaskModal.addEventListener('click', () => addTaskModal.classList.remove('hidden'));
        closeAddTaskModal && closeAddTaskModal.addEventListener('click', () => addTaskModal.classList.add('hidden'));
        addTaskModal && addTaskModal.addEventListener('click', (e) => { if (e.target === addTaskModal) addTaskModal.classList.add('hidden'); });
    </script>
@endpush
@push('scripts')
    <script>
        // Chart.js data dari controller
        const progressChart = document.getElementById('progressChart');
        if (progressChart) {
            new Chart(progressChart, {
                type: 'doughnut',
                data: {
                    labels: ['Completed', 'Remaining'],
                    datasets: [{
                        data: [{{ $progress }}, {{ 100 - $progress }}],
                        backgroundColor: ['#22c55e', '#e5e7eb'],
                        borderWidth: 0,
                    }]
                },
                options: {
                    cutout: '80%',
                    plugins: { legend: { display: false } },
                    responsive: false,
                }
            });
        }
        const appsChart = document.getElementById('appsChart');
        if (appsChart) {
            new Chart(appsChart, {
                type: 'bar',
                data: {
                    labels: {!! json_encode(collect($appsPerMonth)->pluck('label')) !!},
                    datasets: [{
                        label: 'Applications',
                        data: {!! json_encode(collect($appsPerMonth)->pluck('count')) !!},
                        backgroundColor: '#2563eb',
                    }]
                },
                options: {
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true } },
                }
            });
        }
    </script>
@endpush