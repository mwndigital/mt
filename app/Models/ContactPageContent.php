<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPageContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_title',
        'slug',
        'hero_title',
        'hero_sub_title',
        'hero_background_image',
        'banner_one_title',
        'banner_one_content',
        'banner_one_images',
        'seo_title',
        'seo_description',
        'seo_image',
        'seo_keywords',
    ];
}
