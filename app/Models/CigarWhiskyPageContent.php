<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CigarWhiskyPageContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_title',
        'slug',
        'hero_title',
        'hero_content',
        'hero_bg_image',

        'banner_one_title',
        'banner_one_content',
        'banner_one_image',

        'banner_two_image',
        'banner_two_title',
        'banner_two_content',

        'banner_three_title',
        'banner_three_content',
        'banner_three_image',

        'seo_title',
        'seo_description',
        'seo_image',
        'seo_keywords',
    ];
}
