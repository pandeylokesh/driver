@extends('layouts.app')

@section('title', 'Edit Booking')

@section('content')
    <h2>Edit Booking</h2>
    <form action="{{ route('booking.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $booking->name) }}" required>
            </div>
            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $booking->email) }}" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="contact">Contact</label>
                <input type="text" class="form-control" id="contact" name="contact" value="{{ old('contact', $booking->contact) }}" required>
            </div>
            <div class="form-group col-md-6">
                <label for="vehicle_type">Vehicle Type</label>
                <select id="vehicle_type" name="vehicle_type" class="form-control" required>
                    <option value="" disabled>Select Vehicle</option>
                    <option value="bus" {{ old('vehicle_type', $booking->vehicle_type) == 'bus' ? 'selected' : '' }}>Bus</option>
                    <option value="bike" {{ old('vehicle_type', $booking->vehicle_type) == 'bike' ? 'selected' : '' }}>Bike</option>
                    <option value="car" {{ old('vehicle_type', $booking->vehicle_type) == 'car' ? 'selected' : '' }}>Car</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="seat_count">Seat Count</label>
                <select id="seat_count" name="seat_count" class="form-control" required>
                    <option value="" disabled>Select Seats</option>
                    <option value="6" {{ old('seat_count', $booking->seat_count) == '6' ? 'selected' : '' }}>6</option>
                    <option value="12" {{ old('seat_count', $booking->seat_count) == '12' ? 'selected' : '' }}>12</option>
                    <option value="18" {{ old('seat_count', $booking->seat_count) == '18' ? 'selected' : '' }}>18</option>
                    <option value="24" {{ old('seat_count', $booking->seat_count) == '24' ? 'selected' : '' }}>24</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="pickup_place">Pickup Place</label>
                <input type="text" class="form-control" id="pickup_place" name="pickup_place" value="{{ old('pickup_place', $booking->pickup_place) }}" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="drop_place">Drop Place</label>
                <input type="text" class="form-control" id="drop_place" name="drop_place" value="{{ old('drop_place', $booking->drop_place) }}" required>
            </div>
            <div class="form-group col-md-3">
                <label for="pickup_time">Pickup Time</label>
                <input type="time" class="form-control" id="pickup_time" name="pickup_time" value="{{ old('pickup_time', $booking->pickup_time) }}" required>
            </div>
            <div class="form-group col-md-3">
                <label for="drop_time">Drop Time</label>
                <input type="time" class="form-control" id="drop_time" name="drop_time" value="{{ old('drop_time', $booking->drop_time) }}" required>
            </div>
        </div>

        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $booking->date) }}" required>
        </div>

        <div class="form-group">
            <label for="reason">Reason</label>
            <textarea class="form-control" id="reason" name="reason" rows="3" required>{{ old('reason', $booking->reason) }}</textarea>
        </div>

        <div class="form-group" id="total_time"></div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pickupTimeInput = document.getElementById('pickup_time');
            const dropTimeInput = document.getElementById('drop_time');
            const totalTimeDiv = document.getElementById('total_time');

            function calculateTotalTime() {
                const pickupTime = new Date(`1970-01-01T${pickupTimeInput.value}:00`);
                const dropTime = new Date(`1970-01-01T${dropTimeInput.value}:00`);
                if (pickupTime && dropTime) {
                    let totalMinutes = Math.abs((dropTime - pickupTime) / 60000);
                    let hours = Math.floor(totalMinutes / 60);
                    let minutes = totalMinutes % 60;
                    totalTimeDiv.innerHTML = `<label>Total Time</label>
                        <input type="text" class="form-control" value="${hours} hours ${minutes} minutes" readonly>`;
                } else {
                    totalTimeDiv.innerHTML = '';
                }
            }

            pickupTimeInput.addEventListener('change', calculateTotalTime);
            dropTimeInput.addEventListener('change', calculateTotalTime);

            // Initial calculation
            calculateTotalTime();
        });
    </script>
@endsection
