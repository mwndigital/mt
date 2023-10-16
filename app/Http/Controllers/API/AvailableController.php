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
        // Get from current day to 5 month after all bookings and get unavailable dates
        $today = now()->format('Y-m-d');
        $monthsAfter = now()->addMonths(6)->format('Y-m-d');
        $rooms = Rooms::getAll($isRoom, [
            'no_of_adults' => $adults,
            'no_of_children' => $children

        ]);

        $unavailable_dates = [];

        foreach ($rooms as $room) {
            $unavailable_dates[] = [
                'room_id' => $room->id,
                'room_name' => $room->name,
                'unavailable_dates' => $room->getUnavailableDates($today, $monthsAfter)
            ];
        }


        return response()->json([
            'success' => true,
            'type' => $request->type,
            'unavailable_dates' => $unavailable_dates
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
