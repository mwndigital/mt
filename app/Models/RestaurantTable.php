<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantTable extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'no_of_seats',
        'status',
        'bookable_by_guests',
    ];

    public function restaurantBooking() {
        return $this->hasMany(RestaurantBooking::class);
    }
}
