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
                            <li class="breadcrumb-item active" aria-current="page">Table Name</li>
                        </ol>
                    </nav>
                    <h2 class="h4">Table Name Main</h2>
                    <p class="mb-0">Table information panel.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="mt-2 card card-body border-0 shadow">
        <div class="row mb-2">
            <div class="col md-6">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#addEntry">
                    Add table entry
                </button>
            </div>
        </div>
        <table id="dataTable" class="table table-hover table-striped">
            <thead>
                <tr>
                    <th class="border-gray-200">Booking Id</th>
                    <th class="border-gray-200">Booking Name</th>
                    <th class="border-gray-200">Booking Start</th>
                    <th class="border-gray-200">Booking End</th>
                    <th class="border-gray-200">Booking Details</th>
                    <th class="border-gray-200">Actions</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($bookings as $booking) --}}
                <tr>
                    <td class="fw-bold">#1</td>
                    <td>Nume 1</td>
                    <td>Start 1</td>
                    <td>End 1</td>
                    <td>Details 1</td>
                    <td>
                        <a class="btn btn-sm btn-warning mr-2 mt-1" href="">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="fw-bold">#2</td>
                    <td>Name 2</td>
                    <td>Start 2</td>
                    <td>End 2</td>
                    <td>Details 2</td>
                    <td>
                        <a class="btn btn-sm btn-warning mr-2 mt-1" href="">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="fw-bold">#3</td>
                    <td>Name 3</td>
                    <td>Start 3</td>
                    <td>End 3</td>
                    <td>Details 3</td>
                    <td>
                        <a class="btn btn-sm btn-warning mr-2 mt-1" href="">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="fw-bold">#4</td>
                    <td>Name 4</td>
                    <td>Start 4</td>
                    <td>End 4</td>
                    <td>Details 4</td>
                    <td>
                        <a class="btn btn-sm btn-warning mr-2 mt-1" href="">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </td>
                </tr>
                {{-- @endforeach --}}
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addEntry" tabindex="-1" aria-labelledby="addEntry" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEntry">Add new entry</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="bookings.store">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="" class="form-label">New entry</label>
                            <input type="text" name="" class="form-control" id="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    @push('scripts')
        <script>
            $(document).ready(function() {
                var table = $('#dataTable').DataTable({
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
