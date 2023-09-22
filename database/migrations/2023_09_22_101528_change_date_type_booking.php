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
        //Change varchar to date type
        Schema::table('bookings', function (Blueprint $table) {
            $table->date('checkin_date')->change();
            $table->date('checkout_date')->change();
            // Change room_id to integer
            $table->integer('room_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
