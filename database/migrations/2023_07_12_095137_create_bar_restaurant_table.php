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
        Schema::create('bar_restaurant', function (Blueprint $table) {
            $table->id();
            $table->string('page_title')->nullable();
            $table->string('page_slug')->nullable();
            $table->string('hero_banner_title');
            $table->string('hero_banner_background_image');
            $table->string('banner_one_title')->nullable();
            $table->text('banner_one_content');
            $table->text('banner_one_big_image');
            $table->text('banner_one_small_image');
            $table->string('separator_banner_image');
            $table->string('banner_two_title');
            $table->text('banner_two_content');
            $table->string('banner_two_image');
            $table->string('book_stay_banner_title');
            $table->text('book_stay_banner_content');
            $table->string('book_stay_banner_background_image');
            $table->text('page_description')->nullable();
            $table->text('page_keywords')->nullable();
            $table->string('page_type')->default('website')->nullable();
            $table->string('page_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bar_restaurant');
    }
};
