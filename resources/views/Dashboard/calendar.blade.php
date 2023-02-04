<x-layouts.app>

    <div class="card mt-4">
        <div class="card-body">
            <h2 class="h4">Upcoming Events</h2>
        </div>
    </div>
    <div class="card mt-2">
        <div class="card-body">
            <div class="card-body">
                <div id='calendar'></div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.1/index.global.min.js'></script>
        <script src='fullcalendar/dist/index.global.js'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next',
                        center: 'dayGridMonth,timeGridWeek,timeGridDay',
                    },
                    events: @json($events),
                    aspectRatio: 3,
                    handleWindowResize: true,
                    themeSystem: 'bootstrap5',
                    contentHeight: 'auto',
                    businessHours: {
                        daysOfWeek: [1, 2, 3, 4, 5],
                        startTime: '09:00',
                        endTime: '18:00',
                    }
                });
                calendar.render();
            });
        </script>
    @endpush

</x-layouts.app>
