@extends('layouts.app')
@section('title', 'All Jobs - JobFlow')
@section('content')
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-3">
        <h1 class="text-2xl font-bold text-gray-800">All Jobs</h1>
        <a href="{{ route('jobs.create') }}"
            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md font-semibold shadow hover:bg-blue-700 transition">
            <i class="fa fa-plus mr-2"></i>Add Job
        </a>
    </div>

    <!-- Filters & Search -->
    <div class="bg-white p-4 rounded-lg shadow mb-6">
        <div class="flex flex-col md:flex-row gap-4">
            <!-- Search -->
            <div class="flex-1">
                <div class="relative">
                    <input type="text" id="customSearchJobs" placeholder="Search jobs..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <i class="fa fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div>
            <!-- Status Filter -->
            <div class="flex gap-2">
                <select id="statusFilter"
                    class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <option value="">All Status</option>
                    <option value="Applied">Applied</option>
                    <option value="Interview">Interview</option>
                    <option value="Offer">Offer</option>
                    <option value="Rejected">Rejected</option>
                </select>
                <select id="sortFilter"
                    class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <option value="newest">Newest First</option>
                    <option value="oldest">Oldest First</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Jobs Table -->
    <div class="bg-white rounded-2xl shadow-xl p-4 md:p-8">
        <div class="overflow-x-auto">
            <table id="jobsTable" class="w-full rounded-xl overflow-hidden">
                <thead>
                    <tr>
                        <th>Company Name</th>
                        <th>Position</th>
                        <th>Location</th>
                        <th>Date Applied</th>
                        <th>Application Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jobs as $job)
                        <tr>
                            <td class="font-semibold text-gray-800">{{ $job->company_name }}</td>
                            <td class="text-gray-700">{{ $job->position }}</td>
                            <td class="text-gray-600">{{ $job->location }}</td>
                            <td class="text-gray-500">{{ $job->date_applied }}</td>
                            <td>
                                @php
                                    $statusColors = [
                                        'Applied' => 'bg-blue-100 text-blue-700',
                                        'Interview' => 'bg-yellow-100 text-yellow-800',
                                        'Offer' => 'bg-green-100 text-green-700',
                                        'Rejected' => 'bg-red-100 text-red-700',
                                    ];
                                    $badge = $statusColors[$job->application_status] ?? 'bg-gray-100 text-gray-600';
                                @endphp
                                <span
                                    class="px-3 py-1 text-xs font-bold rounded-full {{ $badge }} shadow-sm border border-gray-200">{{ $job->application_status }}</span>
                            </td>
                            <td class="font-medium flex gap-2">
                                <a href="{{ route('jobs.show', $job) }}" class="text-blue-600 hover:text-blue-900"
                                    title="Detail">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('jobs.edit', $job) }}" class="text-yellow-600 hover:text-yellow-800"
                                    title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('jobs.destroy', $job) }}" method="POST" class="inline delete-job-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="text-red-600 hover:text-red-900 btn-delete-job" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-12 text-gray-400 text-lg">No jobs found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('scripts')
    <!-- DataTables Tailwind CDN & Custom CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .dataTables_wrapper .dataTables_filter input {
            @apply border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            @apply rounded-md border border-gray-200 px-3 py-1 mx-1 text-blue-600 hover:bg-blue-50 transition;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            @apply bg-blue-600 text-white;
        }

        .dataTables_wrapper .dataTables_length select {
            @apply border border-gray-300 rounded-lg px-2 py-1;
        }

        .dataTables_wrapper .dataTables_info {
            @apply text-gray-500;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.tailwindcss.min.js"></script>
    <script>
        $(document).ready(function () {
            var table = $('#jobsTable').DataTable({
                responsive: true,
                order: [[3, 'desc']], // Default: Newest First (Date Applied)
                language: {
                    search: "Search jobs:",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ jobs",
                    paginate: {
                        previous: "<",
                        next: ">"
                    }
                },
                dom: '<"flex flex-wrap items-center justify-between gap-4 mb-4"lf>rt<"flex flex-wrap items-center justify-between gap-4 mt-4"ip>'
            });

            // Hide default DataTables search
            $('.dataTables_filter').hide();

            // Custom search input
            $('#customSearchJobs').on('keyup change', function () {
                table.search(this.value).draw();
            });

            // Filter status
            $('#statusFilter').on('change', function () {
                var val = $(this).val();
                if (val) {
                    table.column(4).search('^' + val + '$', true, false).draw();
                } else {
                    table.column(4).search('').draw();
                }
            });

            // Sort by date applied
            $('#sortFilter').on('change', function () {
                var val = $(this).val();
                if (val === 'newest') {
                    table.order([3, 'desc']).draw();
                } else {
                    table.order([3, 'asc']).draw();
                }
            });

            // SweetAlert2 untuk konfirmasi hapus
            $('.btn-delete-job').on('click', function (e) {
                e.preventDefault();
                const form = $(this).closest('form');
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This job will be deleted permanently!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush