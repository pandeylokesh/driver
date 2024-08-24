@extends('layouts.app')

@section('title', 'Edit Company')

@section('content')
    <h2>Edit Company</h2>
    <form action="{{ route('company.update', $company->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Ensure to use PUT method for updates -->
        
        <div class="form-group">
            <label for="company_name">Company Name</label>
            <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name', $company->company_name) }}" required>
        </div>
        
        <div class="form-group">
            <label for="company_email">Company Email</label>
            <input type="email" class="form-control" id="company_email" name="company_email" value="{{ old('company_email', $company->company_email) }}" required>
        </div>
        
        <div class="form-group">
            <label for="company_contact">Company Contact</label>
            <input type="text" class="form-control" id="company_contact" name="company_contact" value="{{ old('company_contact', $company->company_contact) }}" required>
        </div>

        <div class="form-group">
            <label for="driver_id">Driver</label>
            <select id="driver_id" name="driver_id" class="form-control" required>
                <option value="">Select a Driver</option>
                @foreach ($drivers as $driver)
                    <option value="{{ $driver->id }}" {{ $driver->id == $company->driver_id ? 'selected' : '' }}>
                        {{ $driver->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
