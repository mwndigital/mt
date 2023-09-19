<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomGalleries extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'room_id',
    ];
}
