<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'room_id',
        'booking_ref',
        'checkin_date',
        'checkout_date',
        'arrival_time',
        'no_of_adults',
        'no_of_children',
        'no_of_infants',
        'user_title',
        'first_name',
        'last_name',
        'address_line_one',
        'address_line_two',
        'postcode',
        'city',
        'country',
        'phone_number',
        'email_address',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            if (!$booking->booking_ref) {
                $booking->booking_ref = 'mt-' . strtoupper(Str::random(8));
            }
        });
    }

    public function room()
    {
        return $this->belongsTo(Rooms::class);
    }

}
