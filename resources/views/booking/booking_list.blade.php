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
                <th>Add Amount</th>
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
                  
                </tr>
            @empty
                <tr>
                    <td colspan="15" class="text-center">No bookings found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Receive Cash Modal -->

@endsection




