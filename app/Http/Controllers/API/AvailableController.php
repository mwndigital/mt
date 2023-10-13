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
        // Get from current day to 3 month after all bookings and get unavailable dates
        $today = now()->format('Y-m-d');
        $threeMonthAfter = now()->addMonths(5)->format('Y-m-d');
        $rooms = Rooms::getAll($isRoom, [
            'no_of_adults' => $adults,
            'no_of_children' => $children

        ]);

        $unavailable_dates = [];

        foreach ($rooms as $room) {
            $unavailable_dates[$room->id] = $room->getUnavailableDates($today, $threeMonthAfter);
        }

        return response()->json([
            'success' => true,
            'type' => $request->type,
            'rooms' => $rooms,
            'unavailable_dates' => $unavailable_dates
        ]);
    }
}
