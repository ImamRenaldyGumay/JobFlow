@extends('layouts.app')
@section('title', 'Calendar - JobFlow')
@section('content')
    <div class="min-h-screen bg-gray-50 py-10 px-2 md:px-0">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">My Schedule</h1>
                <div class="flex gap-4">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 bg-blue-600 rounded-full"></span>
                        <span class="text-sm text-gray-600">Interview</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 bg-red-500 rounded-full"></span>
                        <span class="text-sm text-gray-600">Deadline</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                        <span class="text-sm text-gray-600">Task</span>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-8">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet">
    <style>
        .fc-event {
            cursor: pointer;
            padding: 2px 4px;
        }

        .fc-event:hover {
            opacity: 0.9;
        }

        .fc-toolbar-title {
            font-size: 1.5em !important;
            font-weight: 600 !important;
        }

        .fc-button-primary {
            background-color: #2563eb !important;
            border-color: #2563eb !important;
        }

        .fc-button-primary:hover {
            background-color: #1d4ed8 !important;
            border-color: #1d4ed8 !important;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                editable: true,
                droppable: true,
                events: [
                    {
                        title: 'Interview: Software Engineer at Tech Corp',
                        start: '2024-06-25T10:00:00',
                        end: '2024-06-25T11:00:00',
                        backgroundColor: '#2563eb',
                        borderColor: '#2563eb',
                    },
                    {
                        title: 'Deadline: Upload CV Update',
                        start: '2024-06-26',
                        backgroundColor: '#ef4444',
                        borderColor: '#ef4444',
                    },
                    {
                        title: 'Task: Complete Assessment Test',
                        start: '2024-06-27T14:00:00',
                        end: '2024-06-27T15:00:00',
                        backgroundColor: '#10b981',
                        borderColor: '#10b981',
                    }
                ],
                eventClick: function (info) {
                    Swal.fire({
                        title: info.event.title,
                        html: `
                                    <div class="text-left">
                                        <p><strong>Start:</strong> ${info.event.start ? info.event.start.toLocaleString() : 'N/A'}</p>
                                        <p><strong>End:</strong> ${info.event.end ? info.event.end.toLocaleString() : 'N/A'}</p>
                                        <p class="mt-4"><strong>Status:</strong> <span class="text-blue-600">Upcoming</span></p>
                                        <p><strong>Company:</strong> Tech Corp</p>
                                        <p><strong>Position:</strong> Software Engineer</p>
                                    </div>
                                `,
                        icon: 'info',
                        confirmButtonColor: '#2563eb',
                    });
                },
                eventDrop: function (info) {
                    Swal.fire({
                        title: 'Event Moved',
                        text: 'Event has been moved to ' + info.event.start.toLocaleDateString(),
                        icon: 'success',
                        confirmButtonColor: '#2563eb',
                    });
                }
            });
            calendar.render();
        });
    </script>
@endpush