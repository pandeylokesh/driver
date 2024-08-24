<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver; // Make sure to create this model
use App\Models\Company; // Assuming you have a Company model for saving company data

class CompanyController extends Controller
{
    // Show the form for creating a new company assignment
    public function create()
    {
        $drivers = Driver::all();
        return view('company.form', compact('drivers'));
    }

    // Store a newly created company assignment in storage
    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'company_email' => 'required|email|max:255',
            'company_contact' => 'required|string|max:20',
            'driver_id' => 'required|exists:drivers,id',
        ]);

        Company::create([
            'company_name' => $request->company_name,
            'company_email' => $request->company_email,
            'company_contact' => $request->company_contact,
            'driver_id' => $request->driver_id,
        ]);

        return redirect()->route('company.index')->with('success', 'Company assigned successfully!');
    }
    public function index()
{
    $companies = Company::with('driver')->get(); // Eager load the driver relationship
    return view('company.list', compact('companies'));
}

public function edit($id)
{
    $company = Company::findOrFail($id);
    $drivers = Driver::all(); // Get all drivers for the dropdown
    return view('company.edit', compact('company', 'drivers'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'company_name' => 'required|string|max:255',
        'company_email' => 'required|email|max:255',
        'company_contact' => 'required|string|max:20',
        'driver_id' => 'required|exists:drivers,id',
    ]);

    $company = Company::findOrFail($id);
    $company->update([
        'company_name' => $request->company_name,
        'company_email' => $request->company_email,
        'company_contact' => $request->company_contact,
        'driver_id' => $request->driver_id,
    ]);

    return redirect()->route('company.index')->with('success', 'Company updated successfully!');
}

 // Delete a driver from storage
 public function destroy($id)
 {
     $companies = Company::findOrFail($id);
     $companies->delete();

     return redirect()->route('company.index')->with('success', 'Driver deleted successfully!');
 }
}
