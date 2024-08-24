<!-- resources/views/driver/edit.blade.php -->

@extends('layouts.app')

@section('title', 'Edit Driver')

@section('content')
    <h2>Edit Driver</h2>
    <form action="{{ route('driver.update', $driver->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $driver->name }}" required>
        </div>
        <div class="form-group">
            <label for="license_number">License Number</label>
            <input type="text" class="form-control" id="license_number" name="license_number" value="{{ $driver->license_number }}" required>
        </div>
        <div class="form-group">
            <label for="contact">Contact Number</label>
            <input type="text" class="form-control" id="contact" name="contact" value="{{ $driver->contact }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $driver->email }}" required>
        </div>
        <div class="form-group">
            <label for="hourly_rate">Hourly Rate</label>
            <input type="number" class="form-control" id="hourly_rate" name="hourly_rate" value="{{ $driver->hourly_rate }}" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ $driver->password }}" required>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="{{ $driver->password }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
