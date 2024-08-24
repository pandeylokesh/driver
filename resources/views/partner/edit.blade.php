@extends('layouts.app')

@section('title', 'Edit Partner Booking')

@section('content')
    <h2>Edit Partner Booking</h2>

    <form action="{{ route('partner.update', $partnerBooking->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="company_id">Company</label>
            <select id="company_id" name="company_id" class="form-control" required>
                <option value="">Select Company</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" {{ $partnerBooking->company_id == $company->id ? 'selected' : '' }}>
                        {{ $company->company_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="driver_id">Driver</label>
            <select id="driver_id" name="driver_id" class="form-control" required>
                <option value="">Select Driver</option>
                @foreach ($drivers as $driver)
                    <option value="{{ $driver->id }}" {{ $partnerBooking->driver_id == $driver->id ? 'selected' : '' }}>
                        {{ $driver->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="booking_id">Booking</label>
            <select id="booking_id" name="booking_id" class="form-control" required>
                <option value="">Select Booking</option>
                @foreach ($bookings as $booking)
                    <option value="{{ $booking->id }}" {{ $partnerBooking->booking_id == $booking->id ? 'selected' : '' }}>
                        {{ $booking->name }} - {{ $booking->pickup_place }} to {{ $booking->drop_place }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Partner</button>
    </form>
@endsection
