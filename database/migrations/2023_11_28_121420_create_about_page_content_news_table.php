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
        Schema::create('about_page_content_news', function (Blueprint $table) {
            $table->id();
            $table->string('page_title');
            $table->string('page_slug');
            $table->string('hero_title');
            $table->string('hero_content');
            $table->string('hero_bg_image');
            $table->string('banner_one_title');
            $table->text('banner_one_content');
            $table->string('banner_one_image');

            $table->string('banner_two_title');
            $table->text('banner_two_content');
            $table->string('banner_two_image');

            $table->string('banner_three_title');
            $table->text('banner_three_content');

            $table->string('banner_four_title');
            $table->text('banner_four_content');
            $table->string('banner_four_image');
            $table->string('banner_five_title');
            $table->text('banner_five_content');
            $table->string('banner_five_image');
            $table->string('banner_six_title');
            $table->text('banner_six_content');
            $table->string('banner_six_image');

            $table->string('banner_seven_title');
            $table->text('banner_seven_content');

            $table->string('banner_eight_title');
            $table->text('banner_eight_content');
            $table->string('banner_eight_image');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_page_content_news');
    }
};
