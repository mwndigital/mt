<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutPageContentNew extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_title',
        'page_slug',
        'hero_title',
        'hero_content',
        'hero_bg_image',
        'banner_one_title',
        'banner_one_content',
        'banner_one_image',
        'banner_two_title',
        'banner_two_content',
        'banner_two_image',
        'banner_three_title',
        'banner_three_content',
        'banner_four_title',
        'banner_four_content',
        'banner_four_image',
        'banner_five_title',
        'banner_five_content',
        'banner_five_image',
        'banner_six_title',
        'banner_six_content',
        'banner_six_image',
        'banner_seven_title',
        'banner_seven_content',
        'banner_eight_title',
        'banner_eight_content',
        'banner_eight_image',
    ];
}
