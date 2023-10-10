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
        Schema::create('aboutpage_page', function (Blueprint $table) {
            $table->id();
            $table->string('page_title')->nullable();
            $table->string('page_slug');
            $table->string('hero_banner_background_image')->nullable();
            $table->string('hero_banner_title');
            $table->string('about_banner_title');
            $table->text('about_banner_content');
            $table->string('about_banner_image')->nullable();
            $table->string('banner_one_image')->nullable();
            $table->text('banner_one_content');
            $table->string('banner_two_title');
            $table->string('banner_two_content');
            $table->string('banner_two_image')->nullable();
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
        Schema::dropIfExists('aboutpage_page');
    }
};
