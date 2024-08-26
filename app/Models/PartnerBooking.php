<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerBooking extends Model
{
    protected $fillable = [
        'company_id',
        'driver_id',
        'booking_id',
    ];

    // Define the relationship with Company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Define the relationship with Driver
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    // Define the relationship with Booking
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
   
    

}
