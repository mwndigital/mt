<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\AdminTableBookingConfirmationEmail;
use App\Mail\TableBookingConfirmationEmail;
use App\Models\RestaurantBooking;
use App\Models\RestaurantTable;
use App\Models\User;
use App\Models\UserDetails;
use App\Notifications\NewTableBookingNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use MailchimpMarketing\ApiClient;
use MailchimpMarketing\ApiException;
use Spatie\Permission\Models\Role;

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

        //dd($table_booking);

        return to_route('book-a-table-step-two-show');
    }

    public function stepTwoShow(Request $request) {
        $table_booking = $request->session()->get('table_booking');

        // Calculate the reservation end time by adding 2 hours to the reservation time
        $reservationStartTime = $table_booking->reservation_time;
        $reservationEndTime = strtotime($reservationStartTime) + 7200; // 7200 seconds = 2 hours

        // Get the reservations matching the reservation date and time
        $reservations = RestaurantBooking::where('reservation_date', $table_booking->reservation_date)
            ->get();

        $reservedTableIds = [];
        $normalTablesBooked = 0;
        $sixSeatTablesBooked = 0;

        // Iterate through reservations to extract table IDs and count 6-seat table reservations
        foreach ($reservations as $reservation) {
            $startTime = strtotime($reservation->reservation_time);
            $endTime = strtotime($reservation->reservation_end_time);

            // Check if the reservation overlaps with the desired time
            if (($startTime <= $reservationEndTime && $startTime >= $reservationStartTime) ||
                ($endTime <= $reservationEndTime && $endTime >= $reservationStartTime)) {
                $tableIds = json_decode($reservation->table_ids);
                if (is_array($tableIds)) {
                    $reservedTableIds = array_merge($reservedTableIds, $tableIds);

                    if (in_array(6, $tableIds)) {
                        $sixSeatTablesBooked += 1;
                    } else {
                        $normalTablesBooked += count($tableIds);
                    }
                }
            }
        }

        // Filter the unique table IDs
        $reservedTableIds = array_unique($reservedTableIds);

        // Define your limits for normal and 6-seat tables
        $normalTableLimit = 8; // Set your desired limit for normal tables
        $sixSeatTableLimit = 2; // Set your desired limit for 6-seat tables

        // Get all available tables that match the number of guests and are not fully booked
        $availableTables = RestaurantTable::where('no_of_seats', $table_booking->no_of_guests)
            ->whereNotIn('id', $reservedTableIds)
            ->get();

        // Check if the selected table is available during the requested time
        if (in_array($table_booking->table_id, $reservedTableIds)) {
            return redirect()->back()->with('error', 'This table is already booked for the selected time. Please choose another table or time.');
        }

        // Check if the limit for normal tables, 6-seat tables, or both is reached and display the appropriate error message
        if ($normalTablesBooked >= $normalTableLimit && $sixSeatTablesBooked >= $sixSeatTableLimit) {
            return redirect()->back()->with('error', 'We are fully booked on this date, please choose another date.');
        } elseif ($normalTablesBooked >= $normalTableLimit) {
            return redirect()->back()->with('error', 'Unfortunately we do not have tables available for your party size on this date, please choose another date.');
        } elseif ($sixSeatTablesBooked >= $sixSeatTableLimit) {
            return redirect()->back()->with('error', 'Unfortunately we do not have 6-seat tables available for your party size on this date, please choose another table or time.');
        }

        return view('frontend.pages.restaurant-bookings.step-2', compact('table_booking', 'availableTables'));
    }

    /*public function stepTwoShow(Request $request) {
        $table_booking = $request->session()->get('table_booking');

        // Get the reservations matching the reservation date
        $reservations = RestaurantBooking::orderBy('reservation_date')
            ->where('reservation_date', $table_booking->reservation_date)
            ->get();

        $reservedTableIds = [];

        // Iterate through reservations to extract table IDs
        foreach ($reservations as $reservation) {
            $tableIds = json_decode($reservation->table_ids);
            if (is_array($tableIds)) {
                $reservedTableIds = array_merge($reservedTableIds, $tableIds);
            }
        }

        // Filter the unique table IDs
        $reservedTableIds = array_unique($reservedTableIds);

        // Get available tables that match the number of guests
        $tables = RestaurantTable::where('no_of_seats', $table_booking->no_of_guests)
            ->whereNotIn('id', $reservedTableIds)
            ->get();

        if($tables == NULL) {
            return redirect()->back()->with('error', 'We are fully booked on this date, please choose another.');
        }

        return view('frontend.pages.restaurant-bookings.step-2', compact('table_booking', 'tables'));
    }*/
    public function stepTwoStore(Request $request) {
        $signMeUp = $request->has('newsletter_signup');
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'mobile_number' => ['nullable', 'max:15'],
            'table_id' => ['required' ],
            'create_account' => ['nullable', 'string'],
            'password' => ['required_if:create_account,yes'],
            'dietary_information' => ['nullable', 'max: 2000', 'string'],
        ]);
        $table_booking = $request->session()->get('table_booking');
        $table_booking->fill($validated);

        //Get the reservation time and set the reservation end time
        $reservation_time = Carbon::parse($table_booking->reservation_time);
        $reservation_time_end = $reservation_time->copy()->addHours(2);

        //If create account is yes create user and store data for res
        if($request->create_account == 'yes') {
            $user = User::create([
                'first_name' => $request->validated('first_name'),
                'last_name' => $request->validated('last_name'),
                'email' => $request->validated('email'),
                'password' => Hash::make($request->validated('password')),
            ]);
            $user->assignRole('customer');
            $userDetails = UserDetails::create([
                'dietary_information' => $request->validated('dietary_information'),
                'user_id' => $user->id
            ]);

            $table_booking = RestaurantBooking::create([
                'first_name' => $table_booking->first_name,
                'last_name' => $table_booking->last_name,
                'user_id' => $user->id,
                'email' => $table_booking->email,
                'mobile_number' => $table_booking->mobile_number,
                'reservation_date' => $table_booking->reservation_date,
                'reservation_time' => $table_booking->reservation_time,
                'reservation_end_time' => $reservation_time_end,
                'no_of_guests' => $table_booking->no_of_guests,
                'table_id' => $table_booking->table_id,
                'table_ids' => $table_booking->table_id,
                'joining_for' => $table_booking->joining_for,
                'additional_information' => $table_booking->additional_information,
                'dietary_info' => $table_booking->dietary_info,
            ]);

            //Forget session
            $request->session()->forget('table_booking');

            //Send confirmation email to customer
            Mail::to($validated['email'])->send(new TableBookingConfirmationEmail($table_booking));

            //send confirmation email to MT
            Mail::to('reservations@mashtun-aberlour.com')->send(new AdminTableBookingConfirmationEmail($table_booking));

            //Send notif
            $adminRoles = ['admin', 'super admin'];
            $adminUsers = Role::whereIn('name', $adminRoles)->first()->users;
            foreach($adminUsers as $adminUser) {
                $adminUser->notify(new NewTableBookingNotification($table_booking));
            }

            //Redirect to thank you
            return redirect()->route('book-a-table-thank-you', ['table_booking_id' => $table_booking->id]);
        }
        elseif($signMeUp) {
            //Save the session
            $table_booking = RestaurantBooking::create([
                'first_name' => $table_booking->first_name,
                'last_name' => $table_booking->last_name,
                'email' => $table_booking->email,
                'reservation_date' => $table_booking->reservation_date,
                'reservation_time' => $table_booking->reservation_time,
                'reservation_end_time' => $reservation_time_end,
                'no_of_guests' => $table_booking->no_of_guests,
                'table_id' => $table_booking->table_id,
                'joining_for' => $table_booking->joining_for,
                'additional_information' => $table_booking->additional_information,
                'dietary_info' => $table_booking->dietary_info,
            ]);

            //forget session
            $request->session()->forget('table_booking');

            //Mailchimp
            $email = $table_booking->email;
            $first_name = $table_booking->first_name;
            $last_name = $table_booking->last_name;
            $listId = env('MAILCHIMP_LIST_ID');

            $client = new ApiClient();
            $client->setConfig([
                'apiKey' => env("MAILCHIMP_API_KEY"),
                'server' => 'us14'
            ]);

            try {
                // Check if the email is already a member of the list
                //$existingMember = $client->lists->getListMember($listId, md5(strtolower($email)));

                // If the email already exists, you can display a warning message
                /*if ($existingMember) {
                    return redirect()->back()->with('warning', 'This email is already subscribed to our mailing list.');
                }*/

                $member = $client->lists->addListMember($listId, [
                    'email_address' => $email,
                    'status' => 'subscribed',
                ]);

                //Send email to customer
                Mail::to($validated['email'])->send(new TableBookingConfirmationEmail($table_booking));

                //Send email to MT
                Mail::to('reservations@mashtun-aberlour.com')->send(new AdminTableBookingConfirmationEmail($table_booking));

                //Send notif
                $adminRoles = ['admin', 'super admin'];
                $adminUsers = Role::whereIn('name', $adminRoles)->first()->users;
                foreach($adminUsers as $adminUser){
                    $adminUser->notify(new NewTableBookingNotification($table_booking));
                }

                //redirect to thank you
                return redirect()->route('book-a-table-thank-you', ['table_booking_id' => $table_booking->id])->with('success', "You're booking has been sent and you are now subscribed to our mailing list");
            } catch (ApiException $e) {
                // Handle the MailChimp API exception, log it, or provide user feedback.
                return redirect()->back()->with('error', 'Unable to subscribe. Please try again later.');
            }

        }
        else {
            //Save the session
            $table_booking = RestaurantBooking::create([
                'first_name' => $table_booking->first_name,
                'last_name' => $table_booking->last_name,
                'email' => $table_booking->email,
                'reservation_date' => $table_booking->reservation_date,
                'reservation_time' => $table_booking->reservation_time,
                'reservation_end_time' => $reservation_time_end,
                'no_of_guests' => $table_booking->no_of_guests,
                'table_id' => $table_booking->table_id,
                'joining_for' => $table_booking->joining_for,
                'additional_information' => $table_booking->additional_information,
                'dietary_info' => $table_booking->dietary_info,
            ]);

            //forget session
            $request->session()->forget('table_booking');

            //Send email to customer
            Mail::to($validated['email'])->send(new TableBookingConfirmationEmail($table_booking));

            //Send email to MT
            Mail::to('reservations@mashtun-aberlour.com')->send(new AdminTableBookingConfirmationEmail($table_booking));

            //Send notif
            $adminRoles = ['admin', 'super admin'];
            $adminUsers = Role::whereIn('name', $adminRoles)->first()->users;
            foreach($adminUsers as $adminUser){
                $adminUser->notify(new NewTableBookingNotification($table_booking));
            }

            //redirect to thank you
            return redirect()->route('book-a-table-thank-you', ['table_booking_id' => $table_booking->id]);
        }
    }
    public function thankYou() {
        return view('frontend.pages.restaurant-bookings.thank-you');
    }


}
