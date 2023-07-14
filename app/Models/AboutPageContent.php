<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutPageContent extends Model
{
    use HasFactory;

    protected $table = "aboutpage_page";

    protected $fillable = [
        'page_title',
        'page_slug',
        'hero_banner_background_image',
        'hero_banner_title',
        'about_banner_title',
        'about_banner_content',
        'about_banner_image',
        'banner_one_image',
        'banner_one_content',
        'banner_two_title',
        'banner_two_content',
        'banner_two_image',
    ];
}
