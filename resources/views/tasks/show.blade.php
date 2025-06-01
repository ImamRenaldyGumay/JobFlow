@extends('layouts.app')
@section('title', 'Task Details - ' . $task->title)
@section('content')
    <div class="min-h-screen bg-gray-50 py-10 px-2 md:px-0">
        <div class="max-w-xl mx-auto">
            <div class="flex items-center mb-6 gap-3">
                <a href="{{ route('tasks.index') }}" class="text-gray-500 hover:text-blue-600">
                    <i class="fa fa-arrow-left"></i>
                </a>
                <h1 class="text-2xl font-bold text-gray-800">Task Details</h1>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-8">
                <dl class="divide-y divide-gray-200">
                    <div class="py-3 flex justify-between">
                        <dt class="font-medium text-gray-600">Title</dt>
                        <dd class="text-gray-900">{{ $task->title }}</dd>
                    </div>
                    <div class="py-3 flex justify-between">
                        <dt class="font-medium text-gray-600">Description</dt>
                        <dd class="text-gray-900">{{ $task->description ?? '-' }}</dd>
                    </div>
                    <div class="py-3 flex justify-between">
                        <dt class="font-medium text-gray-600">Type</dt>
                        <dd class="text-gray-900 capitalize">{{ str_replace('_', ' ', $task->type ?? 'general') }}</dd>
                    </div>
                    @if($task->type === 'interview' && ($task->location || $task->link))
                        <div class="py-3 flex justify-between">
                            <dt class="font-medium text-gray-600">Location</dt>
                            <dd class="text-gray-900">{{ $task->location ?? '-' }}</dd>
                        </div>
                        <div class="py-3 flex justify-between">
                            <dt class="font-medium text-gray-600">Link</dt>
                            <dd class="text-blue-700">{{ $task->link ? $task->link : '-' }}</dd>
                        </div>
                    @endif
                    <div class="py-3 flex justify-between">
                        <dt class="font-medium text-gray-600">Deadline</dt>
                        <dd class="text-gray-900">{{ $task->deadline ?? '-' }}</dd>
                    </div>
                    <div class="py-3 flex justify-between">
                        <dt class="font-medium text-gray-600">Status</dt>
                        <dd class="text-gray-900 capitalize">{{ str_replace('_', ' ', $task->status) }}</dd>
                    </div>
                </dl>
                <div class="flex justify-end gap-2 mt-8">
                    <a href="{{ route('tasks.edit', $task) }}"
                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Edit
                    </a>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline delete-task-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.delete-task-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This action cannot be undone!',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush