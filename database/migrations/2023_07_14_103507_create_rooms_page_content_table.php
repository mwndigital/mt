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
        Schema::create('rooms_page_content', function (Blueprint $table) {
            $table->id();
            $table->string('page_title')->nullable();
            $table->string('page_slug')->nullable();
            $table->string('hero_banner_title');
            $table->string('hero_banner_background_image')->nullable();
            $table->text('rooms_info_banner_content');
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
        Schema::dropIfExists('rooms_page_content');
    }
};
