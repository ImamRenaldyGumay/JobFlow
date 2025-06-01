@extends('layouts.app')
@section('title', 'Calendar - JobFlow')
@section('content')
    <div class="min-h-screen bg-gray-50 py-10 px-2 md:px-0">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-3">
                <h1 class="text-2xl font-bold text-gray-800">Calendar</h1>
            </div>

            <!-- Legend -->
            <div class="bg-white rounded-lg shadow p-4 mb-6">
                <div class="flex flex-wrap gap-4">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 bg-blue-600 rounded-full"></span>
                        <span class="text-sm text-gray-600">Interview</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 bg-yellow-500 rounded-full"></span>
                        <span class="text-sm text-gray-600">Follow Up</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 bg-purple-600 rounded-full"></span>
                        <span class="text-sm text-gray-600">Assessment</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 bg-green-600 rounded-full"></span>
                        <span class="text-sm text-gray-600">Other Tasks</span>
                    </div>
                </div>
            </div>

            <!-- Calendar -->
            <div class="bg-white rounded-lg shadow p-4 md:p-6">
                <div class="flex justify-between items-center mb-4">
                    <button id="prevMonth" class="p-2 hover:bg-gray-100 rounded-full">
                        <i class="fa fa-chevron-left"></i>
                    </button>
                    <h2 id="currentMonth" class="text-xl font-semibold"></h2>
                    <button id="nextMonth" class="p-2 hover:bg-gray-100 rounded-full">
                        <i class="fa fa-chevron-right"></i>
                    </button>
                </div>
                <div class="grid grid-cols-7 gap-1">
                    <div class="text-center font-semibold text-gray-600 py-2">Sun</div>
                    <div class="text-center font-semibold text-gray-600 py-2">Mon</div>
                    <div class="text-center font-semibold text-gray-600 py-2">Tue</div>
                    <div class="text-center font-semibold text-gray-600 py-2">Wed</div>
                    <div class="text-center font-semibold text-gray-600 py-2">Thu</div>
                    <div class="text-center font-semibold text-gray-600 py-2">Fri</div>
                    <div class="text-center font-semibold text-gray-600 py-2">Sat</div>
                </div>
                <div id="calendarDays" class="grid grid-cols-7 gap-1"></div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const events = {!! json_encode($events) !!};
            let currentDate = new Date();
            
            function renderCalendar() {
                const year = currentDate.getFullYear();
                const month = currentDate.getMonth();
                
                // Update month display
                const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                document.getElementById('currentMonth').textContent = `${monthNames[month]} ${year}`;
                
                // Get first day of month and total days
                const firstDay = new Date(year, month, 1);
                const lastDay = new Date(year, month + 1, 0);
                const totalDays = lastDay.getDate();
                const startingDay = firstDay.getDay();
                
                // Clear previous calendar
                const calendarDays = document.getElementById('calendarDays');
                calendarDays.innerHTML = '';
                
                // Add empty cells for days before first of month
                for (let i = 0; i < startingDay; i++) {
                    calendarDays.appendChild(createDayElement(''));
                }
                
                // Add days of month
                for (let day = 1; day <= totalDays; day++) {
                    const date = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                    const dayEvents = events.filter(event => event.start.startsWith(date));
                    
                    const dayElement = createDayElement(day, dayEvents);
                    calendarDays.appendChild(dayElement);
                }
            }
            
            function createDayElement(day, events = []) {
                const div = document.createElement('div');
                div.className = 'min-h-[80px] p-2 border border-gray-200 relative';
                
                if (day) {
                    div.innerHTML = `
                        <span class="text-gray-700">${day}</span>
                        ${events.length ? `
                            <div class="mt-1 flex flex-col gap-1">
                                ${events.map(event => `
                                    <div class="text-xs px-2 py-1 rounded-full text-white ${getEventClass(event.extendedProps.type)}">
                                        ${event.title}
                                    </div>
                                `).join('')}
                            </div>
                        ` : ''}
                    `;
                    
                    // Add click handler for events
                    if (events.length) {
                        div.addEventListener('click', () => showEventDetails(events));
                    }
                }
                
                return div;
            }
            
            function getEventClass(type) {
                switch(type) {
                    case 'interview': return 'bg-blue-600';
                    case 'followup': return 'bg-yellow-500';
                    case 'assessment': return 'bg-purple-600';
                    default: return 'bg-green-600';
                }
            }
            
            function showEventDetails(events) {
                const eventList = events.map(event => `
                    <div class="mb-4">
                        <h3 class="font-semibold text-lg">${event.title}</h3>
                        <p class="text-gray-600">Type: ${event.extendedProps.type}</p>
                        ${event.extendedProps.description ? `<p class="text-gray-600">${event.extendedProps.description}</p>` : ''}
                        ${event.extendedProps.location ? `<p class="text-gray-600">Location: ${event.extendedProps.location}</p>` : ''}
                        ${event.extendedProps.link ? `<p class="text-gray-600">Link: <a href="${event.extendedProps.link}" target="_blank" class="text-blue-600 hover:underline">${event.extendedProps.link}</a></p>` : ''}
                    </div>
                `).join('');
                
                Swal.fire({
                    title: 'Events for ' + events[0].start,
                    html: eventList,
                    confirmButtonText: 'Close',
                    confirmButtonColor: '#3b82f6'
                });
            }
            
            // Navigation handlers
            document.getElementById('prevMonth').addEventListener('click', () => {
                currentDate.setMonth(currentDate.getMonth() - 1);
                renderCalendar();
            });
            
            document.getElementById('nextMonth').addEventListener('click', () => {
                currentDate.setMonth(currentDate.getMonth() + 1);
                renderCalendar();
            });
            
            // Initial render
            renderCalendar();
        });
    </script>
@endpush