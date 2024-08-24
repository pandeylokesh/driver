@extends('layouts.app')

@section('title', 'Partner Bookings List')

@section('content')
    <div class="container">
        <!-- Logout Button at the top right -->
        <div class="d-flex justify-content-end mb-3">
            <form action="{{ route('driver.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>

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
                   
                           
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->company->company_name }}</td>
                        <td>{{ $booking->driver->name }}</td>
                        <td>{{ $booking->booking->name }}</td>
                        
                      
                                           </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No partner bookings found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
