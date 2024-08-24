<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function create()
    {
        return view('booking.booking_form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact' => 'required|string|max:20',
            'vehicle_type' => 'required|in:bus,bike,car',
            'seat_count' => 'required|integer|in:6,12,18,24',
            'pickup_place' => 'required|string|max:255',
            'drop_place' => 'required|string|max:255',
            'pickup_time' => 'required|date_format:H:i',
            'drop_time' => 'required|date_format:H:i',
            'date' => 'required|date',
            'reason' => 'required|string',
        ]);

        $pickupTime = Carbon::createFromFormat('H:i', $request->pickup_time);
        $dropTime = Carbon::createFromFormat('H:i', $request->drop_time);
        $interval = $pickupTime->diff($dropTime);
        $totalTime = $interval->format('%h hours %i minutes');

        Booking::create([
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->contact,
            'vehicle_type' => $request->vehicle_type,
            'seat_count' => $request->seat_count,
            'pickup_place' => $request->pickup_place,
            'drop_place' => $request->drop_place,
            'pickup_time' => $request->pickup_time,
            'drop_time' => $request->drop_time,
            'date' => $request->date,
            'reason' => $request->reason,
            'total_time' => $totalTime,
        ]);

        return redirect()->route('booking.index')->with('success', 'Booking created successfully!');
    }

    public function index()
    {
        $bookings = Booking::all();
        return view('booking.booking_list', compact('bookings'));
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        return view('booking.edit', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact' => 'required|string|max:20',
            'vehicle_type' => 'required|in:bus,bike,car',
            'seat_count' => 'required|integer|in:6,12,18,24',
            'pickup_place' => 'required|string|max:255',
            'drop_place' => 'required|string|max:255',
            'pickup_time' => 'required|date_format:H:i',
            'drop_time' => 'required|date_format:H:i',
            'date' => 'required|date',
            'reason' => 'required|string',
        ]);

        $booking = Booking::findOrFail($id);

        $pickupTime = Carbon::createFromFormat('H:i', $request->pickup_time);
        $dropTime = Carbon::createFromFormat('H:i', $request->drop_time);
        $interval = $pickupTime->diff($dropTime);
        $totalTime = $interval->format('%h hours %i minutes');

        $booking->update([
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->contact,
            'vehicle_type' => $request->vehicle_type,
            'seat_count' => $request->seat_count,
            'pickup_place' => $request->pickup_place,
            'drop_place' => $request->drop_place,
            'pickup_time' => $request->pickup_time,
            'drop_time' => $request->drop_time,
            'date' => $request->date,
            'reason' => $request->reason,
            'total_time' => $totalTime,
        ]);

        return redirect()->route('booking.index')->with('success', 'Booking updated successfully!');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('booking.index')->with('success', 'Booking deleted successfully!');
    }



}
