<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\RestaurantBooking;
use App\Models\RestaurantTable;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FrontendRestaurantBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tbooking = $request->session()->get('RestaurantBooking');

        $tables = RestaurantTable::all();

        $today = Carbon::today()->startOfDay();
        $startOfWeek = $today->copy()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = $today->copy()->endOfWeek(Carbon::SUNDAY);

        $min_date = Carbon::now()->addDay(1);
        $max_date = Carbon::now()->addMonth(6);
        $today = Carbon::now()->format('l');

        return view('frontend.pages.restaurant-bookings.index', compact('tables', 'today', 'min_date', 'max_date', 'tbooking'));
    }

    public function indexStore(Request $request) {
        $validated = $request->validate([
            'reservation_date' => ['required', 'date'],
            'reservation_time' => ['required', 'string'],
            'guest_number' => ['required', 'integer'],
            'joining_for' => ['required', 'string', 'max:255'],
        ]);

        if(empty($request->session()->get('RestaurantBooking'))){
            $table_booking = new RestaurantBooking();
            $table_booking->fill($validated);
            $request->session()->put('table_booking', $table_booking);
        }
        else {
            $table_booking = $request->session()->get('table_booking');
            $table_booking->fill($validated);
            $request->session()->put('table_booking', $table_booking);
        }

        return to_route('book-a-table-step-two-show');
    }

    public function stepTwoShow(Request $request) {

    }
    public function stepTwoStore(Request $request) {

    }


}
