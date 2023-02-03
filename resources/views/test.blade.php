<x-layouts.app>

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
                            <li class="breadcrumb-item active" aria-current="page">Bookings</li>
                        </ol>
                    </nav>
                    <h2 class="h4">Bookings</h2>
                    <p class="mb-0">Bookings information panel.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-2 card card-body border-0 shadow">
        <table class="table table-hover table-striped">
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
                    <td>Name</td>
                    <td>Start</td>
                    <td>End</td>
                    <td>Details</td>
                    <td>
                        <a class="btn btn-sm btn-warning mr-2 mt-1" href="">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="fw-bold">#1</td>
                    <td>Name</td>
                    <td>Start</td>
                    <td>End</td>
                    <td>Details</td>
                    <td>
                        <a class="btn btn-sm btn-warning mr-2 mt-1" href="">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="fw-bold">#1</td>
                    <td>Name</td>
                    <td>Start</td>
                    <td>End</td>
                    <td>Details</td>
                    <td>
                        <a class="btn btn-sm btn-warning mr-2 mt-1" href="">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="fw-bold">#1</td>
                    <td>Name</td>
                    <td>Start</td>
                    <td>End</td>
                    <td>Details</td>
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
    <div class="modal fade" id="addBooking" tabindex="-1" aria-labelledby="addBooking" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBooking">Add Booking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="bookings.store">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="booking_name" class="form-label">Booking Name</label>
                            <input type="text" name="booking_name" class="form-control" id="booking_name"
                                aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card mt-2">
        <div class="card-body">
            <table id="test1" class="table table-hover table-striped">
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
                        <td>Name</td>
                        <td>Start</td>
                        <td>End</td>
                        <td>Details</td>
                        <td>
                            <a class="btn btn-sm btn-warning mr-2 mt-1" href="">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">#1</td>
                        <td>Name</td>
                        <td>Start</td>
                        <td>End</td>
                        <td>Details</td>
                        <td>
                            <a class="btn btn-sm btn-warning mr-2 mt-1" href="">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">#1</td>
                        <td>Name</td>
                        <td>Start</td>
                        <td>End</td>
                        <td>Details</td>
                        <td>
                            <a class="btn btn-sm btn-warning mr-2 mt-1" href="">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">#1</td>
                        <td>Name</td>
                        <td>Start</td>
                        <td>End</td>
                        <td>Details</td>
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
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#test1').DataTable();
            });
        </script>
    @endpush

</x-layouts.app>
