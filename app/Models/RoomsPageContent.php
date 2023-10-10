<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomsPageContent extends Model
{
    use HasFactory;

    protected $table = 'rooms_page_content';

    protected $fillable = [
        'page_title',
        'slug',
        'hero_banner_title',
        'hero_content',
        'hero_banner_background_image',
        'seo_title',
        'seo_description',
        'seo_image',
        'seo_keywords'
    ];
}
