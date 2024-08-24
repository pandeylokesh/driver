<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Driver;
use Illuminate\Support\Facades\Hash;
use App\Models\PartnerBooking;

class DriverController extends Controller
{
    // Show the form for creating a new driver
    public function create()
    {
        return view('driver.form');
    }

    // Store a newly created driver in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'license_number' => 'required|string|max:255',
            'contact' => 'required|string|max:20',
            'email' => 'required|email|unique:drivers,email|max:255',
            'hourly_rate' => 'required|numeric|min:0',
            'password' => 'required|string|confirmed', // Added validation for password
        ]);

        Driver::create([
            'name' => $request->name,
            'license_number' => $request->license_number,
            'contact' => $request->contact,
            'email' => $request->email,
            'hourly_rate' => $request->hourly_rate,
            'password' => Hash::make($request->password), // Hashing the password
        ]);

        return redirect()->route('driver.index')->with('success', 'Driver added successfully!');
    }

    // List all drivers
    public function index()
    {
        $drivers = Driver::all();
        return view('driver.list', compact('drivers'));
    }

    // Show the form for editing a driver
    public function edit($id)
    {
        $driver = Driver::findOrFail($id);
        return view('driver.edit', compact('driver'));
    }

    // Update a driver in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'license_number' => 'required|string|max:255',
            'contact' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'hourly_rate' => 'required|numeric|min:0',
            'password' => 'nullable|string|confirmed', // Password is optional for updates
        ]);

        $driver = Driver::findOrFail($id);
        $driver->name = $request->name;
        $driver->license_number = $request->license_number;
        $driver->contact = $request->contact;
        $driver->email = $request->email;
        $driver->hourly_rate = $request->hourly_rate;

        // Update password if provided
        if ($request->filled('password')) {
            $driver->password = Hash::make($request->password);
        }

        $driver->save();

        return redirect()->route('driver.index')->with('success', 'Driver updated successfully!');
    }

    // Delete a driver from storage
    public function destroy($id)
    {
        $driver = Driver::findOrFail($id);
        $driver->delete();

        return redirect()->route('driver.index')->with('success', 'Driver deleted successfully!');
    }

    // Show the login form
    public function showLoginForm()
    {
        return view('driver.login');
    }

    // Handle login request
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('driver')->attempt($credentials)) {
            // Authentication passed, redirect to driver bookings
            return redirect()->route('driver.bookings');
        }

        // Authentication failed, redirect back with input
        return redirect()->back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Handle logout
    public function logout()
    {
        Auth::guard('driver')->logout();

        // Redirect to login page or home page
        return redirect()->route('driver.login')->with('success', 'You have been logged out successfully.');
    }

    // Show bookings for the logged-in driver
    public function showDriverBookings()
    {
        // Fetch the currently authenticated driver
        $driver = Auth::guard('driver')->user();

        // Fetch bookings related to the driver
        $bookings = PartnerBooking::where('driver_id', $driver->id)->get();

        // Pass the bookings to the view
        return view('driver.bookings', compact('bookings'));
    }
}
