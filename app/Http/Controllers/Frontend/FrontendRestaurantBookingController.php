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
        $table_booking = $request->session()->get('table_booking');

        $tables = RestaurantTable::all();

        $today = Carbon::today()->startOfDay();
        $startOfWeek = $today->copy()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = $today->copy()->endOfWeek(Carbon::SUNDAY);

        $min_date = Carbon::now()->addDay(1);
        $max_date = Carbon::now()->addMonth(6);
        $today = Carbon::now()->format('l');

        return view('frontend.pages.restaurant-bookings.index', compact('tables', 'today', 'min_date', 'max_date', 'table_booking'));
    }

    public function indexStore(Request $request) {
        $validated = $request->validate([
            'reservation_date' => ['required', 'date'],
            'reservation_time' => ['required', 'string'],
            'no_of_guests' => ['required', 'integer'],
            'joining_for' => ['required', 'string', 'max:255'],
        ]);

        if(empty($request->session()->get('table_booking'))){
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
        $table_booking = $request->session()->get('table_booking');
        $res_tables_ids = RestaurantBooking::orderBy('reservation_date')->get()
            ->filter(function($value) use ($table_booking){
                return $value->reservation_date == $table_booking->reservation_date;
            })->pluck('table_id');
        $tables = RestaurantTable::where('status', 'available')
            ->where('no_of_seats', $table_booking->no_of_seats)
            ->whereNotIn('id', $res_tables_ids)->get();

        return view('frontend.pages.restaurant-bookings.step-2', compact('table_booking', 'tables'));
    }
    public function stepTwoStore(Request $request) {

    }


}
