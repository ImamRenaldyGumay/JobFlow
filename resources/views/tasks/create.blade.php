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
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deadline</label>
                        <input type="date" name="deadline" value="{{ old('deadline') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition @error('deadline') border-red-500 @enderror">
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