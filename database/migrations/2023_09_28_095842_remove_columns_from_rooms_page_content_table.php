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
        Schema::table('rooms_page_content', function (Blueprint $table) {
            $table->string('slug')->after('page_title');
            $table->text('hero_content')->after('hero_banner_title');

            $table->string('seo_title')->nullable()->after('hero_banner_background_image');
            $table->text('seo_description')->nullable()->after('seo_title');
            $table->string('seo_image')->nullable()->after('seo_description');
            $table->string('seo_keywords')->nullable()->after('seo_image');
            $table->dropColumn('page_slug');
            $table->dropColumn('rooms_info_banner_content');
            $table->dropColumn('page_description');
            $table->dropColumn('page_keywords');
            $table->dropColumn('page_image');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rooms_page_content', function (Blueprint $table) {
            //
        });
    }
};
