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
        Schema::create('homepage_page', function (Blueprint $table) {
            $table->id();
            $table->string('page_title')->nullable();
            $table->string('page_slug')->nullable();
            $table->string('hero_banner_title');
            $table->string('hero_banner_content');
            $table->string('hero_banner_background_image')->nullable();
            $table->string('banner_one_image')->nullable();
            $table->string('banner_one_title');
            $table->text('banner_one_content');
            $table->string('banner_one_button_link');
            $table->string('rooms_banner_sub_title')->nullable();
            $table->string('rooms_banner_title');
            $table->text('rooms_banner_content');
            $table->string('rooms_banner_button_link');
            $table->string('spend_night_banner_title');
            $table->string('spend_night_banner_content');
            $table->string('spend_night_banner_button_link');
            $table->string('spend_night_banner_background_image')->nullable();
            $table->text('page_description')->nullable();
            $table->string('page_keywords')->nullable();
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
        Schema::dropIfExists('homepage_page');
    }
};
