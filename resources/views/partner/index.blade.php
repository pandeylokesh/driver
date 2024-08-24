@extends('layouts.app')

@section('title', 'Partner Bookings List')

@section('content')
    <h2>Partner Bookings List</h2>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Company</th>
                <th>Driver</th>
                <th>Booking</th>
                <th>Actions</th>
                
            </tr>
        </thead>
        <tbody>
            @forelse ($partnerBookings as $partnerBooking)
                <tr>
                    <td>{{ $partnerBooking->id }}</td>
                    <td>{{ $partnerBooking->company->company_name }}</td>
                    <td>{{ $partnerBooking->driver->name }}</td>
                    <td>{{ $partnerBooking->booking->name }}</td>
                    <td>
                        <!-- Add actions if needed -->
                        <a href="{{ route('partner.edit', $partnerBooking->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('partner.destroy', $partnerBooking->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                  
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No partner bookings found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
