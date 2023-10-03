<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiningPageContent extends Model
{
    use HasFactory;

    protected $table = 'dining_page_content';

    protected $fillable = [
      'page_title',
      'slug',
      'hero_title',
      'hero_content',
      'hero_background_image',
      'banner_one_title',
      'banner_one_content',
      'banner_one_image',
      'book_banner_title',
      'book_banner_content',
      'book_banner_background_image',
      'book_banner_button_content',
      'book_banner_button_link',
      'seo_title',
      'seo_description',
      'seo_keywords',
      'seo_image',
        'page_file_id'
    ];
    public function diningPageFiles(){
        return $this->hasMany(DiningPageFile::class);
    }
}
