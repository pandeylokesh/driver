<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('contact')->nullable();
            $table->string('vehicle_type');
            $table->integer('seat_count');
            $table->string('pickup_place');
            $table->string('drop_place');
            $table->time('pickup_time');
            $table->time('drop_time');
            $table->date('date');
            $table->string('reason');
            $table->string('total_time');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
