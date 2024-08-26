@extends('layouts.app')

@section('title', 'Partner Bookings List')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">Partner Bookings List</h2>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Company</th>
                    <th>Driver</th>
                    <th>Booking</th>
                    <th>Total Amount</th>
                    <th>Received Cash</th> <!-- Display Received Cash -->
                    <th>Due Amount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($partnerBookings as $partnerBooking)
                    <tr class="text-center">
                        <td>{{ $partnerBooking->id }}</td>
                        <td>{{ $partnerBooking->company->company_name }}</td>
                        <td>{{ $partnerBooking->driver->name }}</td>
                        <td>{{ $partnerBooking->booking->name }}</td>
                        <td>₹{{ number_format($partnerBooking->booking->amount, 2) }}</td>
                        <td>₹{{ number_format($partnerBooking->received_cash, 2) }}</td> <!-- Display Received Cash -->
                        <td>₹{{ number_format($partnerBooking->booking->due_amount, 2) }}</td>
                        <td>
                            <a href="{{ route('partner.edit', $partnerBooking->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('partner.destroy', $partnerBooking->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No partner bookings found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
