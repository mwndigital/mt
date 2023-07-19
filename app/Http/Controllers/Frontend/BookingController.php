<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\booking;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Monarobase\CountryList\CountryListFacade;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rooms = Rooms::all();
        $booking = $request->session()->get('booking');
        return view('frontend.pages.booking.index', compact('rooms', 'booking'));
    }

    public function stepOneStore(Request $request) {
        $validated = $request->validate([
            'room_id' => ['required', 'integer']
        ]);

        if(empty($request->session()->get('booking'))){
            $booking = new Booking();
            $booking->fill($validated);
            $request->session()->put('booking', $booking);
        }
        else {
            $booking = $request->session()->get('booking');
            $booking->fill($validated);
            $request->session()->put('booking', $booking);
        }

        return to_route('book-a-room-step-2');

    }

    public function stepTwoShow(Request $request) {
        $booking = $request->session()->get('booking');
        return view('frontend.pages.booking.step-2', compact('booking', ));
    }

    public function stepTwoStore(Request $request) {
        $validated = $request->validate([
            'checkin_date' => ['required'],
            'checkout_date' => ['required'],
            'arrival_time' => ['required'],
            'no_of_adults' => ['required', 'integer'],
            'no_of_children' => ['required', 'integer']
        ]);

        $booking = $request->session()->get('booking');
        $booking->fill($validated);
        $request->session()->put('booking', $booking);

        return to_route('book-a-room-step-3');
    }

    public function stepThreeShow(Request $request) {
        $booking = $request->session()->get('booking');
        $countries = CountryListFacade::getList('en');
        return view('frontend.pages.booking.step-3', compact('booking', 'countries'));
    }

    public function stepThreeStore(Request $request) {
        $validated = $request->validate([
            'user_title' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'address_line_one' => ['required', 'string', 'max:255'],
            'address_line_two' => ['nullable', 'string', 'max:255'],
            'postcode' => ['required', 'string', 'max:100'],
            'city' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'max:13'],
            'email_address' => ['required', 'email']
        ]);

        $booking = $request->session()->get('booking');
        $booking->fill($validated);
        $request->session()->put('booking', $booking);

        return to_route('book-a-room-step-4');
    }
    public function stepFourShow(Request $request) {
        $booking = $request->session()->get('booking');

        $roomName = $booking['room_name'];
        return view('frontend.pages.booking.step-4', compact('booking', 'roomName'));
    }

    public function stepFourStore(Request $request) {
        $validated = $request->validate([
            'cancellationPolicyAgree' => ['required'],
        ]);

        $booking = $request->session()->get('booking');
        $booking->fill($validated);
        $request->session()->put('booking', $booking);

        return to_route('book-a-room-step-4');
    }



    public function paymentStep(){
        return view('frontend.pages.booking.step-payment');
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
