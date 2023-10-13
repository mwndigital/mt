<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Enums\BookingStatus;

class AvailableController extends Controller
{
    public function index(Request $request)
    {
        $start_date = \Carbon\Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
        $end_date = \Carbon\Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d');

        // Find unavailable dates from bookings room
        $bookings = Booking::where('status', '!=', BookingStatus::DRAFT)
            ->where('checkin_date', '<=', $end_date)
            ->where('checkout_date', '>=', $start_date)
            ->get();

        // Check rooms availability from bookings
        $unavailable = [];
        foreach ($bookings as $booking) {
            $unavailable[] = [
                'start' => $booking->checkin_date,
                'end' => $booking->checkout_date,
            ];
        }

        return response()->json([
            'unavailable' => $unavailable,
        ]);
    }
}
