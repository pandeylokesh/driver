@extends('layouts.app')

@section('title', 'Company List')

@section('content')
    <h2>Company List</h2>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route('company.create') }}" class="btn btn-primary mb-3">Add New Company</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Company Name</th>
                <th>Company Email</th>
                <th>Company Contact</th>
                <th>Driver</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($companies as $company)
                <tr>

                    <td>{{ $company->id }}</td>
                    <td>{{ $company->company_name }}</td>
                    <td>{{ $company->company_email }}</td>
                    <td>{{ $company->company_contact }}</td>
                    <td>{{ $company->driver ? $company->driver->name : 'No Driver' }}</td>
                    <td>
                        <a href="{{ route('company.edit', $company->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ route('company.delete', $company->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
