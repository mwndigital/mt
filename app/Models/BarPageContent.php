<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarPageContent extends Model
{
    use HasFactory;

    protected $table = 'bar_page_content';

    protected $fillable = [
        'page_title',
        'slug',
        'hero_title',
        'hero_content',
        'hero_banner_background_image',
        'banner_one_title',
        'banner_one_content',
        'banner_one_image',
        'banner_two_title',
        'banner_two_content',
        'banner_two_image',
        'banner_three_title',
        'banner_three_content',
        'banner_three_image',
        'book_banner_title',
        'book_banner_content',
        'book_banner_background_image',
        'book_banner_button_content',
        'book_banner_button_link',
        'seo_title',
        'seo_description',
        'seo_image',
        'seo_keywords',
    ];
}
