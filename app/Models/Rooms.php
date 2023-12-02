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
        return $this->hasMany(RoomGalleries::class, 'room_id')->orderBy('sort', 'asc');
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
        return Booking::select('bookings.*')
            ->leftJoin('booking_room', 'bookings.id', '=', 'booking_room.booking_id')
            ->join('rooms', 'rooms.id', '=', 'booking_room.room_id')
            ->where('booking_room.room_id', $this->id)
            ->where(function ($query) use ($checkIn, $checkOut) {
                $query->where('bookings.checkin_date', '<', $checkOut)
                    ->where('bookings.checkout_date', '>', $checkIn);
            })
            ->whereIn('bookings.status', [
                BookingStatus::CONFIRMED->value,
                BookingStatus::PAID->value,
                BookingStatus::PENDING->value
            ])
            ->orderBy('bookings.id')
            ->get();
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
        $startDate = Carbon::parse($startDate)->subDays(15)->format('Y-m-d');
        $booked_dates = $this->getBookedDates($startDate, $endDate)->pluck('checkin_date', 'checkout_date')->toArray();
        $dates = [];

        for ($date = Carbon::parse($startDate); $date->lte($endDate); $date->addDay()) {
            $currentDate = $date->format('Y-m-d');
            foreach ($booked_dates as $checkout_date => $checkin_date) {
                if ($currentDate >= $checkin_date && $currentDate < $checkout_date) {
                    $dates[] = $currentDate;
                    break;
                }
            }
        }

        return $dates;
    }
}
