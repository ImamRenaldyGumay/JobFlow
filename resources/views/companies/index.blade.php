@extends('layouts.app')
@section('title', 'Companies - JobFlow')
@section('content')
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-3">
        <h1 class="text-2xl font-bold text-gray-800">Companies</h1>
        <a href="{{ route('companies.create') }}"
            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md font-semibold shadow hover:bg-blue-700 transition">
            <i class="fa fa-plus mr-2"></i>Add Company
        </a>
    </div>

    <!-- Companies Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($companies as $company)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            @if($company->logo)
                                <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }}"
                                    class="w-12 h-12 rounded-lg object-cover">
                            @else
                                <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
                                    <i class="fa fa-building text-blue-600 text-xl"></i>
                                </div>
                            @endif
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">{{ $company->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $company->industry }}</p>
                            </div>
                        </div>
                        <span
                            class="px-2 py-1 text-xs font-semibold rounded-full {{ $company->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ ucfirst($company->status) }}
                        </span>
                    </div>
                    <div class="space-y-2 mb-4">
                        @if($company->location)
                            <p class="text-sm text-gray-600"><i class="fa fa-map-marker-alt mr-2"></i>{{ $company->location }}</p>
                        @endif
                        @if($company->website)
                            <p class="text-sm text-gray-600"><i class="fa fa-globe mr-2"></i><a href="{{ $company->website }}"
                                    target="_blank" class="text-blue-600 hover:underline">{{ $company->website }}</a></p>
                        @endif
                        <p class="text-sm text-gray-600"><i class="fa fa-briefcase mr-2"></i>{{ $company->jobs_count }} Jobs</p>
                    </div>
                    @if($company->description)
                        <p class="text-sm text-gray-600 mb-4">{{ Str::limit($company->description, 100) }}</p>
                    @endif
                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('companies.show', $company) }}" class="text-blue-600 hover:text-blue-800"
                            title="View Details">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="{{ route('companies.edit', $company) }}" class="text-yellow-600 hover:text-yellow-800"
                            title="Edit">
                            <i class="fa fa-edit"></i>
                        </a>
                        <form action="{{ route('companies.destroy', $company) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800" title="Delete"
                                onclick="return confirm('Are you sure you want to delete this company?')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                    <div class="text-gray-400 mb-4">
                        <i class="fa fa-building text-4xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">No Companies Found</h3>
                    <p class="text-gray-600 mb-4">Start by adding your first company to track.</p>
                    <a href="{{ route('companies.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md font-semibold shadow hover:bg-blue-700 transition">
                        <i class="fa fa-plus mr-2"></i>Add Company
                    </a>
                </div>
            </div>
        @endforelse
    </div>
@endsection