@extends('layouts.app')

@section('title', 'Create Booking')

@section('content')
    <h2>Create Booking</h2>
    <form action="{{ route('booking.store') }}" method="POST">
        @csrf
        
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
            </div>
            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="contact">Contact</label>
                <input type="text" class="form-control" id="contact" name="contact" placeholder="Enter contact number" required>
            </div>
            <div class="form-group col-md-6">
                <label for="vehicle_type">Vehicle Type</label>
                <select id="vehicle_type" name="vehicle_type" class="form-control" required>
                    <option value="" disabled selected>Select Vehicle</option>
                    <option value="bus">Bus</option>
                    <option value="bike">Bike</option>
                    <option value="car">Car</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="seat_count">Seat Count</label>
                <select id="seat_count" name="seat_count" class="form-control" required>
                    <option value="" disabled selected>Select Seats</option>
                    <option value="6">6</option>
                    <option value="12">12</option>
                    <option value="18">18</option>
                    <option value="24">24</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="pickup_place">Pickup Place</label>
                <input type="text" class="form-control" id="pickup_place" name="pickup_place" placeholder="Enter pickup place" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="drop_place">Drop Place</label>
                <input type="text" class="form-control" id="drop_place" name="drop_place" placeholder="Enter drop place" required>
            </div>
            <div class="form-group col-md-3">
                <label for="pickup_time">Pickup Time</label>
                <input type="time" class="form-control" id="pickup_time" name="pickup_time" required>
            </div>
            <div class="form-group col-md-3">
                <label for="drop_time">Drop Time</label>
                <input type="time" class="form-control" id="drop_time" name="drop_time" required>
            </div>
        </div>

        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>

        <div class="form-group">
            <label for="reason">Reason</label>
            <textarea class="form-control" id="reason" name="reason" rows="3" placeholder="Enter reason" required></textarea>
        </div>

        <div class="form-group" id="total_time"></div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pickupTimeInput = document.getElementByid('pickup_time');
            const dropTimeInput = document.getElementByid('drop_time');
            const totalTimeDiv = document.getElementByid('total_time');

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
        });
    </script>
@endsection
