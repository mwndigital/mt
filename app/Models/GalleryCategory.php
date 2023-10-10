<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'featured_image',
    ];

    public function gallery() {
        return $this->hasMany(GalleryCategory::class);
    }
}
