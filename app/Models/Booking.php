<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // The table associated with the model (optional if table name follows Laravel conventions)
    protected $table = 'bookings';

    // The attributes that are mass assignable
    protected $fillable = [
        'name',
        'email',
        'contact',
        'vehicle_type',
        'seat_count',
        'pickup_place',
        'drop_place',
        'pickup_time',
        'drop_time',
        'date',
        'reason',
        'total_time',
        'driver_id',
        'amount',
        'paid_amount',
        'due_amount',
    ];

    // Define the relationship with PartnerBooking
    public function partnerBooking()
    {
        return $this->hasOne(PartnerBooking::class, 'booking_id'); // Specify the foreign key if necessary
    }

    // Define the relationship with Company (assuming the 'company_id' is present in the bookings table)
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id'); // Adjust if needed based on actual foreign key
    }

    // Define the relationship with Driver
    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id'); // Specify the foreign key if necessary
    }
}
