<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Driver;

class DriverLoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('driver.login');
    }

    protected function guard()
    {
        return Auth::guard('driver');
    }
    // Handle the login process
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Attempt to authenticate the driver
        $credentials = $request->only('email', 'password');

        if (Auth::guard('driver')->attempt($credentials)) {
            // Authentication passed...
            return redirect()->route('driver.index')->with('success', 'Login successful!');
        }

        // Authentication failed...
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::guard('driver')->logout();
        return redirect()->route('driver.login')->with('success', 'Logged out successfully!');
    }
}
