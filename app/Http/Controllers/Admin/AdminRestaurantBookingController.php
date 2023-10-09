<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RestaurantBooking;
use App\Models\RestaurantTable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminRestaurantBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = Carbon::today()->startOfDay();
        $startOfWeek = $today->copy()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = $today->copy()->endOfWeek(Carbon::SUNDAY);

        $allBookings = RestaurantBooking::where('reservation_date', '>=', $today)
            ->orderBy('reservation_date', 'asc')
            ->get();
        $todaysBookings = RestaurantBooking::where('reservation_date', '>=', $today)
            ->where('reservation_date', '<', $today->copy()->addDay())
            ->orderBy('reservation_time', 'asc')
            ->get();
        $thisWeeksBookings = RestaurantBooking::where('reservation_date', '>=', $today)
            ->where('reservation_date', '<=', $endOfWeek)
            ->orderBy('reservation_date', 'asc')
            ->get();


        return view('admin.pages.restaurant.index', compact('todaysBookings', 'thisWeeksBookings', 'allBookings'));
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
           'email' => $validated['email'],
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
        //
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
        return view('admin.pages.restaurant.edit', compact('booking', 'tables'));
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
