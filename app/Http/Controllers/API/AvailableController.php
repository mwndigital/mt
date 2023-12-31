<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Enums\BookingStatus;
use Carbon\Carbon;
use App\Models\Rooms;

class AvailableController extends Controller
{
    public function index(Request $request)
    {
        $isRoom = $request->type == 'room' ?? false;
        $adults = $request->adults ?? 1;
        $children = $request->children ?? 0;
        // Get from current day to 24 month after all bookings and get unavailable dates
        $today = now()->format('Y-m-d');
        $monthsAfter = now()->addMonths(24)->format('Y-m-d');
        $rooms = Rooms::getAll($isRoom, [
            'no_of_adults' => $adults,
            'no_of_children' => $children
        ]);

        $unavailable_dates = [];
        $room_unavailable_dates = [];


        if (!$rooms->isEmpty()) :
            foreach ($rooms as $room) {
                $room_unavailable_dates[] = [
                    'room_id' => $room->id,
                    'room_name' => $room->name,
                    'unavailable_dates' => $room->getUnavailableDates($today, $monthsAfter)
                ];
            }

            // If every room is unavailable in same date, then it is unavailable
            if($isRoom) $unavailable_dates = array_intersect(...array_column($room_unavailable_dates, 'unavailable_dates'));

            // if any lodge is unavailable, then it is unavailable
            if(!$isRoom) $unavailable_dates = array_merge(...array_column($room_unavailable_dates, 'unavailable_dates'));
            // remove key from array
            $unavailable_dates = array_values($unavailable_dates);
        endif;

        return response()->json([
            'success' => $rooms->count() > 0,
            'type' => $request->type,
            'unavailable_dates' => $unavailable_dates,
        ]);
    }

    public function checkRoom(Request $request)
    {
        $checkInDate = Carbon::parse($request->checkin_date);
        $checkOutDate = Carbon::parse($request->checkout_date);
        $room = Rooms::find((int)$request->room_id);

        return response()->json([
            'is_available' => $room->checkAvailability($checkInDate, $checkOutDate),
        ]);
    }
}
