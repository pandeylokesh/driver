<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Driver;
use App\Models\Booking;
use App\Models\PartnerBooking;
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
        // Fetch all partner bookings with related company, driver, and booking information
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
        $partnerBooking = PartnerBooking::findOrFail($id);
        $partnerBooking->delete();

        return redirect()->route('partner.index')->with('success', 'Partner deleted successfully!');
    }

    public function addAmount(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);
    
        $amount = $request->input('amount');
    
        // Update the booking record
        $booking = Booking::find($id);
    
        if ($booking) {
            // Add the input amount to the existing paid amount
            $booking->paid_amount += $amount;
    
            // Update the due amount
            $booking->due_amount = $booking->amount - $booking->paid_amount;
    
            // Save the updated booking record
            $booking->save();
    
            // Update the received cash for the partner booking
            $partnerBooking = PartnerBooking::where('booking_id', $id)->first();
            if ($partnerBooking) {
                $partnerBooking->received_cash += $amount;
                $partnerBooking->save();
            }
    
            return redirect()->route('partner.index')->with('success', 'Amount added successfully.');
        }
    
        return redirect()->route('partner.index')->with('error', 'Booking not found.');
    }
    public function showDriverBookings()
{
    $driver = Auth::guard('driver')->user();

    // Fetch bookings related to the driver, including partner bookings
    $bookings = PartnerBooking::with('booking', 'booking.company', 'booking.driver')->where('driver_id', $driver->id)->get();

    return view('partner.index', compact('bookings'));
}

}
