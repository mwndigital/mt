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
        Schema::create('bar_page', function (Blueprint $table) {
            $table->id();
            $table->string('page_title')->nullable();
            $table->string('page_slug')->nullable();
            $table->string('hero_banner_title');
            $table->string('hero_banner_background_image')->nullable();
            $table->string('hero_banner_sub_title')->nullable();
            $table->text('hero_banner_content')->nullable();
            $table->string('whisky_banner_title')->nullable();
            $table->string('whisky_banner_content')->nullable();
            $table->string('whiskey_banner_featured_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bar_page');
    }
};
