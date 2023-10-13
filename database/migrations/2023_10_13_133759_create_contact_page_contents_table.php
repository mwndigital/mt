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
        Schema::create('contact_page_contents', function (Blueprint $table) {
            $table->id();

            $table->string('page_title');
            $table->string('slug');
            $table->string('hero_title');
            $table->text('hero_sub_title');
            $table->string('hero_background_image');

            $table->string('banner_one_title');
            $table->text('banner_one_content');
            $table->json('banner_one_images');


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
        Schema::dropIfExists('contact_page_contents');
    }
};
