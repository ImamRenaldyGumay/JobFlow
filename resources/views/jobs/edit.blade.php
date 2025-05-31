@extends('layouts.app')
@section('title', 'Edit Job - ' . $job->position)
@section('content')
    <div class="min-h-screen bg-gray-50 py-10 px-2 md:px-0">
        <div class="max-w-2xl mx-auto">
            <div class="flex items-center mb-6 gap-3">
                <a href="{{ route('jobs.show', $job) }}" class="text-gray-500 hover:text-blue-600">
                    <i class="fa fa-arrow-left"></i>
                </a>
                <h1 class="text-2xl font-bold text-gray-800">Edit Job</h1>
            </div>
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <form action="{{ route('jobs.update', $job) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Company Name <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="company_name" value="{{ old('company_name', $job->company_name) }}"
                                required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition placeholder-gray-400 @error('company_name') border-red-500 @enderror"
                                placeholder="e.g. Google">
                            @error('company_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Position <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="position" value="{{ old('position', $job->position) }}" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition placeholder-gray-400 @error('position') border-red-500 @enderror"
                                placeholder="e.g. Frontend Developer">
                            @error('position')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                            <input type="text" name="location" value="{{ old('location', $job->location) }}"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition placeholder-gray-400 @error('location') border-red-500 @enderror"
                                placeholder="e.g. Jakarta">
                            @error('location')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date Applied</label>
                            <div class="relative">
                                <input type="text" name="date_applied"
                                    class="edit-date-applied flatpickr-input w-full border border-gray-300 rounded-lg px-4 py-2 pl-10 pr-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition @error('date_applied') border-red-500 @enderror"
                                    placeholder="Select date..."
                                    value="{{ old('date_applied', $job->date_applied ? \Carbon\Carbon::parse($job->date_applied)->format('Y-m-d') : '') }}"
                                    readonly>
                                <span
                                    class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </div>
                            @error('date_applied')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Applied Via</label>
                            <input type="text" name="applied_via" value="{{ old('applied_via', $job->applied_via) }}"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition placeholder-gray-400 @error('applied_via') border-red-500 @enderror"
                                placeholder="e.g. LinkedIn">
                            @error('applied_via')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Apply Link</label>
                            <input type="url" name="apply_link" value="{{ old('apply_link', $job->apply_link) }}"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition placeholder-gray-400 @error('apply_link') border-red-500 @enderror"
                                placeholder="e.g. https://jobs.com/apply">
                            @error('apply_link')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Application Status</label>
                            <select name="application_status"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition @error('application_status') border-red-500 @enderror">
                                <option value="">- Select Status -</option>
                                <option value="Applied" {{ old('application_status', $job->application_status) == 'Applied' ? 'selected' : '' }}>Applied</option>
                                <option value="Interview" {{ old('application_status', $job->application_status) == 'Interview' ? 'selected' : '' }}>Interview</option>
                                <option value="Offer" {{ old('application_status', $job->application_status) == 'Offer' ? 'selected' : '' }}>Offer</option>
                                <option value="Rejected" {{ old('application_status', $job->application_status) == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                            @error('application_status')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Result</label>
                            <input type="text" name="result" value="{{ old('result', $job->result) }}"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition placeholder-gray-400 @error('result') border-red-500 @enderror"
                                placeholder="e.g. Passed, Failed, Waiting">
                            @error('result')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                            <textarea name="notes" rows="4"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition placeholder-gray-400 @error('notes') border-red-500 @enderror"
                                placeholder="Add any notes...">{{ old('notes', $job->notes) }}</textarea>
                            @error('notes')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="flex justify-end gap-2 mt-8">
                        <a href="{{ route('jobs.show', $job) }}"
                            class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Save Changes
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

            flatpickr(".edit-date-applied", {
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