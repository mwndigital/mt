<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\BookingStatus;
use Carbon\Carbon;

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
        return $this->belongsToMany(Booking::class, 'booking_room', 'room_id', 'booking_id');
    }

    public function getTotal($isDouble)
    {
        return $isDouble ? $this->price_per_night_double : $this->price_per_night_single;
    }

    public function getBookedDates($checkIn, $checkOut)
    {
        $sql = "
        SELECT b.*
        FROM bookings b
        LEFT JOIN booking_room br ON b.id = br.booking_id
        INNER JOIN rooms r ON r.id = br.room_id
        WHERE br.room_id = ?
        AND (b.checkin_date < ? AND b.checkout_date > ?)
        ORDER BY b.id;
    ";
        $query = Booking::fromQuery($sql, [$this->id, $checkOut, $checkIn]);
        return $query;
    }




    public function checkAvailability($checkIn, $checkOut)
    {
        $booked = $this->getBookedDates($checkIn, $checkOut);

        return $booked->count() === 0;
    }

    public static function getAll($isRoom = true, $data)
    {
        if ($isRoom) {
            $rooms = Rooms::where('adult_cap', '>=', $data['no_of_adults'])
                ->where('child_cap', '>=', $data['no_of_children'])
                ->where('room_type', '!=', 'lodge')
                ->orderBy('price_per_night_single', 'asc');
        } else {
            $rooms = Rooms::where('room_type', 'lodge');
        }
        return $rooms->get();
    }

    public function getUnavailableDates($startDate, $endDate)
    {
        $booked_dates = $this->getBookedDates($startDate, $endDate)->pluck('checkout_date', 'checkin_date')->toArray();

        $unavailable_dates = [];
        // Check every day between start and end date if it is in the booked dates array
        for ($date = Carbon::parse($startDate); $date->lte($endDate); $date->addDay()) {
            $currentDate = $date->format('Y-m-d');

            foreach ($booked_dates as $checkin_date => $checkout_date) {
                if ($currentDate >= $checkin_date && $currentDate < $checkout_date) {
                    $unavailable_dates[] = $currentDate;
                    break; // Break out of the loop once a match is found
                }
            }
        }

        return $unavailable_dates;
    }
}
