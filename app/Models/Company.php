<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    // Specify the fields that are mass assignable
    protected $fillable = [
        'company_name',
        'company_email',
        'company_contact',
        'driver_id',
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
