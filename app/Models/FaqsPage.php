<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqsPage extends Model
{
    use HasFactory;

    protected $table = 'faqs_page';

    protected $fillable = [
        'main_title',
        'sub_title',
        'slug',
        'seo_title',
        'seo_description',
        'seo_image',
        'seo_keywords',
    ];
}
