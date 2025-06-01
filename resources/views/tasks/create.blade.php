@extends('layouts.app')
@section('title', 'Add Task - JobFlow')
@section('content')
    <div class="min-h-screen bg-gray-50 py-10 px-2 md:px-0">
        <div class="max-w-xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Add New Task</h1>
            <div class="bg-white rounded-lg shadow-lg p-8">
                <form action="{{ route('tasks.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Title <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title') }}" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition placeholder-gray-400 @error('title') border-red-500 @enderror"
                            placeholder="e.g. Update CV">
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" rows="3"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition placeholder-gray-400 @error('description') border-red-500 @enderror"
                            placeholder="Task description...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Task Type</label>
                        <select name="type" id="type" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                            <option value="general" {{ old('type') == 'general' ? 'selected' : '' }}>General</option>
                            <option value="interview" {{ old('type') == 'interview' ? 'selected' : '' }}>Interview</option>
                            <option value="followup" {{ old('type') == 'followup' ? 'selected' : '' }}>Follow Up</option>
                            <option value="send_application" {{ old('type') == 'send_application' ? 'selected' : '' }}>Send Application</option>
                            <option value="send_document" {{ old('type') == 'send_document' ? 'selected' : '' }}>Send Document</option>
                            <option value="prepare_portfolio" {{ old('type') == 'prepare_portfolio' ? 'selected' : '' }}>Prepare Portfolio</option>
                            <option value="prepare_interview" {{ old('type') == 'prepare_interview' ? 'selected' : '' }}>Prepare for Interview</option>
                            <option value="networking" {{ old('type') == 'networking' ? 'selected' : '' }}>Networking</option>
                            <option value="research_company" {{ old('type') == 'research_company' ? 'selected' : '' }}>Research Company</option>
                            <option value="update_resume" {{ old('type') == 'update_resume' ? 'selected' : '' }}>Update Resume</option>
                            <option value="thank_you_note" {{ old('type') == 'thank_you_note' ? 'selected' : '' }}>Thank You Note</option>
                            <option value="skill_improvement" {{ old('type') == 'skill_improvement' ? 'selected' : '' }}>Skill Improvement</option>
                            <option value="job_fair" {{ old('type') == 'job_fair' ? 'selected' : '' }}>Job Fair</option>
                            <option value="assessment" {{ old('type') == 'assessment' ? 'selected' : '' }}>Assessment/Test</option>
                        </select>
                    </div>
                    <div id="interview-fields" style="display: none;">
                        <label class="block text-sm font-medium text-gray-700 mb-1 mt-2">Location</label>
                        <input type="text" name="location" value="{{ old('location') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 mb-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Link</label>
                        <input type="text" name="link" value="{{ old('link') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Applied Date</label>
                        <div class="relative flex items-center">
                            <span class="absolute left-3 inset-y-0 flex items-center pointer-events-none">
                                <i class="fa fa-calendar text-gray-400 text-lg"></i>
                            </span>
                            <input type="text" name="deadline" id="deadline" value="{{ old('deadline') }}"
                                class="flatpickr-input w-full border border-gray-300 rounded-lg py-2 pl-10 pr-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('deadline') border-red-500 @enderror"
                                placeholder="YYYY-MM-DD" autocomplete="off" readonly style="height: 44px; line-height: 1.5;" >
                        </div>
                        @error('deadline')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status <span
                                class="text-red-500">*</span></label>
                        <select name="status" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition @error('status') border-red-500 @enderror">
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress
                            </option>
                            <option value="done" {{ old('status') == 'done' ? 'selected' : '' }}>Done</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-between items-center pt-6">
                        <a href="{{ route('tasks.index') }}"
                            class="text-gray-500 hover:text-blue-600 font-medium flex items-center">
                            <i class="fa fa-arrow-left mr-2"></i>Back to Tasks
                        </a>
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-2 rounded-lg font-semibold shadow transition flex items-center gap-2">
                            <i class="fa fa-save"></i> Save Task
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
        .flatpickr-input {
            background: #fff;
        }
        /* Ensure icon is vertically centered */
        .fa-calendar {
            font-size: 1.15rem;
            vertical-align: middle;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Show/hide interview fields
            function toggleInterviewFields() {
                var type = document.getElementById('type').value;
                document.getElementById('interview-fields').style.display = (type === 'interview') ? '' : 'none';
            }
            document.getElementById('type').addEventListener('change', toggleInterviewFields);
            toggleInterviewFields(); // initial

            // Flatpickr config
            const today = new Date();
            const oneYearLater = new Date();
            oneYearLater.setFullYear(today.getFullYear() + 1);
            flatpickr("#deadline", {
                dateFormat: "Y-m-d",
                minDate: today,
                maxDate: oneYearLater,
                theme: "material_blue",
                disableMobile: "true",
                onChange: function (selectedDates, dateStr) {
                    const selectedDate = selectedDates[0];
                    if (selectedDate < today) {
                        alert('Deadline must be a future date');
                        this.setDate(today);
                    } else if (selectedDate > oneYearLater) {
                        alert('Deadline cannot be more than 1 year from now');
                        this.setDate(oneYearLater);
                    }
                }
            });
        });
    </script>
@endpush