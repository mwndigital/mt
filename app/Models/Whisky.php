<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Whisky extends Model
{
    use HasFactory;

    protected $table = 'whisky';

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'drink_size',
    ];
}
