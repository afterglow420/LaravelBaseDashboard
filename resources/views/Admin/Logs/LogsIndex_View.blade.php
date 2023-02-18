<x-layouts.app>

    <!-- Table info card -->
    <div class="card mt-2">
        <div class="card-body">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
                <div class="d-block mb-4 mb-md-0">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                            <li class="breadcrumb-item">
                                <a href="#">
                                    <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                        </path>
                                    </svg>
                                </a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Logs Table</li>
                        </ol>
                    </nav>
                    <h2 class="h4">Logs Table</h2>
                    <p class="mb-0">Logs information panel.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="mt-2 card card-body border-0 shadow">
        <table id="logsTable" class="table table-hover table-striped">
            <thead>
                <tr>
                    <th class="border-gray-200">Log Id</th>
                    <th class="border-gray-200">Auth User ID</th>
                    <th class="border-gray-200">Action</th>
                    <th class="border-gray-200">Target Model</th>
                    <th class="border-gray-200">Target Model ID</th>
                    <th class="border-gray-200">Timestamp</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $log)
                    <tr>
                        <td class="fw-bold">{{ $log->id }}</td>
                        <td>{{ $log->user_id }}</td>
                        <td>{{ $log->action }}</td>
                        <td>{{ $log->model }}</td>
                        <td>{{ $log->model_id }}</td>
                        <td>{{ $log->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                var table = $('#logsTable').DataTable({
                    dom: 'Bfrtipl',
                    lengthMenu: [
                        [10, 20, 50, 100, 1000, -1],
                        [10, 20, 50, 100, 1000, "All"]
                    ],
                    buttons: [
                        'copy', 'excel', 'pdf', 'print'
                    ],
                    colReorder: true,
                    rowReorder: true,
                });
                table.buttons().container().appendTo('#dataTable_wrapper .col-md-6');
            });
        </script>
    @endpush

</x-layouts.app>
