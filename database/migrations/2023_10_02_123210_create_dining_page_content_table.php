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
        Schema::create('dining_page_content', function (Blueprint $table) {
            $table->id();
            $table->string('page_title');
            $table->string('slug');
            $table->string('hero_title');
            $table->text('hero_content');
            $table->string('hero_background_image');
            $table->string('banner_one_title');
            $table->text('banner_one_content');
            $table->string('banner_one_image');

            $table->unsignedBigInteger('page_file_id')->nullable();

            $table->string('book_banner_title');
            $table->text('book_banner_content');
            $table->string('book_banner_background_image');
            $table->string('book_banner_button_content');
            $table->string('book_banner_button_link');

            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('seo_image')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dining_page_content');
    }
};
