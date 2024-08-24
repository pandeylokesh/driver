<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Change this line
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable; // Add this line

class Driver extends Authenticatable // Change this line
{
    use HasFactory, Notifiable; // Add Notifiable trait

    protected $fillable = [
        'name',
        'license_number',
        'contact',
        'email',
        'hourly_rate',
        'password',
    ];

    // Relationship with Company model
    public function companies()
    {
        return $this->hasMany(Company::class);
    }
public function partnerBookings()
{
    return $this->hasMany(PartnerBooking::class);
}
}

