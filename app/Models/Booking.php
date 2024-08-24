<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'contact', 'vehicle_type', 'seat_count', 
        'pickup_place', 'drop_place', 'pickup_time', 'drop_time', 
        'date', 'reason', 'total_time'
    ];
    public function driver()
{
    return $this->belongsTo(Driver::class);
}
public function partnerBookings()
{
    return $this->hasMany(PartnerBooking::class);
}
}


