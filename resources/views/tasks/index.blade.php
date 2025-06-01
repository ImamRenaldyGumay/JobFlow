@extends('layouts.app')
@section('title', 'Tasks - JobFlow')
@section('content')
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-3">
        <h1 class="text-2xl font-bold text-gray-800">Tasks</h1>
        <a href="{{ route('tasks.create') }}"
            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md font-semibold shadow hover:bg-blue-700 transition">
            <i class="fa fa-plus mr-2"></i>Add Task
        </a>
    </div>
    <div class="bg-white p-4 rounded-lg shadow mb-6 flex flex-wrap gap-4 items-center">
        <div>
            <select class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">
                <option value="">All Status</option>
                <option value="pending">Pending</option>
                <option value="in_progress">In Progress</option>
                <option value="done">Done</option>
            </select>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-4 md:p-6">
        <div class="overflow-x-auto">
            <table id="tasksTable" class="min-w-full divide-y divide-gray-200 border border-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Task</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deadline
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($tasks as $task)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap font-semibold text-gray-800">{{ $task->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $task->description }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $task->deadline }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'in_progress' => 'bg-blue-100 text-blue-700',
                                        'done' => 'bg-green-100 text-green-700',
                                    ];
                                    $badge = $statusColors[$task->status] ?? 'bg-gray-100 text-gray-600';
                                @endphp
                                <span
                                    class="px-3 py-1 text-xs font-bold rounded-full {{ $badge }} shadow-sm border border-gray-200">{{ ucfirst(str_replace('_', ' ', $task->status)) }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap font-medium flex gap-2">
                                <a href="{{ route('tasks.show', $task) }}" class="text-blue-600 hover:text-blue-900" title="View Details">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('tasks.edit', $task) }}" class="text-blue-600 hover:text-blue-900" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button class="text-red-600 hover:text-red-900" title="Delete"><i
                                        class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-12 text-gray-400 text-lg">No tasks found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#tasksTable').DataTable({
                responsive: true,
                language: {
                    search: "Search tasks:",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ tasks",
                    paginate: {
                        previous: "<",
                        next: ">"
                    }
                },
                dom: '<"flex flex-wrap items-center justify-between gap-4 mb-4"lf>rt<"flex flex-wrap items-center justify-between gap-4 mt-4"ip>'
            });
        });
    </script>
@endpush