<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LodgePageContent extends Model
{
    use HasFactory;

    protected $table = 'lodge_page_content';

    protected $fillable = [
        'page_title',
        'slug',
        'hero_title',
        'hero_content',
        'hero_background_image',
        'banner_one_title',
        'banner_one_content',
        'banner_one_images',
        'banner_two_title',
        'banner_two_content',
        'banner_two_image',
        'banner_three_title',
        'banner_three_content',
        'banner_three_image',
        'seo_title',
        'seo_description',
        'seo_image',
        'seo_keywords'
    ];
}
