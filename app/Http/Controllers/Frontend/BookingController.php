<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Monarobase\CountryList\CountryListFacade;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Rooms::all();
        return view('frontend.pages.booking.index', compact('rooms'));
    }

    public function stepTwoShow() {
        return view('frontend.pages.booking.step-2');
    }

    public function stepThreeShow() {
        $countries = CountryListFacade::getList('en');
        return view('frontend.pages.booking.step-3', compact('countries'));
    }

    public function paymentStep(){
        return view('frontend.pages.booking.step-4-payment');
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
