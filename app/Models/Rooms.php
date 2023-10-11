<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'room_type',
        'adult_cap',
        'child_cap',
        'bathroom_type',
        'description',
        'short_description',
        'slug',
        'price_per_night_double',
        'price_per_night_single',
        'featured_image',
    ];


    public function images()
    {
        return $this->hasMany(RoomGalleries::class, 'room_id');
    }

    public function bookings()
    {
        return $this->belongsToMany(Booking::class);
    }

    public function getTotal($isDouble)
    {
        return $isDouble ? $this->price_per_night_double : $this->price_per_night_single;
    }
}
