@extends('layouts.app')
@section('title', 'Add Application - JobFlow')
@section('content')
    <div class="min-h-screen bg-gray-50 py-10 px-2 md:px-0">
        <div class="max-w-3xl mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Add New Application</h1>
                <a href="{{ route('jobs.index') }}" class="text-gray-600 hover:text-gray-900">
                    <i class="fa fa-arrow-left mr-2"></i>Back to Applications
                </a>
            </div>

            <!-- Form -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <form action="{{ route('jobs.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Position <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="position" value="{{ old('position') }}" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('position') border-red-500 @enderror"
                                placeholder="e.g. Frontend Developer">
                            @error('position')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Company <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="company_name" value="{{ old('company_name') }}" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('company_name') border-red-500 @enderror"
                                placeholder="e.g. Google">
                            @error('company_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Location</label>
                            <input type="text" name="location" value="{{ old('location') }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('location') border-red-500 @enderror"
                                placeholder="e.g. Jakarta, Indonesia">
                            @error('location')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Applied Date</label>
                            <div class="relative">
                                <input type="text" name="date_applied" id="date_applied"
                                    class="flatpickr-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 pl-10 pr-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('date_applied') border-red-500 @enderror"
                                    placeholder="Select date..." value="{{ old('date_applied', date('Y-m-d')) }}" readonly>
                                <span
                                    class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </div>
                            @error('date_applied')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">Default is today, you can change it</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Applied Via</label>
                            <select name="applied_via" value="{{ old('applied_via') }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('applied_via') border-red-500 @enderror">
                                <option value="">Select platform</option>
                                <option value="LinkedIn" {{ old('applied_via') == 'LinkedIn' ? 'selected' : '' }}>LinkedIn
                                </option>
                                <option value="JobStreet" {{ old('applied_via') == 'JobStreet' ? 'selected' : '' }}>JobStreet
                                </option>
                                <option value="Company Website" {{ old('applied_via') == 'Company Website' ? 'selected' : '' }}>Company Website</option>
                                <option value="Email" {{ old('applied_via') == 'Email' ? 'selected' : '' }}>Email</option>
                                <option value="Other" {{ old('applied_via') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('applied_via')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Job Link</label>
                            <input type="url" name="apply_link" value="{{ old('apply_link') }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('apply_link') border-red-500 @enderror"
                                placeholder="https://...">
                            @error('apply_link')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Notes</label>
                        <textarea name="notes" rows="4" value="{{ old('notes') }}"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('notes') border-red-500 @enderror"
                            placeholder="Add any notes about this application...">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('jobs.index') }}"
                            class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Save Application
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">
    <style>
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
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const today = new Date();
            const oneYearAgo = new Date();
            oneYearAgo.setFullYear(today.getFullYear() - 1);

            flatpickr("#date_applied", {
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
            });
        });
    </script>
@endpush