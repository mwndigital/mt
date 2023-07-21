<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\BookingConfirmationMail;
use App\Models\booking;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Monarobase\CountryList\CountryListFacade;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $booking = $request->session()->get('booking');

        return view('frontend.pages.booking.index', compact( 'booking', ));
    }

    public function stepOneStore(Request $request) {
        $validated = $request->validate([
            'checkin_date' => ['required', 'date_format:d-m-Y'],
            'checkout_date' => ['required', 'date_format:d-m-Y'],
            'arrival_time' => ['required'],
            'no_of_adults' => ['required', 'integer'],
            'no_of_children' => ['required', 'integer'],
        ]);

        if (empty($request->session()->get('booking'))){
            $booking = new Booking();
        } else {
            $booking = $request->session()->get('booking');
        }

        // Convert date strings to Y-m-d format using Carbon
        $booking->checkin_date = Carbon::createFromFormat('d-m-Y', $validated['checkin_date'])->format('Y-m-d');
        $booking->checkout_date = Carbon::createFromFormat('d-m-Y', $validated['checkout_date'])->format('Y-m-d');

        $booking->fill($validated);
        $request->session()->put('booking', $booking);

        return to_route('book-a-room-step-2');
    }

    public function stepTwoShow(Request $request) {
        $booking = $request->session()->get('booking');
        //Check the number of Adults and Kids from prev step and display only the applicable rooms
        $rooms = Rooms::where('adult_cap', '>=', $booking->no_of_adults)
            ->where('child_cap', '>=', $booking->no_of_children)
            ->get();

        return view('frontend.pages.booking.step-2', compact('booking', 'rooms'));
    }

    public function stepTwoStore(Request $request)
    {
        $validated = $request->validate([
            'room_id' => ['required', 'integer'],
        ]);

        $booking = $request->session()->get('booking');
        $booking->fill($validated);
        $request->session()->put('booking', $booking);

        // Convert date strings to Y-m-d format using Carbon
        $checkin_date = Carbon::createFromFormat('d-m-Y', $booking->checkin_date)->format('Y-m-d');
        $checkout_date = Carbon::createFromFormat('d-m-Y', $booking->checkout_date)->format('Y-m-d');

        // Check if any booking conflicts exist for the selected room and dates
        $conflictingBooking = DB::table('bookings')
            ->where('room_id', $booking->room_id)
            ->where(function ($query) use ($checkin_date, $checkout_date) {
                $query->whereBetween('checkin_date', [$checkin_date, $checkout_date])
                    ->orWhereBetween('checkout_date', [$checkin_date, $checkout_date])
                    ->orWhere(function ($query) use ($checkin_date, $checkout_date) {
                        $query->where('checkin_date', '<=', $checkin_date)
                            ->where('checkout_date', '>=', $checkout_date);
                    });
            })
            ->first();

        if ($conflictingBooking) {
            // Booking conflicts exist, redirect back with a notice
            return redirect()->route('book-a-room-step-2')
                ->with('room_conflict', true);
        }

        return redirect()->route('book-a-room-step-3');
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
        /*$validated = $request->validate([
            'cancellationPolicyAgree' => ['required'],
        ]);

        $booking = $request->session()->get('booking');
        $booking->fill($validated);
        $request->session()->put('booking', $booking);

        return to_route('book-a-room-step-4');*/

        $validated = $request->validate([
           'cancellationPolicyAgree' => ['required']

        ]);
        $booking = $request->session()->get('booking');
        $booking->fill($validated);
        $booking->save();
        $request->session()->forget('booking');

        Mail::to($booking['email_address'])->send(new BookingConfirmationMail($booking));

        return redirect('book-a-room/thank-you');

    }



    public function paymentStep(){
        return view('frontend.pages.booking.step-payment');
    }

    public function thankYou() {
        return view('frontend.pages.booking.thank-you');
    }


}
