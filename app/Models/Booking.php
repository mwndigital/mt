<?php

namespace App\Models;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Booking extends Model implements \Serializable
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
        'duration_of_stay',
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

            $checkin = Carbon::createFromFormat('d-m-Y', $booking->checkin_date);
            $checkout = Carbon::createFromFormat('d-m-Y', $booking->checkout_date);
            $duration = $checkout->diffInDays($checkin);

            $booking->duration_of_stay = $duration;
        });
    }

    public function room()
    {
        return $this->belongsTo(Rooms::class);
    }

    public function serialize()
    {
        return serialize($this->getAttributes());
    }

    public function unserialize($data)
    {
        $attributes = unserialize($data);
        $this->setRawAttributes($attributes);
    }
}
