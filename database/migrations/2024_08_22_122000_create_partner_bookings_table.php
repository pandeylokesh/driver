<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('partner_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('driver_id')->constrained()->onDelete('cascade');
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->decimal('received_cash', 8, 2)->default(0); // Add this line to track received cash
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('partner_bookings');
    }
}
