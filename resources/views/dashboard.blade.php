@extends('layouts.app')
@section('title', 'Dashboard - JobFlow')
@section('content')
    <!-- Quick Actions -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-3">
        <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
        <div class="flex gap-2">
            <a href="{{ route('jobs.create') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md font-semibold shadow hover:bg-blue-700 transition">
                <i class="fa fa-plus mr-2"></i>Add Job
            </a>
            <button id="openAddTaskModal" type="button"
                class="inline-flex items-center px-4 py-2 bg-green-700 text-white rounded-md font-semibold shadow hover:bg-green-800 transition"><i
                    class="fa fa-tasks mr-2"></i>Add Task</button>
        </div>
    </div>
    <!-- Add Job Modal -->
    <div id="addJobModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
            <button id="closeAddJobModal" class="absolute top-3 right-3 text-gray-400 hover:text-gray-700"><i
                    class="fa fa-times text-xl"></i></button>
            <h2 class="text-xl font-bold mb-4">Add Job</h2>
            <form class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Position</label>
                    <input type="text"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                        placeholder="e.g. Frontend Developer">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Company</label>
                    <input type="text"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                        placeholder="e.g. Google">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date Applied</label>
                    <input type="date"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-md font-semibold hover:bg-blue-700 transition">Save</button>
            </form>
        </div>
    </div>
    <!-- Add Task Modal -->
    <div id="addTaskModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
            <button id="closeAddTaskModal" class="absolute top-3 right-3 text-gray-400 hover:text-gray-700"><i
                    class="fa fa-times text-xl"></i></button>
            <h2 class="text-xl font-bold mb-4">Add Task</h2>
            <form class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                    <input type="text"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-700"
                        placeholder="e.g. Follow up email">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-700"
                        rows="2" placeholder="Task details..."></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deadline</label>
                    <input type="date"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-700">
                </div>
                <button type="submit"
                    class="w-full bg-green-700 text-white py-2 rounded-md font-semibold hover:bg-green-800 transition">Save</button>
            </form>
        </div>
    </div>
    <!-- Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-6 rounded-lg shadow flex flex-col items-start">
            <div class="flex items-center mb-2"><i class="fa fa-briefcase text-blue-600 text-xl mr-2"></i><span
                    class="text-gray-500">Total
                    Jobs Applied</span></div>
            <div class="text-2xl font-bold text-gray-800">{{ $totalJobs }}</div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow flex flex-col items-start">
            <div class="flex items-center mb-2"><i class="fa fa-calendar-check text-green-600 text-xl mr-2"></i><span
                    class="text-gray-500">Interviews Scheduled</span></div>
            <div class="text-2xl font-bold text-gray-800">{{ $interviews }}</div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow flex flex-col items-start">
            <div class="flex items-center mb-2"><i class="fa fa-handshake text-yellow-600 text-xl mr-2"></i><span
                    class="text-gray-500">Offers Received</span></div>
            <div class="text-2xl font-bold text-gray-800">{{ $offers }}</div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow flex flex-col items-start">
            <div class="flex items-center mb-2"><i class="fa fa-times-circle text-red-600 text-xl mr-2"></i><span
                    class="text-gray-500">Jobs Rejected</span></div>
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
        <div class="bg-white p-6 rounded-lg shadow flex flex-col col-span-1">
            <div class="font-semibold mb-4">Upcoming Events</div>
            <ul class="space-y-4">
                @foreach($upcomingEvents as $event)
                    <li class="flex items-center justify-between">
                        <div>
                            @if($event['type'] === 'Interview')
                                <div class="font-semibold text-gray-800">Interview: {{ $event['position'] }}</div>
                                <div class="text-gray-500 text-sm">at {{ $event['company'] }}</div>
                                <div class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($event['date'])->translatedFormat('l, d M Y') }}, {{ $event['time'] }}</div>
                            @else
                                <div class="font-semibold text-gray-800">Task: {{ $event['title'] }}</div>
                                <div class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($event['date'])->translatedFormat('l, d M Y') }}, {{ $event['time'] }}</div>
                            @endif
                        </div>
                        <span class="bg-{{ $event['type'] === 'Interview' ? 'green' : 'blue' }}-100 text-{{ $event['type'] === 'Interview' ? 'green' : 'blue' }}-700 px-2 py-1 rounded text-xs">{{ $event['type'] }}</span>
                    </li>
                @endforeach
            </ul>
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
        "Success is not the key to happiness. Happiness is the key to success. If you love what you are
        doing, you will be successful."
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