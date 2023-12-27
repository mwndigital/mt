<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\BookingConfirmationMail;
use App\Models\Booking;
use App\Models\RestaurantTable;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Monarobase\CountryList\CountryList;
use Monarobase\CountryList\CountryListFacade;
use App\Enums\BookingStatus;
use Illuminate\Support\Facades\Validator;
use PDF;
use Illuminate\Support\Str;
use App\Mail\AdminBookingConfirmationMail;
use App\Notifications\AdminNewRoomBookingNotification;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use App\Enums\TransactionType;

class AdminBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = Carbon::today()->startOfDay();
        $startOfWeek = $today->copy()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = $today->copy()->endOfWeek(Carbon::SUNDAY);


        $latestBookings = Booking::orderBy('checkin_date', 'asc')
            ->where('status', '!=', BookingStatus::DRAFT)
            ->where('checkin_date', '>=', $today)
            ->get();

        return view('admin.pages.bookings.index', compact('latestBookings'));
    }

    public function todaysBookings()
    {
        $today = Carbon::today()->startOfDay();
        $startOfWeek = $today->copy()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = $today->copy()->endOfWeek(Carbon::SUNDAY);

        $todaysBookings = Booking::orderBy('checkin_date', 'asc')
            ->where('checkin_date', '>=', $today)
            ->where('checkin_date', '<', $today->copy()->addDay())
            ->where('status', '!=', BookingStatus::DRAFT)
            ->get();

        return view('admin.pages.bookings.todayBookings', compact('todaysBookings'));
    }

    public function thisWeeksBookingsIndex()
    {
        $today = Carbon::today()->startOfDay();
        $startOfWeek = $today->copy()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = $today->copy()->endOfWeek(Carbon::SUNDAY);

        $thisWeeksBookings = Booking::orderBy('checkin_date', 'asc')
            ->where('checkin_date', '>=', $startOfWeek)
            ->where('checkin_date', '<=', $endOfWeek)
            ->where('status', '!=', BookingStatus::DRAFT)
            ->get();

        return view('admin.pages.bookings.thisWeeksBookings', compact('thisWeeksBookings'));
    }

    public function allBookingsIndex()
    {
        $today = Carbon::today()->startOfDay();
        $startOfWeek = $today->copy()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = $today->copy()->endOfWeek(Carbon::SUNDAY);

        $allBookings = Booking::orderBy('checkin_date', 'asc')
            ->where('checkin_date', '>=', $today)
            ->where('status', '!=', BookingStatus::DRAFT)
            ->get();

        return view('admin.pages.bookings.allBookings', compact('allBookings'));
    }

    public function nextWeeksBookingsIndex()
    {
        $today = Carbon::today()->startOfDay();
        $startOfWeek = $today->copy()->startOfWeek(Carbon::MONDAY);
        $startOfNextWeek = $startOfWeek->copy()->addWeek(1);
        $endOfNextWeek = $startOfNextWeek->copy()->endOfWeek(Carbon::SUNDAY);

        $nextWeeksBookings = Booking::where('checkin_date', '>=', $startOfNextWeek)
            ->where('checkin_date', '<=', $endOfNextWeek)
            ->where('status', '!=', BookingStatus::DRAFT)
            ->where('status', '!=', BookingStatus::CANCELLED)
            ->orderBy('checkin_date', 'asc')
            ->get();

        return view('admin.pages.bookings.nextWeeksBookings', compact('startOfNextWeek', 'endOfNextWeek', 'nextWeeksBookings'));
    }

    public function deletedIndex()
    {
        $allBookings = Booking::onlyTrashed()
            ->orderBy('checkin_date', 'asc')
            ->get();

        return view('admin.pages.bookings.deletedBookings', compact('allBookings'));
    }

    public function incompleteBookings()
    {
        $incomplete = Booking::where('status', 'draft')->get();

        return view('admin.pages.bookings.incompleteBookings', compact('incomplete'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $booking = $request->session()->get('booking');
        $isRoom = $request->session()->get('isRoom');
        $tables = RestaurantTable::all();
        return view('admin.pages.bookings.create-steps.step-one', compact('booking', 'tables', 'isRoom'));
    }

    public function stepOneStore(Request $request)
    {
        $isRoom = $request->type != 'lodge';
        $request->session()->put('isRoom', $isRoom);

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

        // Calculate the duration of the stay in days
        $duration = Carbon::parse($checkinDate)->diffInDays(Carbon::parse($checkoutDate));

        if (!$isRoom && $duration == 1) {
            return redirect()->back()
                ->with('error', 'Minimum stay for lodge is 2 nights.');
        }
        if (!$duration) {
            return redirect()->back()
                ->with('error', 'Check-in date and check-out date cannot be the same.');
        }

        $booking->duration_of_stay = $duration;
        $validated['checkin_date'] = $checkinDate;
        $validated['checkout_date'] = $checkoutDate;
        $validated['booking_ref'] = 'mt-' . strtoupper(Str::random(8));
        $booking->fill($validated);
        $request->session()->put('booking', $booking);

        return to_route('admin.book-a-room-step-two');
    }
    public function stepTwoShow(Request $request)
    {
        $booking = $request->session()->get('booking');
        $isRoom = $request->session()->get('isRoom');
        $checkInDate = $booking->checkin_date;
        $checkOutDate = $booking->checkout_date;
        $rooms = Rooms::getAll(
            $isRoom,
            [
                'no_of_adults' => $booking->no_of_adults,
                'no_of_children' => $booking->no_of_children,
            ]
        );

        $filteredRooms = $rooms->filter(function ($room) use ($checkInDate, $checkOutDate) {
            return $room->checkAvailability($checkInDate, $checkOutDate);
        });


        if ($filteredRooms->isEmpty() || (!$isRoom && $filteredRooms->count() != $rooms->count())) {
            // Booking conflicts exist, redirect /admin/bookings/create
            return back()->with('room_conflict', true)->with('checkin_date', Carbon::parse($checkInDate)->format('d-m-Y'))->with('checkout_date', Carbon::parse($checkOutDate)->format('d-m-Y'));
        }

        return view('admin.pages.bookings.create-steps.step-two', compact('booking', 'filteredRooms'));
    }

    public function stepTwoStore(Request $request)
    {
        $validated = $request->validate([
            'room_id' => ['required', 'array'],
        ]);
        $roomIds = $validated['room_id'];

        $booking = $request->session()->get('booking');
        $rooms = Rooms::whereIn('id', $roomIds)->get();
        $booking->rooms = $rooms;

        $checkInDate = $booking->checkin_date;
        $checkOutDate = $booking->checkout_date;

        $booking->fill($validated);
        $request->session()->put('booking', $booking);

        $filteredRooms = $rooms->filter(function ($room) use ($checkInDate, $checkOutDate) {
            return $room->checkAvailability($checkInDate, $checkOutDate);
        });

        if ($filteredRooms->isEmpty()) {
            // Booking conflicts exist, redirect back with a notice
            return redirect()->route('admin.book-a-room-step-two')
                ->with('room_conflict', true);
        }

        return redirect()->route('admin.book-a-room-step-three');
    }

    public function stepThreeShow(Request $request)
    {
        $booking = $request->session()->get('booking');
        $isRoom = $request->session()->get('isRoom');
        $countries = CountryListFacade::getList('en');
        return view('admin.pages.bookings.create-steps.step-three', compact('booking', 'countries', 'isRoom'));
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
        return view('admin.pages.bookings.create-steps.step-four', compact('booking'));
    }
    public function stepFourStore(Request $request)
    {
        $isDepositPaid = $request->input('depositPaid');

        $booking = $request->session()->get('booking');
        $isRoom = $request->session()->get('isRoom');
        $validated = $request->validate([
            'cancellationPolicyAgree' => ['nullable'],
        ]);
        $booking->fill($validated);

        $currentData = $booking->toArray();
        unset($currentData['rooms']);

        $book = Booking::create(array_merge($currentData, [
            'booking_ref' => 'mt-' . strtoupper(Str::random(8)),
            'status' => BookingStatus::CONFIRMED,
            'total' =>  $booking->getTotalAmount(),
            'type' => $isRoom ? 'room' : 'lodge',
            'payment_method' => 'manual',
        ]));

        $book->rooms()->sync($booking->rooms);

        // Create a transaction for the deposit
        if ($isDepositPaid) {
            $book->createTransaction($book->deposit, TransactionType::DEPOSIT->value, 'manual');
        }

        // Send email to customer
        try {
            Mail::to($booking['email_address'])->send(new BookingConfirmationMail($booking));
            Mail::to('reservations@mashtun-aberlour.com')->send(new AdminBookingConfirmationMail($book));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        // Notify admins
        try {
            $adminUsers = Role::whereIn('name', ['admin', 'super admin'])->first()->users;
            foreach ($adminUsers as $adminUser) {
                $adminUser->notify(new AdminNewRoomBookingNotification($book));
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        $request->session()->forget('booking');
        $request->session()->forget('isRoom');

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
        $booking = Booking::withTrashed()->findOrFail($id);
        return view('admin.pages.bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $booking = Booking::withTrashed()->findOrFail($id);
        $countries = CountryListFacade::getList('en');
        $roomType = $booking->type;
        $selectedRoomIds = $booking->rooms->pluck('id')->toArray();


        if ($roomType == 'lodge') {
            $rooms = Rooms::where('room_type', $roomType)->get();
        } else {
            $rooms = Rooms::where('room_type', '!=', 'lodge')->get();
        }

        return view('admin.pages.bookings.edit', compact('booking', 'countries', 'rooms', 'selectedRoomIds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $booking = Booking::withTrashed()->findOrFail($id);
        // Update the booking
        $validated = $request->validate([
            'checkin_date' => ['required', 'date_format:d-m-Y'],
            'checkout_date' => ['required', 'date_format:d-m-Y'],
            'arrival_time' => ['required'],
            'no_of_adults' => ['required', 'integer', 'min:1'],
            'no_of_children' => ['required', 'integer'],
            'user_title' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'address_line_one' => ['required', 'string', 'max:255'],
            'address_line_two' => ['nullable', 'string', 'max:255'],
            'postcode' => ['required', 'string', 'max:100'],
            'city' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'phone_number' => ['required'],
            'email_address' => ['required', 'email']
        ]);
        $checkinDate = Carbon::createFromFormat('d-m-Y', $validated['checkin_date'])->format('Y-m-d');
        $checkoutDate = Carbon::createFromFormat('d-m-Y', $validated['checkout_date'])->format('Y-m-d');
        $validated['checkin_date'] = $checkinDate;
        $validated['checkout_date'] = $checkoutDate;

        // Update
        $booking->update($validated);

        // Update the rooms
        $booking->rooms()->sync($request->selected_rooms);

        return redirect()->route('admin.bookings.index')->with('success', 'Booking has been updated successfully');
    }

    public function csvUpload()
    {
        return view('admin.pages.bookings.uploads');
    }
    public function csvStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'csv_file' => ['required', 'mimes:csv,txt'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->all());
        }

        //Store the upload files
        $file = $request->file('csv_file');
        $file_path = $file->store('temp');

        //Read the data from file
        $data = [];
        if (($handle = fopen(storage_path('app/' . $file_path), 'r')) !== false) {
            $header = fgetcsv($handle, 1000, ',');
            while (($row = fgetcsv($handle, 1000, ",")) !== false) {
                if (count($header) == count($row)) {
                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }
        $roomMapping = [
            'Aberlour' => 4,
            'Glenlivet' => 1,
            'MACALLAN' => 2,
            'GLENFARCLAS' => 5,
            'GLENFIDDICH' => 3,
            'ALLFIVE ROOMS ' => 1, 2, 3, 4, 5,
        ];
        //Add into the DB
        foreach ($data as $row) {
            if (isset($roomMapping[$row['room_booked']])) {
                $roomId = $roomMapping[$row['room_booked']];
            } else {
                $roomId = 10;
            }
            $booking = [
                'checkin_date' => Carbon::createFromFormat('d/m/Y', $row['checkin_date'])->format('Y-m-d'),
                'arrival_time' => $row['arrival_time'],
                'checkout_date' => Carbon::createFromFormat('d/m/Y', $row['checkout_date'])->format('Y-m-d'),
                'no_of_adults' => $row['no_of_adults'],
                'no_of_children' => $row['no_of_children'],
                'user_title' => $row['title'],
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name'],
                'address_line_one' => $row['address_line_one'],
                'address_line_two' => $row['address_line_two'],
                'city' => $row['city'],
                'postcode' => $row['postcode'],
                'country' => $row['country'],
                'phone_number' => $row['phone_number'],
                'email_address' => $row['email_address'],
                'room_id' => $roomId,
                'additional_information' => $row['additional_information'],
            ];
            DB::table('bookings')->insert($booking);
        }
        return redirect()->back()->with('success', 'Bookings have been imported successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
        return redirect()->back()->with('success', 'Booking has been deleted successfully');
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

    public function printTodayBooking(Request $request)
    {
        $today = Carbon::today()->startOfDay();
        $todaysBookings = Booking::where('checkin_date', '>=', $today)
            ->where('checkin_date', '<', $today->copy()->addDay())
            ->whereIn('status', ['confirmed', 'pending', 'paid'])
            ->orderBy('checkin_date', 'ASC')
            ->get();

        $pdf = PDF::loadView('admin.pages.bookings.todayPdf', compact('todaysBookings'));
        return $pdf->stream('today-room-bookings.pdf');
    }

    public function printThisWeeksBookings(Request $request)
    {
        $today = Carbon::today()->startOfDay();
        $startOfWeek = $today->copy()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = $today->copy()->endOfWeek(Carbon::SUNDAY);
        $thisWeeksBookings = Booking::where('checkin_date', '>=', $today)
            ->where('checkin_date', '<=', $endOfWeek)
            ->whereIn('status',  ['confirmed', 'pending', 'paid'])
            ->orderBy('checkin_date', 'ASC')
            ->get();

        $pdf = PDF::loadView('admin.pages.bookings.thisWeekPdf', compact('today', 'startOfWeek', 'endOfWeek', 'thisWeeksBookings'));
        return $pdf->stream('this-week-room-bookings.pdf');
    }

    public function printNextWeeksBookings(Request $request)
    {
        $today = Carbon::today()->startOfDay();
        $startOfWeek = $today->copy()->startOfWeek(Carbon::MONDAY);
        $startOfNextWeek = $startOfWeek->copy()->addWeek(1);
        $endOfNextWeek = $startOfNextWeek->copy()->endOfWeek(Carbon::SUNDAY);

        $nextWeeksBookings = Booking::where('checkin_date', '>=', $startOfNextWeek)
            ->where('checkin_date', '<=', $endOfNextWeek)
            ->where('status', '!=', BookingStatus::DRAFT)
            ->where('status', '!=', BookingStatus::CANCELLED)
            ->orderBy('checkin_date', 'asc')
            ->get();

        $pdf = PDF::loadView('admin.pages.bookings.nextWeeksBookingsPdf', compact('startOfNextWeek', 'endOfNextWeek', 'nextWeeksBookings'));
        return $pdf->stream('next-weeks-room-bookings.pdf');
    }

    public function markAsPaid(Request $request, string $id)
    {
        $booking = Booking::findOrFail($id);


        if (!$booking->isPaid())
            $booking->createTransaction($booking->getRemainingAmount(), TransactionType::FULL->value, 'manual', null, null, 'FULL-' . $booking->booking_ref);

        $booking->updateStatus(BookingStatus::PAID);

        return redirect()->back()->with('success', 'Booking marked as paid');
    }

    public function markAsDepositPaid(Request $request, string $id)
    {
        $booking = Booking::findOrFail($id);

        $booking->createTransaction($booking->deposit, TransactionType::DEPOSIT->value, 'manual');

        $booking->updateStatus(BookingStatus::CONFIRMED);

        return redirect()->back()->with('success', 'Booking marked as deposit paid');
    }

    public function updateStatus(Request $request, int $id, string $status)
    {

        // Only allow BookingStatus enum values
        if (!in_array($status, ['confirmed', 'pending', 'paid', 'cancelled'])) {
            return redirect()->back()->with('error', 'Invalid booking status');
        }
        $booking = Booking::findOrFail($id);

        $booking->updateStatus($request->status);

        return redirect()->back()->with('success', 'Booking status updated successfully');
    }

    public function combineNames()
    {
        $users = Booking::all();

        foreach ($users as $user) {
            $user->full_name = $user->first_name . ' ' . $user->last_name;
            $user->save();
        }

        return redirect('admin/bookings')->with('success', 'Names combined successfully');
    }
}
