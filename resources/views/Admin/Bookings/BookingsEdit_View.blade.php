<x-layouts.app>

    <div class="card mt-2">
        <div class="card-body mt-2">
            <h4><i class="fas fa-calendar-week"></i> Booking Edit Panel </h4>
            <div class="col-2">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
            <div class="col-2">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>
                                {{ $error }}
                            </li>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="card mt-2">
        <div class="card-body mt-2">
            <form method="POST" action="{{ route('bookings.update', $booking) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="booking_name" class="form-label">Booking Name</label>
                        <input type="text" name="booking_name" value="{{ $booking->booking_name }}"
                            class="form-control" id="booking_name">
                    </div>
                    <div class="mb-3">
                        <label for="booking_start" class="form-label">Booking Start</label>
                        <input type="datetime-local" name="booking_start" value="{{ $booking->booking_start }}"
                            class="form-control" id="booking_start">
                    </div>
                    <div class="mb-3">
                        <label for="booking_end" class="form-label">Booking End</label>
                        <input type="datetime-local" name="booking_end" value="{{ $booking->booking_end }}"
                            class="form-control" id="booking_end">
                    </div>
                    <div class="mb-3">
                        <label for="booking_details" class="form-label">Booking Details</label>
                        <input type="text" name="booking_details" value="{{ $booking->booking_details }}"
                            class="form-control" id="booking_details">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    Delete
                </button>
            </form>
        </div>
    </div>

    <!-- Modal Delete Booking -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('bookings.destroy', $booking) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="modal-body">
                        Delete booking for {{ $booking->booking_name }} ?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger btn-sm">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-layouts.app>
