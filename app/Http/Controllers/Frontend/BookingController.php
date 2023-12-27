<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\BookingConfirmationMail;
use App\Mail\AdminBookingConfirmationMail;
use App\Models\Booking;
use App\Models\Rooms;
use App\Notifications\AdminNewRoomBookingNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use MailchimpMarketing\ApiClient;
use MailchimpMarketing\ApiException;
use Monarobase\CountryList\CountryList;
use Monarobase\CountryList\CountryListFacade;
use Omnipay\Common\CreditCard;
use Cache;
use Illuminate\Support\Str;
use App\Enums\BookingStatus;
use App\Enums\TransactionType;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\UserDetails;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->session()->put('isRoom', $request->type != 'lodge');
        $booking = $request->session()->get('booking');
        $request->session()->put('booking', $booking);

        $isRoom = $request->session()->get('isRoom');

        return view('frontend.pages.booking.index', compact('booking', 'isRoom'));
    }

    public function stepOneStore(Request $request)
    {
        $isRoom = $request->type != 'lodge';
        $request->session()->put('isRoom', $isRoom);

        $validated = $request->validate([
            'checkin_date' => ['required', 'date_format:d-m-Y'],
            'checkout_date' => ['required', 'date_format:d-m-Y'],
            'arrival_time' => ['required'],
            'no_of_adults' => ['required', 'integer', 'min:1'],
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

        $booking->duration_of_stay = $duration;
        // If duration only 1 night and if is not room then redirect back
        if (!$isRoom && $duration == 1) {
            return redirect()->back()
                ->with('error', 'Minimum stay for lodge is 2 nights.');
        }
        if (!$duration) {
            return redirect()->back()
                ->with('error', 'Check-in date and check-out date cannot be the same.');
        }
        $validated['checkin_date'] = $checkinDate;
        $validated['checkout_date'] = $checkoutDate;
        $validated['booking_ref'] = 'mt-' . strtoupper(Str::random(8));
        $booking->fill($validated);
        $request->session()->put('booking', $booking);
        $request->session()->put('type', $isRoom);
        return to_route('book-a-room-step-2');
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
            return redirect()->back()
                ->with('error', 'No rooms/lodge available for the selected dates.');
        }

        return view('frontend.pages.booking.step-2', compact('booking', 'filteredRooms', 'isRoom'));
    }

    public function stepTwoStore(Request $request)
    {
        $validated = $request->validate([
            'room_id' => ['required', 'array'],
        ]);
        $roomIds = $validated['room_id'];

        $booking = $request->session()->get('booking');
        // roomIds should be related $booking->rooms() in the session
        $rooms = Rooms::whereIn('id', $roomIds)->get();
        $booking->rooms = $rooms;

        $request->session()->put('booking', $booking);
        // Convert date strings to Y-m-d format using Carbon
        $checkInDate = $booking->checkin_date;
        $checkOutDate = $booking->checkout_date;

        // Check if any booking conflicts exist for the selected room and dates
        $filteredRooms = $rooms->filter(function ($room) use ($checkInDate, $checkOutDate) {
            return $room->checkAvailability($checkInDate, $checkOutDate);
        });

        if ($filteredRooms->isEmpty()) {
            return redirect()->route('book-a-room-step-2')->with('room_conflict', true);
        }

        return redirect()->route('book-a-room-step-3');
    }

    public function stepThreeShow(Request $request)
    {
        $booking = $request->session()->get('booking');
        $isRoom = $request->session()->get('isRoom');
        $countries = CountryListFacade::getList('en');
        $create_account = $request->session()->get('create_account');
        $current_option = $create_account == 'yes' ?? 'no';
        // Get current user details
        $user = auth()->user();
        $userDetails = $user ? $user->userDetails : null;
        if ($user) {
            // User
            $booking->first_name = $booking->first_name ?? $user->first_name;
            $booking->last_name = $booking->last_name ?? $user->last_name;
            $booking->email_address = $booking->email_address ?? $user->email;
            // User details
            if ($userDetails) {
                $booking->phone_number = $booking->phone_number ?? $userDetails->phone_number;
                $booking->address_line_one = $booking->address_line_one ?? $userDetails->address_line_one;
                $booking->address_line_two = $booking->address_line_two ?? $userDetails->address_line_two;
                $booking->city = $booking->city ?? $userDetails->town_city;
                $booking->postcode = $booking->postcode ?? $userDetails->postcode;
                $booking->country = $booking->country ?? $userDetails->country;
            }
        }
        $booking->user_id = $user ? $user->id : null;

        return view('frontend.pages.booking.step-3', compact('booking', 'countries', 'current_option', 'isRoom'));
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
            'email_address' => ['required', 'email'],
            'create_account' => ['nullable', 'string'],
            'password' => ['required_if:create_account,yes'],
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
        $request->session()->put('create_account', $request->create_account);

        // If the user has chosen to create an account, create a new user
        if ($request->create_account == 'yes' && empty($booking->user_id)) {
            // if user email is exists in the database, then use that user id
            $user = User::where('email', $validated['email_address'])->first();

            if ($user) {
                $message = 'Email address already exists. <br/>Please login to your account or use a different email address. <a href="' . route('login', ['redirect' => '/book-a-room/step-3']) . '">Login</a>';
                return back()->withErrors(['email_address' => $message])->withInput();
            }

            $user = User::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email_address'],
                'password' => Hash::make($validated['password']),
            ]);
            $user->assignRole('customer');
            $userDetails = UserDetails::create([
                'user_id' => $user->id,
                'phone_number' => $validated['phone_number'],
                'address_line_one' => $validated['address_line_one'],
                'address_line_two' => $validated['address_line_two'],
                'town_city' => $validated['city'],
                'postcode' => $validated['postcode'],
                'country' => $validated['country'],
            ]);
            $booking->user_id = $user->id;
        }

        $booking->fill($validated);
        $request->session()->put('booking', $booking);

        return to_route('book-a-room-step-4');
    }
    public function stepFourShow(Request $request)
    {
        $booking = $request->session()->get('booking');

        $roomName = $booking['room_name'];

        return view('frontend.pages.booking.step-4', compact('booking', 'roomName'));
    }

    public function stepFourStore(Request $request)
    {
        $validated = $request->validate([
            'cancellationPolicyAgree' => ['required'],
            'newsletter_signup' => ['nullable']
        ]);

        $booking = $request->session()->get('booking');
        $booking->fill($validated);
        $request->session()->put('booking', $booking);

        return to_route('process-payment');
    }


    protected function getSagePayGateway()
    {
        $gateway =  \Omnipay::gateway('opayo');
        $gateway->setBillingForShipping(true);
        return $gateway;
    }

    public function processPayment(Request $request)
    {
        $booking = $request->session()->get('booking');
        $gateway = $this->getSagePayGateway();
        $b = $booking->createDraftBooking($request->session()->get('isRoom'));
        $transactionId = $b->booking_ref;

        try {
            $response = $gateway->purchase([
                'amount' => '50.00',
                'currency' => 'GBP',
                'transactionID' => $transactionId,
                'VendorTxCode' => $transactionId,
                'description' => 'The Mash Tun room booking deposit',
                'clientIp' => $request->ip(),
                'card' => $this->getCardDetails($booking, $request),
                'notifyUrl' => route('sagepay-notify'),
            ])->send();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }

        if ($response->isSuccessful()) {
            // Only Direct integration can be completed here
        } elseif ($response->isRedirect()) {
            $this->saveCache($transactionId, $response);
            // Redirect
            $response->redirect();
        } else {
            //Failed
            return view('frontend.pages.booking.payment-failed', compact('booking'))->with('response', $response)->with('error', $response->getMessage());
        }
    }

    public function thankYou(Request $request)
    {
        $transactionId = $request->transactionId;

        $booking = Booking::where('booking_ref', $transactionId)->first();

        if ($booking->signMeUp) {
            //Mailchimp
            $email = $booking->email_address;
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
            } catch (ApiException $e) {
                // Handle the MailChimp API exception, log it, or provide user feedback.
                Log::error($e->getMessage);
                //return flash('error', 'Unable to subscribe. Please try again later.');
            }
        }

        // Send email to customer
        try {
            Mail::to($booking['email_address'])->send(new BookingConfirmationMail($booking));
            Mail::to('reservations@mashtun-aberlour.com')->send(new AdminBookingConfirmationMail($booking));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        // Notify admins
        try {
            $adminUsers = Role::whereIn('name', ['admin', 'super admin'])->first()->users;
            foreach ($adminUsers as $adminUser) {
                $adminUser->notify(new AdminNewRoomBookingNotification($booking));
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        $this->cleanCache($transactionId);

        return view('frontend.pages.booking.thank-you');
    }

    public function paymentFailed(Request $request)
    {
        $request->session()->forget('booking');
        return view('frontend.pages.booking.payment-failed')->with('error', $request->StatusDetail);
    }

    private function getCardDetails($booking, $request)
    {
        $email = $booking->email_address;
        // Just in case the email address is invalid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email = 'invalid-email@mash-tun.com';
        }
        $detail = new CreditCard([
            'firstName' => $request->name,
            'lastName' => '',
            'email' => $email,
            'BillingFirstName' => $booking->first_name,
            'BillingLastName' => $booking->last_name,
            'BillingAddress1' => $booking->address_line_one,
            'BillingCity' => $booking->city,
            'BillingPostCode' => substr(str_replace(' ', '', $booking->postcode), 0, 8),
            'BillingCountry' => $booking->country
        ]);

        if ($booking->country == 'US') {
            $detail->setBillingState('NY');
        }

        return $detail;
    }

    public function sagepayNotify(Request $request)
    {
        // Step 1: Look up the saved transaction in the database to retrieve the securityKey.
        $transactionId = $request->input('VendorTxCode');
        $statusDetail = $request->input('StatusDetail');
        $status = $request->input('Status');
        $securityKey = Cache::get($transactionId . 'transactionSecure');


        // Step 2: Validate the signature of the received notification to protect against tampering.
        $gateway = $this->getSagePayGateway();

        $notifyRequest = $gateway->acceptNotification();
        $notifyRequest->setSecurityKey($securityKey);

        if (!$notifyRequest->isValid() || $status != 'OK') {
            // Respond to Sage Pay indicating we are not accepting anything about this message.
            // You might want to log `$notifyRequest->getData()` first, for later analysis.
            $failedRoute = route('booking-payment-failed', ['StatusDetail' => $statusDetail, 'transactionId' => $transactionId]);
            $notifyRequest->invalid($failedRoute, 'Signature not valid - goodbye');
            return;
        }

        // Step 3: Update your saved transaction with the results.
        // Perform any necessary updates here

        // Step 4: Respond to Sage Pay to indicate that you accept the result, reject the result, or don't believe the notification was valid.
        // Also tell Sage Pay where to send the user next.

        // If you accept the notification, then you can update your local records and let Sage Pay know:

        // All raw data - just log it for later analysis:
        $data = $notifyRequest->getData();

        // Save the final transactionReference against the transaction in the database. It will
        // be needed if you want to capture the payment (for an authorize) or void or refund or
        // repeat the payment later.

        $finalTransactionReference = $notifyRequest->getTransactionReference();

        // The payment or authorization result:
        // Result is $notifyRequest::STATUS_COMPLETED, $notifyRequest::STATUS_PENDING
        // or $notifyRequest::STATUS_FAILED

        $transactionStatus = $notifyRequest->getTransactionStatus();

        // If you want more detail, look at the raw data. An error message may be found in:

        $errorMessage = $notifyRequest->getMessage();

        // The transaction may be the result of a `createCard()` request.
        // The cardReference can be found like this:

        if ($notifyRequest->getTxType() === $notifyRequest::TXTYPE_TOKEN) {
            $cardReference = $notifyRequest->getCardReference();
        }

        // Now let Sage Pay know you have accepted and saved the result:

        // Save booking status as pending
        $booking = Booking::where('booking_ref', $transactionId)->first();
        $booking->status = BookingStatus::PENDING;
        $booking->payment_method = 'sagepay';
        $booking->save();
        $booking->createTransaction($booking->deposit, TransactionType::DEPOSIT, json_encode($data), $finalTransactionReference);

        $notifyRequest->confirm(route('booking-thank-you', ['StatusDetail' => $statusDetail, 'transactionId' => $transactionId]));
    }

    private function cleanCache($transactionId)
    {
        Cache::forget($transactionId . 'transactionId');
        Cache::forget($transactionId . 'transactionReference');
        Cache::forget($transactionId . 'transactionSecure');

        // Remove session
        session()->forget('booking');
    }

    private function saveCache($transactionId, $response)
    {
        $minutes = 60 * 24;
        Cache::put($transactionId . 'transactionId', $transactionId, $minutes);
        Cache::put($transactionId . 'transactionReference', $response->getTransactionReference(), $minutes);
        Cache::put($transactionId . 'transactionSecure', $response->getSecurityKey(), $minutes);
    }

    public function selectRoom(Request $request, $id)
    {
        $room = Rooms::find($id);
        if (!$room) return back()->withErrors(['room' => 'Invalid room.']);
        $booking = new Booking();
        $booking->checkout_date = Carbon::now()->addDays(1)->format('Y-m-d');

        $isRoom = $room->room_type != 'lodge';
        $params = [];
        $params['type'] = $isRoom ? 'room' : 'lodge';

        $request->session()->put('booking', $booking);

        return to_route('book-a-room-index', $params);
    }
}
