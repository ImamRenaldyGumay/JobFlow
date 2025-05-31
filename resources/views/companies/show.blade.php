@extends('layouts.app')
@section('title', $company->name . ' - JobFlow')
@section('content')
    <div class="min-h-screen bg-gray-50 py-10 px-2 md:px-0">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-3">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('companies.index') }}" class="text-gray-500 hover:text-blue-600">
                        <i class="fa fa-arrow-left"></i>
                    </a>
                    <h1 class="text-2xl font-bold text-gray-800">{{ $company->name }}</h1>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('companies.edit', $company) }}"
                        class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white rounded-md font-semibold shadow hover:bg-yellow-700 transition">
                        <i class="fa fa-edit mr-2"></i>Edit
                    </a>
                    <form action="{{ route('companies.destroy', $company) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md font-semibold shadow hover:bg-red-700 transition"
                            onclick="return confirm('Are you sure you want to delete this company?')">
                            <i class="fa fa-trash mr-2"></i>Delete
                        </button>
                    </form>
                </div>
            </div>

            <!-- Company Info -->
            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <div class="flex items-start space-x-6">
                    @if($company->logo)
                        <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }}"
                            class="w-24 h-24 rounded-lg object-cover">
                    @else
                        <div class="w-24 h-24 rounded-lg bg-blue-100 flex items-center justify-center">
                            <i class="fa fa-building text-blue-600 text-4xl"></i>
                        </div>
                    @endif
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h2 class="text-xl font-bold text-gray-800">{{ $company->name }}</h2>
                                <p class="text-gray-500">{{ $company->industry }}</p>
                            </div>
                            <span
                                class="px-3 py-1 text-sm font-semibold rounded-full {{ $company->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ ucfirst($company->status) }}
                            </span>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if($company->website)
                                <div>
                                    <p class="text-sm text-gray-500">Website</p>
                                    <a href="{{ $company->website }}" target="_blank"
                                        class="text-blue-600 hover:underline">{{ $company->website }}</a>
                                </div>
                            @endif
                            @if($company->location)
                                <div>
                                    <p class="text-sm text-gray-500">Location</p>
                                    <p class="text-gray-800">{{ $company->location }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @if($company->description)
                    <div class="mt-6 pt-6 border-t">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">About</h3>
                        <p class="text-gray-600">{{ $company->description }}</p>
                    </div>
                @endif
            </div>

            <!-- Jobs -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Jobs at {{ $company->name }}</h2>
                    <a href="{{ route('jobs.create') }}?company={{ $company->name }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md font-semibold shadow hover:bg-blue-700 transition">
                        <i class="fa fa-plus mr-2"></i>Add Job
                    </a>
                </div>
                @if($company->jobs->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="text-left text-gray-500 border-b">
                                    <th class="pb-3">Position</th>
                                    <th class="pb-3">Date Applied</th>
                                    <th class="pb-3">Status</th>
                                    <th class="pb-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($company->jobs as $job)
                                    <tr class="border-b">
                                        <td class="py-3">
                                            <div class="font-semibold text-gray-800">{{ $job->position }}</div>
                                            <div class="text-sm text-gray-500">{{ $job->location }}</div>
                                        </td>
                                        <td class="py-3 text-gray-600">
                                            {{ $job->date_applied ? \Carbon\Carbon::parse($job->date_applied)->format('M d, Y') : 'Not specified' }}
                                        </td>
                                        <td class="py-3">
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
                                        <td class="py-3">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('jobs.show', $job) }}" class="text-blue-600 hover:text-blue-800"
                                                    title="View Details">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('jobs.edit', $job) }}"
                                                    class="text-yellow-600 hover:text-yellow-800" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('jobs.destroy', $job) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800" title="Delete"
                                                        onclick="return confirm('Are you sure you want to delete this job?')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="text-gray-400 mb-4">
                            <i class="fa fa-briefcase text-4xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">No Jobs Found</h3>
                        <p class="text-gray-600 mb-4">Start by adding a job for this company.</p>
                        <a href="{{ route('jobs.create') }}?company={{ $company->name }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md font-semibold shadow hover:bg-blue-700 transition">
                            <i class="fa fa-plus mr-2"></i>Add Job
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection