<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_ref')->nullable();
            $table->string('room_id');
            $table->string('checkin_date');
            $table->string('checkout_date');
            $table->time('arrival_time');
            $table->integer('no_of_adults');
            $table->integer('no_of_children');
            $table->integer('no_of_infants')->nullable();
            $table->string('user_title');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address_line_one');
            $table->string('address_line_two')->nullable();
            $table->string('postcode');
            $table->string('city');
            $table->string('country');
            $table->string('phone_number');
            $table->string('email_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};
