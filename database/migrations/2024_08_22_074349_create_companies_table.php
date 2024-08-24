<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('company_email');
            $table->string('company_contact');
            $table->foreignId('driver_id')->nullable()->constrained()->onDelete('set null'); // Make driver_id nullable and set to null on delete
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
