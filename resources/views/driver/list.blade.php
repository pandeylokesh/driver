<!-- resources/views/driver/list.blade.php -->

@extends('layouts.app')

@section('title', 'Driver List')

@section('content')
    <h2>Driver List</h2>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route('driver.create') }}" class="btn btn-primary mb-3">Add New Driver</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>License Number</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Hourly Rate</th>
               
                <th>Actions</th>
                

            </tr>
        </thead>
        <tbody>
            @foreach ($drivers as $driver)
                <tr>
                    <td>{{ $driver->id }}</td>
                    <td>{{ $driver->name }}</td>
                    <td>{{ $driver->license_number }}</td>
                    <td>{{ $driver->contact }}</td>
                    <td>{{ $driver->email }}</td>
                
                    <td>{{ $driver->hourly_rate }}</td>
                    
                    <td>
                        <a href="{{ route('driver.edit', $driver->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ route('driver.delete', $driver->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                  
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
