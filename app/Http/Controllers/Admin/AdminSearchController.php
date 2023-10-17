<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\RestaurantBooking;
use Illuminate\Http\Request;

class AdminSearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function search(Request $request)
    {
        $query = $request->input('q');

        $bookings = Booking::search($query)->get();
        $restaurantBooking = RestaurantBooking::search($query)->get();

        return view('admin.pages.search.results', compact('bookings', 'restaurantBooking'));
    }
}
