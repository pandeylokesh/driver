@extends('layouts.app')

@section('title', 'Partner Bookings List')

@section('content')
    <div class="container mt-5">
        <!-- Logout Button at the top right -->
        <div class="d-flex justify-content-end mb-3">
            <form action="{{ route('driver.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>

        <h2 class="mb-4">Partner Bookings List</h2>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Company</th>
                        <th>Driver</th>
                        <th>Booking</th>
                        <th>Total Cash</th>
                        <th>Received Cash</th>
                        <th>Due Cash</th>
                        <th>Add Cash</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bookings as $booking)
                        <tr>
                            <td>{{ $booking->id }}</td>
                            <td>{{ $booking->company->company_name }}</td>
                            <td>{{ $booking->driver->name }}</td>
                            <td>{{ $booking->booking->name }}</td>
                            <td>{{ number_format($booking->booking->amount, 2) }}</td>
                            <td>{{ number_format($booking->received_cash, 2) }}</td>
                            <td>{{ number_format($booking->booking->due_amount ?? 0, 2) }}</td>
                            <td>
                                <form action="{{ route('driver.addAmount', $booking->booking->id) }}" method="POST" class="d-flex">
                                    @csrf
                                    <input type="number" name="amount" class="form-control me-2" step="0.01" min="0" placeholder="Amount" required>
                                    <button type="submit" class="btn btn-primary" style="
    width: 176px;
    height: 37px;
        margin-inline: 10px;

">Add Cash</button>
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
