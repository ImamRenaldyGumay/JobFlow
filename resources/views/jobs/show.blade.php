@extends('layouts.app')
@section('title', 'Job Detail - ' . $job->position)
@section('content')
    <div class="min-h-screen bg-gray-50 py-10 px-2 md:px-0">
        <div class="max-w-2xl mx-auto">
            <div class="flex items-center mb-6 gap-3">
                <a href="{{ route('jobs.index') }}" class="text-gray-500 hover:text-blue-600">
                    <i class="fa fa-arrow-left"></i>
                </a>
                <h1 class="text-2xl font-bold text-gray-800">Job Detail</h1>
            </div>
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <div class="mb-6 flex items-center gap-4">
                    <div class="bg-blue-100 text-blue-600 rounded-full p-3">
                        <i class="fa fa-briefcase fa-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-800 mb-1">{{ $job->position }}</h2>
                        <p class="text-gray-500">{{ $job->company_name }}</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Location</p>
                        <p class="text-gray-800">{{ $job->location ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Date Applied</p>
                        <p class="text-gray-800">
                            {{ $job->date_applied ? \Carbon\Carbon::parse($job->date_applied)->format('M d, Y') : '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Applied Via</p>
                        <p class="text-gray-800">{{ $job->applied_via ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Apply Link</p>
                        @if($job->apply_link)
                            <a href="{{ $job->apply_link }}" target="_blank"
                                class="text-blue-600 hover:underline">{{ $job->apply_link }}</a>
                        @else
                            <span class="text-gray-800">-</span>
                        @endif
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Application Status</p>
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
                            class="px-3 py-1 text-xs font-bold rounded-full {{ $badge }} shadow-sm border border-gray-200">{{ $job->application_status ?? '-' }}</span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Result</p>
                        <p class="text-gray-800">{{ $job->result ?? '-' }}</p>
                    </div>
                </div>
                <div class="mb-6">
                    <p class="text-sm text-gray-500 mb-1">Notes</p>
                    <div class="bg-gray-50 rounded-lg p-4 min-h-[48px] text-gray-700">{{ $job->notes ?? '-' }}</div>
                </div>
                <div class="flex justify-end gap-2">
                    <a href="{{ route('jobs.edit', $job) }}"
                        class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white rounded-md font-semibold shadow hover:bg-yellow-700 transition">
                        <i class="fa fa-edit mr-2"></i>Edit
                    </a>
                    <form action="{{ route('jobs.destroy', $job) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md font-semibold shadow hover:bg-red-700 transition"
                            onclick="return confirm('Are you sure you want to delete this job?')">
                            <i class="fa fa-trash mr-2"></i>Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection