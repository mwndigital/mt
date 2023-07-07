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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('room_type');
            $table->integer('adult_cap');
            $table->integer('child_cap');
            $table->string('bathroom_type');
            $table->text('description');
            $table->text('short_description');
            $table->string('slug')->unique('rooms')->nullable();
            $table->decimal('price_per_night_double', 9, 2)->nullable();
            $table->decimal('price_per_night_single', 9, 2)->nullable();
            $table->string('featured_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
