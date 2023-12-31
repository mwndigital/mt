<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AdminTableBookingCancellationEmail;
use App\Mail\CustomerTableBookingCancellationEmail;
use App\Models\RestaurantBooking;
use App\Models\RestaurantTable;
use App\Notifications\AdminTableBookingCancelledNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use PDF;

class AdminRestaurantBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = Carbon::today()->startOfDay();
        $latestBookings = RestaurantBooking::orderBy('reservation_date', 'asc')
            ->where('reservation_date', '>=', $today)
            ->get();
        return view('admin.pages.restaurant.index', compact('latestBookings'));
    }

    public function todaysBookingsIndex(){
        $today = Carbon::today()->startOfDay();
        $startOfWeek = $today->copy()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = $today->copy()->endOfWeek(Carbon::SUNDAY);

        $todaysBookings = RestaurantBooking::where('reservation_date', '>=', $today)
            ->where('reservation_date', '<', $today->copy()->addDay())
            ->where('status', '=', 'confirmed')
            ->orderBy('reservation_time', 'asc')
            ->get();



        return view('admin.pages.restaurant.todayBookings', compact('todaysBookings',));
    }

    public function thisWeeksBookingsIndex() {
        $today = Carbon::today()->startOfDay();
        $startOfWeek = $today->copy()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = $today->copy()->endOfWeek(Carbon::SUNDAY);

        $thisWeeksBookings = RestaurantBooking::where('reservation_date', '>=', $today)
            ->where('reservation_date', '<=', $endOfWeek)
            ->where('status', '=', 'confirmed')
            ->orderBy('reservation_date', 'asc')
            ->get();
        return view('admin.pages.restaurant.thisWeekBookingsIndex', compact('thisWeeksBookings'));
    }

    public function allBookingsIndex() {
        $today = Carbon::today()->startOfDay();
        $allBookings = RestaurantBooking::orderBy('reservation_date', 'asc')
            ->where('reservation_date', '>=', $today)
            ->where('status', '!=', 'cancelled')
            ->get();

        return view('admin.pages.restaurant.allBookingsIndex', compact('allBookings'));
    }

    public function nextWeeksBookingsIndex(){
        $today = Carbon::today()->startOfDay();
        $startOfWeek = $today->copy()->startOfWeek(Carbon::MONDAY);
        $startOfNextWeek = $startOfWeek->copy()->addWeek(1);
        $endOfNextWeek = $startOfNextWeek->copy()->endOfWeek(Carbon::SUNDAY);

        $nextWeeksBookings = RestaurantBooking::where('reservation_date', '>=', $startOfNextWeek)
            ->where('reservation_date', '<=', $endOfNextWeek)
            ->where('status', '!=', 'cancelled')
            ->orderBy('reservation_date', 'asc')
            ->get();

        return view('admin.pages.restaurant.next-weeks-bookings', compact('startOfNextWeek','endOfNextWeek', 'nextWeeksBookings'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tables = RestaurantTable::all();

        $today = Carbon::today()->startOfDay();
        $startOfWeek = $today->copy()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = $today->copy()->endOfWeek(Carbon::SUNDAY);

        $min_date = Carbon::now()->addDay(1);
        $max_date = Carbon::now()->addMonth(6);
        $today = Carbon::now()->format('l');



        return view('admin.pages.restaurant.create', compact('tables', 'today', 'min_date', 'max_date', 'today'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'mobile_number' => ['nullable', 'max:15'],
            'joining_for' => ['required', 'string', 'max:255'],
            'reservation_date' => ['required', 'date'],
            'reservation_time' => ['required'],
            'no_of_guests' => ['required', 'integer'],
            'dietary_information' => ['nullable', 'max:15000'],
            'additional_information' => ['nullable', 'max: 15000'],
            'table_id' => ['nullable', 'integer']
        ]);
        $reservation_time = Carbon::parse($validated['reservation_time']);
        $reservation_time_end = $reservation_time->copy()->addHours(2);

        $tableIds = $request->input('table_ids', []);

        RestaurantBooking::create([
           'first_name' => $validated['first_name'],
           'last_name' => $validated['last_name'],
            'full_name' => $validated['first_name'] . ' ' . $validated['last_name'],
           'email' => $validated['email'],
           'mobile_number' => $validated['mobile_number'],
           'joining_for' => $validated['joining_for'],
           'reservation_date' => $validated['reservation_date'],
           'reservation_time' => $validated['reservation_time'],
            'reservation_end_time' => $reservation_time_end,
            'no_of_guests' => $validated['no_of_guests'],
            'dietary_info' => $validated['dietary_information'],
            'additional_information' => $validated['additional_information'],
            'table_id' => 1,
            'table_ids' => json_encode($tableIds),
        ]);

        return redirect('admin/restaurant-bookings')->with('success', 'New booking created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking = RestaurantBooking::findOrFail($id);
        $tableIds = json_decode($booking->table_ids);

        return view('admin.pages.restaurant.show', compact('booking', 'tableIds'));
    }

    public function csvUpload(){
        return view('admin.pages.restaurant.uploads');
    }

    public function csvStore(Request $request){
        $validator = Validator::make($request->all(), [
            'csv_file' => ['required', 'mimes:csv,txt'],
        ]);
        if($validator->fails()){
            return redirect()->back()->with('error', $validator->errors()->all());
        }

        //store the uploaded files
        $file = $request->file('csv_file');
        $file_path = $file->store('temp');

        //Read the data from file
        $data = [];
        if(($handle = fopen(storage_path('app/' . $file_path), 'r')) !== false) {
            $header = fgetcsv($handle, 1000, ",");
            while(($row = fgetcsv($handle, 1000, ",")) !== false){
                if (count($header) == count($row)) {
                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }
        //Add into the DB
        foreach($data as $row) {
            $reservationStartTime = Carbon::createFromFormat('H:i', $row['reservation_time']);

            // Calculate reservation end time by adding 2 hours
            $reservationEndTime = $reservationStartTime->copy()->addHours(2);

            $tableNo = rand(1, 10);

            $restaurantBooking = [
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name'],
                'email' => $row['email_address'],
                'reservation_date' => Carbon::createFromFormat('d/m/Y', $row['reservation_date'])
                    ->format('Y-m-d'),
                'reservation_time' => $row['reservation_time'],
                'reservation_end_time' => $reservationEndTime,
                'no_of_guests' => $row['no_of_guests'],
                'table_id' => $tableNo,
                'joining_for' => $row['joining_for'],
                'additional_information' => $row['additional_information'],
                'dietary_info' => $row['dietary_information']
            ];
            DB::table('restaurant_bookings')->insert($restaurantBooking);


        }
        return redirect()->back()->with('success', 'Bookings have been imported successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $booking = RestaurantBooking::findOrFail($id);
        $tables = RestaurantTable::all();
        $tableIds = json_decode($booking->table_ids);

        //dd($tableIds);

        return view('admin.pages.restaurant.edit', compact('booking', 'tables', 'tableIds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $booking = RestaurantBooking::findOrFail($id);

        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email'],
            'mobile_number' => ['nullable', 'max:25'],
            'joining_for' => ['required', 'string', 'max:255'],
            'reservation_date' => ['required', 'date'],
            'reservation_time' => ['required'],
            'no_of_guests' => ['required', 'integer'],
            'dietary_information' => ['nullable', 'max:15000'],
            'additional_information' => ['nullable', 'max: 15000'],
            'table_id' => ['nullable', 'integer']
        ]);
        $reservation_time = Carbon::parse($validated['reservation_time']);
        $reservation_time_end = $reservation_time->copy()->addHours(2);

        $tableIds = $request->input('table_ids', []);

        $booking->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'full_name' => $validated['first_name'] . ' ' . $validated['last_name'],
            'email' => $validated['email'],
            'mobile_number' => $validated['mobile_number'],
            'joining_for' => $validated['joining_for'],
            'reservation_date' => $validated['reservation_date'],
            'reservation_time' => $validated['reservation_time'],
            'reservation_end_time' => $reservation_time_end,
            'no_of_guests' => $validated['no_of_guests'],
            'dietary_info' => $validated['dietary_information'],
            'additional_information' => $validated['additional_information'],

        ]);

        if (count($tableIds) === 1) {
            // If only one table is selected, set 'table_id' to that value.
            $booking->update(['table_id' => $tableIds[0]]);
        } else {
            // If multiple tables are selected, encode the array of table IDs.
            $booking->update(['table_ids' => json_encode($tableIds)]);
        }

        return redirect()->back()->with('success', 'Booking successfully updated');
    }

    public function cancelBooking($id) {
        $booking = RestaurantBooking::findOrFail($id);

        $booking->update(['status' => 'cancelled']);

        //Send email to Customer
        Mail::to($booking->email)->send(new CustomerTableBookingCancellationEmail($booking));

        //Send email to MT
        Mail::to('reservations@mashtun-aberloud.com')->send(new AdminTableBookingCancellationEmail($booking));

        //Send Admin Notif
        $adminRoles = ['admin', 'super admin'];
        $adminUsers = Role::whereIn('name', $adminRoles)->first()->users;
        foreach($adminUsers as $adminUser) {
            $adminUser->notify(new AdminTableBookingCancelledNotification($booking));
        }

        return redirect()->back()->with('success', 'Booking has been cancelled successfully');
    }

    public function printTodayBookings(Request $request) {
        $today = Carbon::today()->startOfDay();
        $todaysBookings = RestaurantBooking::where('reservation_date', '>=', $today)
            ->where('reservation_date', '<', $today->copy()->addDay())
            ->where('status', '=', 'confirmed')
            ->orderBy('reservation_time', 'asc')
            ->get();

        $pdf = PDF::loadView('admin.pages.restaurant.todayPdf', compact('todaysBookings'));
        return $pdf->stream('today-restaurant-bookings.pdf');
    }

    public function printThisWeeksBookings(Request $request) {
        $today = Carbon::today()->startOfDay();
        $startOfWeek = $today->copy()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = $today->copy()->endOfWeek(Carbon::SUNDAY);
        $thisWeeksBookings = RestaurantBooking::where('reservation_date', '>=', $today)
            ->where('reservation_date', '<=', $endOfWeek)
            ->where('status', '=', 'confirmed')
            ->orderBy('reservation_date', 'ASC')
            ->get();

        $pdf = PDF::loadView('admin.pages.restaurant.thisWeekPdf', compact('thisWeeksBookings', 'today', 'endOfWeek', 'startOfWeek'));
        return $pdf->stream('this-week-restaurant-bookings.pdf');
    }

    public function printNextWeeksBookings(Request $request) {
        $today = Carbon::today()->startOfDay();
        $startOfWeek = $today->copy()->startOfWeek(Carbon::MONDAY);
        $startOfNextWeek = $startOfWeek->copy()->addWeek(1);
        $endOfNextWeek = $startOfNextWeek->copy()->endOfWeek(Carbon::SUNDAY);

        $nextWeeksBookings = RestaurantBooking::where('reservation_date', '>=', $startOfNextWeek)
            ->where('reservation_date', '<=', $endOfNextWeek)
            ->where('status', '', 'confirmed')
            ->orderBy('reservation_date', 'asc')
            ->get();

        $pdf = PDF::loadView('admin.pages.restaurant.nextWeeksBookingsPdf', compact('nextWeeksBookings', 'startOfNextWeek', 'endOfNextWeek'));
        return $pdf->stream('next-week-restaurant-bookings.pdf');
    }

    public function printAllBookings(Request $request) {
        $today = Carbon::today()->startOfDay();
        $allBookings = RestaurantBooking::where('reservation_date', '>=', $today)
            ->where('status', '=', 'confirmed')
            ->orderBy('reservation_date', 'ASC')
            ->get();

        $pdf = PDF::loadView('admin.pages.restaurant.allPdf', compact('today', 'allBookings'));
        return $pdf->stream('all-restaurant-bookings.pdf');
    }

    public function combineNames(){
        $users = RestaurantBooking::all();

        foreach($users as $user) {
            $user->full_name = $user->first_name . ' ' . $user->last_name;
            $user->save();
        }
        return redirect('admin/restaurant-bookings')->with('success', 'Names combined successfully');
    }

    public function destroy($id)
    {
        $booking = RestaurantBooking::findOrFail($id);
        $booking->delete();
        return redirect()->back()->with('success', 'Booking deleted successfully');
    }
}
