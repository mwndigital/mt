<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RestaurantBlockedDates;
use Illuminate\Http\Request;

class AdminRestaurantBlockedDatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blockedDates = RestaurantBlockedDates::all();

        return view('admin.pages.restaurant.blocked-dates.index', compact('blockedDates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.restaurant.blocked-dates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'date' => ['required', 'unique:restaurant_blocked_dates']
        ]);


        RestaurantBlockedDates::create([
            'date' => $validated['date']
        ]);

        return redirect('admin/restaurant-bookings/restaurant-blocked-dates')->with('success', 'Blocked date added');
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
