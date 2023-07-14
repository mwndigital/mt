<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePageContent extends Model
{
    use HasFactory;

    protected $table = 'homepage_page';

    protected $fillable = [
        'page_title',
        'page_slug',
        'hero_banner_title',
        'hero_banner_content',
        'hero_banner_background_image',
        'banner_one_image',
        'banner_one_title',
        'banner_one_content',
        'banner_one_button_link',
        'rooms_banner_sub_title',
        'rooms_banner_title',
        'rooms_banner_content',
        'rooms_banner_button_link',
        'spend_night_banner_title',
        'spend_night_banner_content',
        'spend_night_banner_button_link',
        'spend_night_banner_background_image',
        'page_description',
        'page_keywords',
        'page_type'
    ];
}
