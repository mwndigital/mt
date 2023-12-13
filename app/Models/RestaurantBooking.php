<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class RestaurantBooking extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'mobile_number',
        'reservation_date',
        'reservation_time',
        'reservation_end_time',
        'no_of_guests',
        'table_id',
        'joining_for',
        'additional_information',
        'dietary_info',
        'table_ids',
        'status'
    ];

    public function restaurantTable() {
        return $this->belongsTo(RestaurantTable::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function toSearchableArray()
    {
        return [
            'full_name' => $this->full_name,
            'email' => $this->email,
            'reservation_date' => $this->reservation_date,
            'reservation_time' => $this->reservation_time,

        ];
    }

}
