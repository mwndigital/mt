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

        // Format date if it matches a specific pattern (e.g., 'd/m/Y')
        if ($this->isDate($query)) {
            $formattedDate = Carbon::createFromFormat('d/m/Y', $query)->format('Y-m-d');
            $bookings = Booking::search($formattedDate)->get();
            $restaurantBooking = RestaurantBooking::search($formattedDate)->get();
        } else {
            // Handle other types of queries or directly use the input query
            $bookings = Booking::search($query)->get();
            $restaurantBooking = RestaurantBooking::search($query)->get();
        }

        return view('admin.pages.search.results', compact('restaurantBooking', 'bookings'));
    }

    /**
     * Check if the input is a date with the specified format.
     *
     * @param string $input
     * @param string $format
     * @return bool
     */
    private function isDate($input, $format = 'd/m/Y')
    {
        $parsedDate = Carbon::createFromFormat($format, $input);

        return $parsedDate && $parsedDate->format($format) === $input;
    }
}
