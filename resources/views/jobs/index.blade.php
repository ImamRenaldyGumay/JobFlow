@extends('layouts.app')
@section('title', 'All Jobs - JobFlow')
@section('content')
    <div class="min-h-screen bg-gray-50 py-10 px-2 md:px-0">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-3">
                <h1 class="text-2xl font-bold text-gray-800">My Job Applications</h1>
                <div class="flex gap-2 items-center">
                    <select id="statusFilter"
                        class="border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600 bg-white">
                        <option value="">All Status</option>
                        <option value="Applied">Applied</option>
                        <option value="Interview">Interview</option>
                        <option value="Offer">Offer</option>
                        <option value="Rejected">Rejected</option>
                    </select>
                    <a href="{{ route('jobs.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md font-semibold shadow hover:bg-blue-700 transition">
                        <i class="fa fa-plus mr-2"></i>Add Application
                    </a>
                </div>
            </div>

            <!-- Jobs List -->
            <div class="bg-white rounded-lg shadow p-4 md:p-6">
                <div class="overflow-x-auto">
                    <table id="jobsTable" class="min-w-full divide-y divide-gray-200 border border-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Position</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Company</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Applied Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($jobs as $job)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $job->position }}</div>
                                        <div class="text-sm text-gray-500">{{ $job->location }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $job->company_name }}</div>
                                        <div class="text-sm text-gray-500">{{ $job->applied_via }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ $job->date_applied ? \Carbon\Carbon::parse($job->date_applied)->format('M d, Y') : 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusColors = [
                                                'Applied' => 'bg-blue-100 text-blue-700',
                                                'Interview' => 'bg-yellow-100 text-yellow-800',
                                                'Offer' => 'bg-green-100 text-green-700',
                                                'Rejected' => 'bg-red-100 text-red-700',
                                            ];
                                            $status = $job->application_status ?? 'Applied';
                                            $badge = $statusColors[$status] ?? $statusColors['Applied'];
                                        @endphp
                                        <span
                                            class="px-3 py-1 text-xs font-bold rounded-full {{ $badge }} shadow-sm border border-gray-200">
                                            {{ $status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('jobs.show', $job) }}" class="text-blue-600 hover:text-blue-900"
                                                title="View Details">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('jobs.edit', $job) }}"
                                                class="text-yellow-600 hover:text-yellow-900" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{ route('jobs.destroy', $job) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" title="Delete"
                                                    onclick="return confirm('Are you sure you want to delete this job?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                        No jobs found. <a href="{{ route('jobs.create') }}"
                                            class="text-blue-600 hover:text-blue-900">Add your first application</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Application Modal -->
    <div id="addApplicationModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
            <div class="relative bg-white rounded-lg max-w-2xl w-full p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Add New Application</h3>
                    <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeAddApplicationModal()">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <form action="{{ route('jobs.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Position</label>
                            <input type="text" name="position" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Company</label>
                            <input type="text" name="company_name" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Location</label>
                            <input type="text" name="location"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Applied Date</label>
                            <div class="date-input-wrapper">
                                <input type="text" name="date_applied" id="date_applied"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Applied Via</label>
                            <input type="text" name="applied_via"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Job Link</label>
                            <input type="url" name="apply_link"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Notes</label>
                        <textarea name="notes" rows="3"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeAddApplicationModal()"
                            class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Save Application
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Job Details Modal -->
    <div id="jobDetailsModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
            <div class="relative bg-white rounded-lg max-w-3xl w-full p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Job Application Details</h3>
                    <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeJobDetails()">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div id="jobDetailsContent" class="space-y-4">
                    <!-- Content will be loaded dynamically -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">
    <style>
        /* Custom DataTables Styling */
        .dataTables_wrapper .dataTables_length select {
            @apply border border-gray-300 rounded-md shadow-sm py-1 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500;
        }

        .dataTables_wrapper .dataTables_filter input {
            @apply border border-gray-300 rounded-md shadow-sm py-1 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            @apply px-3 py-1 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 border border-gray-300;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            @apply bg-blue-600 text-white hover:bg-blue-700 border-blue-600;
        }

        .dataTables_wrapper .dataTables_info {
            @apply text-sm text-gray-700;
        }

        .dataTables_wrapper .dataTables_processing {
            @apply bg-white border border-gray-300 rounded-lg shadow-lg p-4;
        }

        /* Table Header Styling */
        #jobsTable thead th {
            @apply bg-gray-50 text-gray-500 border-b border-gray-200;
        }

        /* Table Border Styling */
        #jobsTable td,
        #jobsTable th {
            @apply border-r border-gray-200;
        }

        #jobsTable td:last-child,
        #jobsTable th:last-child {
            @apply border-r-0;
        }

        /* Hover Effect */
        #jobsTable tbody tr {
            @apply transition-colors duration-200;
        }

        #jobsTable tbody tr:hover {
            @apply bg-gray-50;
        }

        /* Flatpickr Custom Styling */
        .flatpickr-calendar {
            @apply shadow-lg rounded-lg border border-gray-200;
        }

        .flatpickr-day.selected {
            @apply bg-blue-600 border-blue-600;
        }

        .flatpickr-day.today {
            @apply border-blue-600;
        }

        .flatpickr-day:hover {
            @apply bg-blue-50;
        }

        .flatpickr-months .flatpickr-month {
            @apply bg-gray-50;
        }

        .flatpickr-current-month {
            @apply py-2;
        }

        .flatpickr-weekday {
            @apply text-gray-600 font-medium;
        }

        .flatpickr-day {
            @apply text-gray-700;
        }

        .flatpickr-day.disabled {
            @apply text-gray-400 cursor-not-allowed;
        }

        .flatpickr-day.disabled:hover {
            @apply bg-transparent;
        }

        .flatpickr-input {
            @apply bg-white;
        }

        /* Date Input Styling */
        .date-input-wrapper {
            @apply relative;
        }

        .date-input-wrapper .flatpickr-input {
            @apply pl-10;
        }

        .date-input-wrapper::before {
            content: '\f073';
            font-family: 'Font Awesome 5 Free';
            @apply absolute left-3 top-1/2 -translate-y-1/2 text-gray-400;
        }

        .date-input-wrapper .flatpickr-input:focus {
            @apply ring-2 ring-blue-500 border-blue-500;
        }
    </style>
@endpush

@push('scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        function showAddApplicationModal() {
            document.getElementById('addApplicationModal').classList.remove('hidden');
        }

        function closeAddApplicationModal() {
            document.getElementById('addApplicationModal').classList.add('hidden');
        }

        function showJobDetails(jobId) {
            // Load job details via AJAX
            fetch(`/jobs/${jobId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('jobDetailsContent').innerHTML = `
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <h4 class="font-medium text-gray-700">Position</h4>
                                        <p class="text-gray-900">${data.position}</p>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-700">Company</h4>
                                        <p class="text-gray-900">${data.company_name}</p>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-700">Applied Date</h4>
                                        <p class="text-gray-900">${data.date_applied}</p>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-700">Status</h4>
                                        <p class="text-gray-900">${data.application_status}</p>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h4 class="font-medium text-gray-700">Documents</h4>
                                    <div class="mt-2 space-y-2">
                                        <a href="${data.cv_url}" target="_blank" class="text-blue-600 hover:text-blue-900">
                                            <i class="fa fa-file-pdf"></i> View CV
                                        </a>
                                        ${data.cover_letter_url ? `
                                            <br>
                                            <a href="${data.cover_letter_url}" target="_blank" class="text-blue-600 hover:text-blue-900">
                                                <i class="fa fa-file-pdf"></i> View Cover Letter
                                            </a>
                                        ` : ''}
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h4 class="font-medium text-gray-700">Timeline</h4>
                                    <div class="mt-2 space-y-2">
                                        ${data.timeline.map(event => `
                                            <div class="flex items-start">
                                                <div class="flex-shrink-0">
                                                    <div class="h-2 w-2 mt-2 rounded-full bg-blue-600"></div>
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-sm text-gray-900">${event.description}</p>
                                                    <p class="text-xs text-gray-500">${event.date}</p>
                                                </div>
                                            </div>
                                        `).join('')}
                                    </div>
                                </div>
                            `;
                    document.getElementById('jobDetailsModal').classList.remove('hidden');
                });
        }

        function closeJobDetails() {
            document.getElementById('jobDetailsModal').classList.add('hidden');
        }

        $(document).ready(function () {
            // Initialize DataTable
            const table = $('#jobsTable').DataTable({
                responsive: true,
                order: [[2, 'desc']], // Sort by Applied Date column (index 2) in descending order
                columnDefs: [
                    {
                        targets: 2, // Applied Date column
                        type: 'date' // Specify that this column contains dates
                    }
                ],
                language: {
                    search: "Search jobs:",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ applications",
                    paginate: {
                        previous: "<",
                        next: ">"
                    }
                },
                dom: '<"flex flex-wrap items-center justify-between gap-4 mb-4"lf>rt<"flex flex-wrap items-center justify-between gap-4 mt-4"ip>'
            });

            // Status filter functionality
            $('#statusFilter').on('change', function () {
                const status = $(this).val();
                table.column(3).search(status).draw();
            });
        });

        // Initialize Flatpickr for all date inputs
        document.addEventListener('DOMContentLoaded', function () {
            const today = new Date();
            const oneYearAgo = new Date();
            oneYearAgo.setFullYear(today.getFullYear() - 1);

            // Common Flatpickr configuration
            const flatpickrConfig = {
                dateFormat: "Y-m-d",
                maxDate: today,
                minDate: oneYearAgo,
                theme: "material_blue",
                disableMobile: "true",
                onChange: function (selectedDates, dateStr) {
                    const selectedDate = selectedDates[0];
                    if (selectedDate > today) {
                        alert('Applied date cannot be in the future');
                        this.setDate(today);
                    } else if (selectedDate < oneYearAgo) {
                        alert('Applied date cannot be more than 1 year ago');
                        this.setDate(oneYearAgo);
                    }
                }
            };

            // Initialize for Add Application form
            flatpickr("#date_applied", flatpickrConfig);

            // Initialize for Edit Application form
            flatpickr(".edit-date-applied", flatpickrConfig);
        });
    </script>
@endpush