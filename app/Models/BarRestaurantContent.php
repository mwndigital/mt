<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarRestaurantContent extends Model
{
    use HasFactory;

    protected $table = 'bar_restaurant';

    protected $fillable = [
        'hero_banner_title',
        'hero_banner_background_image',
        'banner_one_title',
        'banner_one_content',
        'banner_one_big_image',
        'banner_one_small_image',
        'separator_banner_image',
        'banner_two_title',
        'banner_two_content',
        'banner_two_image',
        'book_stay_banner_title',
        'book_stay_banner_content',
        'book_stay_banner_background_image',
    ];
}
