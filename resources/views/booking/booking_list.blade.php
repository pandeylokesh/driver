@extends('layouts.app')

@section('title', 'Booking List')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h2>Booking List</h2>
    <a href="{{ route('booking.create') }}" class="btn btn-primary">Add New Booking</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Vehicle Type</th>
                <th>Seat Count</th>
                <th>Pickup Place</th>
                <th>Drop Place</th>
                <th>Pickup Time</th>
                <th>Drop Time</th>
                <th>Date</th>
                <th>Reason</th>
                <th>Total Time</th>
                <th>Actions</th>
                <th>Cash / Pending</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->name }}</td>
                    <td>{{ $booking->email }}</td>
                    <td>{{ $booking->contact }}</td>
                    <td>{{ ucfirst($booking->vehicle_type) }}</td>
                    <td>{{ $booking->seat_count }}</td>
                    <td>{{ $booking->pickup_place }}</td>
                    <td>{{ $booking->drop_place }}</td>
                    <td>{{ $booking->pickup_time }}</td>
                    <td>{{ $booking->drop_time }}</td>
                    <td>{{ $booking->date }}</td>
                    <td>{{ $booking->reason }}</td>
                    <td>{{ $booking->total_time }}</td>
                    <td class="d-flex">
                        <a href="{{ route('booking.edit', $booking->id) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                        <form action="{{ route('booking.destroy', $booking->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                    <td>
                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#receiveCashModal" data-booking-id="{{ $booking->id }}">Receive Cash</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="15" class="text-center">No bookings found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Receive Cash Modal -->
    <div class="modal fade" id="receiveCashModal" tabindex="-1" aria-labelledby="receiveCashModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="receiveCashModalLabel">Receive Cash</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="receiveCashForm" method="POST" action="{{ route('booking.receive_cash') }}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="booking_id" id="booking_id">
                        <div class="mb-3">
                            <label for="amount" class="form-label">Enter Amount</label>
                            <input type="number" class="form-control" id="amount" name="amount" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var receiveCashModal = document.getElementById('receiveCashModal');
        receiveCashModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Button that triggered the modal
            var bookingId = button.getAttribute('data-booking-id'); // Extract info from data-* attributes
            var modal = receiveCashModal.querySelector('#booking_id');
            modal.value = bookingId; // Update the modal's content
        });
    });
</script>
@endpush
