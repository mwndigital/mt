<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\BookingConfirmationMail;
use App\Models\Booking;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Monarobase\CountryList\CountryList;
use Monarobase\CountryList\CountryListFacade;
use App\Enums\BookingStatus;

class AdminBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::where('status', '!=', BookingStatus::DRAFT)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.pages.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $booking = $request->session()->get('booking');
        return view('admin.pages.bookings.create-steps.step-one', compact('booking'));
    }

    public function stepOneStore(Request $request)
    {
        $validated = $request->validate([
            'checkin_date' => ['required', 'date_format:d-m-Y'],
            'checkout_date' => ['required', 'date_format:d-m-Y'],
            'arrival_time' => ['required'],
            'no_of_adults' => ['required', 'integer'],
            'no_of_children' => ['required', 'integer'],
        ]);

        if (empty($request->session()->get('booking'))) {
            $booking = new Booking();
        } else {
            $booking = $request->session()->get('booking');
        }

        // Convert date strings to Y-m-d format using Carbon
        $booking->checkin_date = Carbon::createFromFormat('d-m-Y', $validated['checkin_date'])->format('Y-m-d');
        $booking->checkout_date = Carbon::createFromFormat('d-m-Y', $validated['checkout_date'])->format('Y-m-d');

        // Convert date strings to Y-m-d format using Carbon
        $checkinDate = Carbon::createFromFormat('d-m-Y', $validated['checkin_date'])->format('Y-m-d');
        $checkoutDate = Carbon::createFromFormat('d-m-Y', $validated['checkout_date'])->format('Y-m-d');

        $booking->checkin_date = $checkinDate;
        $booking->checkout_date = $checkoutDate;

        // Calculate the duration of the stay in days
        $duration = Carbon::parse($checkinDate)->diffInDays(Carbon::parse($checkoutDate));

        $booking->duration_of_stay = $duration;
        $booking->fill($validated);
        $request->session()->put('booking', $booking);

        return to_route('admin.book-a-room-step-two');
    }
    public function stepTwoShow(Request $request)
    {
        $booking = $request->session()->get('booking');

        // Fetch available rooms based on the number of adults and children
        $availableRooms = Rooms::where('adult_cap', '>=', $booking->no_of_adults)
            ->where('child_cap', '>=', $booking->no_of_children)
            ->get();

        // Get the check-in and check-out dates in the "d-m-Y" format
        $checkinDate = Carbon::createFromFormat('d-m-Y', $booking->checkin_date)->format('d-m-Y');
        $checkoutDate = Carbon::createFromFormat('d-m-Y', $booking->checkout_date)->format('d-m-Y');

        // Filter out the rooms that have conflicts with existing bookings for the selected time period
        $filteredRooms = $availableRooms->filter(function ($room) use ($checkinDate, $checkoutDate) {
            $conflictingBooking = Booking::where('room_id', $room->id)
                ->whereIn('status', [BookingStatus::CONFIRMED, BookingStatus::PENDING])
                ->where(function ($query) use ($checkinDate, $checkoutDate) {
                    $query->whereBetween('checkin_date', [$checkinDate, $checkoutDate])
                        ->orWhereBetween('checkout_date', [$checkinDate, $checkoutDate])
                        ->orWhere(function ($query) use ($checkinDate, $checkoutDate) {
                            $query->where('checkin_date', '<=', $checkinDate)
                                ->where('checkout_date', '>=', $checkoutDate);
                        });
                })
                ->exists();

            return !$conflictingBooking;
        });
        return view('admin.pages.bookings.create-steps.step-two', compact('booking', 'filteredRooms'));
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
            return redirect()->route('admin.book-a-room-step-two')
                ->with('room_conflict', true);
        }

        return redirect()->route('admin.book-a-room-step-three');
    }

    public function stepThreeShow(Request $request)
    {
        $booking = $request->session()->get('booking');
        $countries = CountryListFacade::getList('en');
        return view('admin.pages.bookings.create-steps.step-three', compact('booking', 'countries'));
    }
    public function stepThreeStore(Request $request)
    {
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

        // Create an instance of CountryList
        $countryList = new CountryList();

        // Get the country code based on the provided country name
        $countries = $countryList->getList('en'); // 'en' for English locale

        // Search for the country code based on the provided country name
        $countryCode = array_search($validated['country'], $countries);

        // If the country name is invalid or not found, handle the error accordingly
        if (!$countryCode) {
            // Handle the error (e.g., redirect back with an error message)
            return back()->withErrors(['country' => 'Invalid country name.']);
        }

        // Update the 'country' field with the country code
        $validated['country'] = $countryCode;

        $booking = $request->session()->get('booking');
        $booking->fill($validated);
        $request->session()->put('booking', $booking);


        return to_route('admin.book-a-room-step-four');
    }
    public function stepFourShow(Request $request)
    {
        $booking = $request->session()->get('booking');

        $roomName = $booking['room_name'];
        return view('admin.pages.bookings.create-steps.step-four', compact('booking', 'roomName'));
    }
    public function stepFourStore(Request $request)
    {
        $booking = $request->session()->get('booking');
        $validated = $request->validate([
            'cancellationPolicyAgree' => ['nullable'],
        ]);
        $booking->fill($validated);
        $booking->save();
        $request->session()->forget('booking');

        Mail::to($booking['email_address'])->send(new BookingConfirmationMail($booking));

        return redirect('admin/bookings')->with('success', 'New booking has been created successfully and an email has been sent to the customer');
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
        $booking = Booking::findOrFail($id);
        return view('admin.pages.bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $booking = Booking::findOrFail($id);
        $countries = CountryListFacade::getList('en');

        return view('admin.pages.bookings.edit', compact('booking', 'countries'));
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

    public function changeStatus(Request $request, string $id)
    {
        $request->validate([
            'status' => ['required', 'string', 'max:15'],
        ]);

        $booking = Booking::findOrFail($id);

        // Action
        $response = match ($request->status) {
            'confirmed' => [
                'action' => $booking->confirm(),
                'message' => 'Booking has been confirmed successfully',
            ],
            'cancelled' => [
                'action' => $booking->cancel(),
                'message' => 'Booking has been cancelled successfully',
            ]
        };

        return redirect()->back()->with('success', $response['message']);
    }
}
