<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\RestaurantBooking;
use Illuminate\Http\Request;
use App\Enums\BookingStatus;

class CustomerIndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customer = auth()->user();
        $restaurantBookings = RestaurantBooking::where('user_id', $customer->id)->get();
        $hotelBookings = Booking::where('user_id', $customer->id)->where('status','!=', BookingStatus::DRAFT)->get();
        return view('customer.pages.dashboard', compact('restaurantBookings', 'customer', 'hotelBookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
