<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PolicyPages extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'main_content'
    ];
}
