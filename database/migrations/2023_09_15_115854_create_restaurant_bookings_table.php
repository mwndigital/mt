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
        Schema::create('restaurant_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->date('reservation_date');
            $table->string('reservation_time');
            $table->time('reservation_end_time');
            $table->integer('no_of_guests');
            $table->unsignedBigInteger('table_id');
            $table->string('joining_for');
            $table->string('additional_information')->nullable();
            $table->string('dietary_info')->nullable();
            $table->timestamps();

            $table->foreign('table_id')->references('id')->on('restaurant_tables')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurant_bookings');
    }
};
