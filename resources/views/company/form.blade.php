@extends('layouts.app')

@section('title', isset($company) ? 'Edit Company' : 'Add Company')

@section('content')
    <h2>{{ isset($company) ? 'Edit Company' : 'Add Company' }}</h2>
    <form action="{{ isset($company) ? route('company.update', $company->id) : route('company.store') }}" method="POST">
        @csrf
        @if(isset($company))
            @method('PUT') <!-- Use PUT method for updates -->
        @endif
        
        <div class="form-group">
            <label for="company_name">Company Name</label>
            <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name', $company->company_name ?? '') }}" required>
        </div>
        
        <div class="form-group">
            <label for="company_email">Company Email</label>
            <input type="email" class="form-control" id="company_email" name="company_email" value="{{ old('company_email', $company->company_email ?? '') }}" required>
        </div>
        
        <div class="form-group">
            <label for="company_contact">Company Contact</label>
            <input type="text" class="form-control" id="company_contact" name="company_contact" value="{{ old('company_contact', $company->company_contact ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="driver_id">Driver</label>
            <select id="driver_id" name="driver_id" class="form-control" required>
                <option value="">Select a Driver</option>
                @foreach ($drivers as $driver)
                    <option value="{{ $driver->id }}" {{ (isset($company) && $driver->id == $company->driver_id) ? 'selected' : '' }}>
                        {{ $driver->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($company) ? 'Update' : 'Add' }}</button>
    </form>
@endsection
