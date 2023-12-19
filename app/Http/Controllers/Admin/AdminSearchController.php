<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\RestaurantBooking;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminSearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function search(Request $request)
    {
        $query = $request->input('search');

        // Check if the input is a valid date
        $formattedDate = $this->tryFormatDate($query);

        if ($formattedDate !== null) {
            // If it's a valid date, perform the search with the formatted date
            $bookings = Booking::search($formattedDate)->get();
            $restaurantBooking = RestaurantBooking::search($formattedDate)->get();
        } else {
            // If it's not a date, directly use the input for searching
            $bookings = Booking::search($query)->get();
            $restaurantBooking = RestaurantBooking::search($query)->get();
        }

        return view('admin.pages.search.results', compact('restaurantBooking', 'bookings'));
    }

    /**
     * Try to format the input as a date. Returns null if the input is not a valid date.
     *
     * @param string $input
     * @param string $format
     * @return string|null
     */
    private function tryFormatDate($input, $format = 'd/m/Y')
    {
        try {
            $parsedDate = Carbon::createFromFormat($format, $input);
            return $parsedDate ? $parsedDate->format('Y-m-d') : null;
        } catch (\Exception $e) {
            return null; // Return null if the input is not a valid date
        }
    }
}
