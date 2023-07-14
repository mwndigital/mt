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
        'page_slug',
        'hero_banner_title',
        'hero_banner_background_image',
        'rooms_info_banner_content',
        'page_description',
        'page_keywords',
        'page_type',
        'page_image',
    ];
}
