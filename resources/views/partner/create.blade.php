@extends('layouts.app')

@section('title', 'Assign Partner to Booking')

@section('content')
    <h2>Assign Partner to Booking</h2>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('partner.store') }}" method="POST">
        @csrf

        <div class="container">
            <div class="row">
                <!-- Left Column: Company Selection -->
                <div class="col-md-4">
                    <h4>Select Company</h4>
                    <div class="form-group">
                        <label for="company_id">Company</label>
                        <select id="company_id" name="company_id" class="form-control" required>
                            <option value="">Select Company</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Center Column: Booking Details -->
                <div class="col-md-4">
                    <h4>Booking Details</h4>
                    <div class="form-group">
                        <label for="booking_id">Booking</label>
                        <select id="booking_id" name="booking_id" class="form-control" required>
                            <option value="">Select Booking</option>
                            @foreach ($bookings as $booking)
                                <option value="{{ $booking->id }}">{{ $booking->id }} - {{ $booking->name }} ({{ $booking->date }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Right Column: Driver Selection -->
                <div class="col-md-4">
                    <h4>Select Driver</h4>
                    <div class="form-group">
                        <label for="driver_id">Driver</label>
                        <select id="driver_id" name="driver_id" class="form-control" required>
                            <option value="">Select Driver</option>
                            @foreach ($drivers as $driver)
                                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Assign Partner</button>
                </div>
            </div>
        </div>
    </form>
@endsection
