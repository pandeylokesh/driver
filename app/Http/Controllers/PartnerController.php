<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Driver;
use App\Models\Booking;
use App\Models\PartnerBooking; // Import the model
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function create()
    {
        $companies = Company::all(); 
        $drivers = Driver::all(); 
        $bookings = Booking::all(); 
        
        return view('partner.create', compact('companies', 'drivers', 'bookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'driver_id' => 'required|exists:drivers,id',
            'booking_id' => 'required|exists:bookings,id',
        ]);

        // Store the partner booking in the database
        PartnerBooking::create([
            'company_id' => $request->company_id,
            'driver_id' => $request->driver_id,
            'booking_id' => $request->booking_id,
        ]);

        return redirect()->route('partner.index')->with('success', 'Partner created successfully!');
    }

    public function index()
{
    // Fetch all partner bookings with relationships
    $partnerBookings = PartnerBooking::with(['company', 'driver', 'booking'])->get();
    return view('partner.index', compact('partnerBookings'));
}
public function edit($id)
{
    // Find the partner booking by ID
    $partnerBooking = PartnerBooking::findOrFail($id);
    
    // Fetch all companies, drivers, and bookings
    $companies = Company::all(); 
    $drivers = Driver::all(); 
    $bookings = Booking::all(); 

    // Pass the data to the view
    return view('partner.edit', compact('partnerBooking', 'companies', 'drivers', 'bookings'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'company_id' => 'required|exists:companies,id',
        'driver_id' => 'required|exists:drivers,id',
        'booking_id' => 'required|exists:bookings,id',
    ]);

    // Find the partner booking by ID
    $partnerBooking = PartnerBooking::findOrFail($id);

    // Update the partner booking
    $partnerBooking->update([
        'company_id' => $request->company_id,
        'driver_id' => $request->driver_id,
        'booking_id' => $request->booking_id,
    ]);

    return redirect()->route('partner.index')->with('success', 'Partner updated successfully!');
}

public function destroy($id)
{
    $PartnerBooking = PartnerBooking::findOrFail($id);
    $PartnerBooking->delete();

    return redirect()->route('partner.index')->with('success', 'Partner deleted successfully!');
}


}
