<?php

namespace App\Http\Controllers\Frontend;

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
use Omnipay\Omnipay;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $booking = $request->session()->get('booking');
        return view('frontend.pages.booking.index', compact('booking', ));
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

        return to_route('book-a-room-step-2');
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

        return view('frontend.pages.booking.step-2', compact('booking', 'filteredRooms'));
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

        return to_route('book-a-room-payment-step');*/


        $booking = $request->session()->get('booking');
        $validated = $request->validate([
            'cancellationPolicyAgree' => ['required'],
        ]);
        $booking->fill($validated);
        $booking->save();
        $request->session()->forget('booking');

        Mail::to($booking['email_address'])->send(new BookingConfirmationMail($booking));

        return redirect('book-a-room/thank-you');

    }


    protected function getSagePayGateway() {
        $gateway = OmniPay::create('SagePay\Server');

        $gateway->setVendor('cgarsltd1');
        $gateway->setTestMode(true);

        return $gateway;
    }

    public function paymentStep(Request $request){
        $booking = $request->session()->get('booking');
        //dd($booking);
        return view('frontend.pages.booking.step-payment', compact('booking'));
    }

    public function processPayment(Request $request){
        $booking = $request->session()->get('booking');

        $gateway = $this->getSagePayGateway();


        //Generate unique vendorTxCode
        $vendorTxCode = uniqid();

        $transactionId = uniqid();

        //define the payment data to be sent
        $data = [
            'VendorTxCode' => $vendorTxCode,
            'VendorName' => 'cgarsltd1',
            'Apply3DSecure' => '0',
            'amount' => '50.00',
            'currency' => 'GBP',
            'card' => $request->input('card'),
            'description' => 'The Mash Tun room booking deposit',
            'transactionID' => $transactionId,
            'BillingFirstName' => $booking->first_name,
            'BillingLastName' => $booking->last_name,
            'BillingAddress1' => $booking->address_line_one,
            'BillingCity' => $booking->city,
            'BillingPostCode' => str_replace(' ', '', $booking->postcode),
            'BillingCountry' => $booking->country,
            'BillingState' => ' ',
            'ShippingFirstname' => $booking->first_name,
            'ShippingLastName' => $booking->last_name,
            'ShippingAddress1' => $booking->address_line_one,
            'ShippingCity' => $booking->city,
            'ShippingPostCode' => str_replace(' ', '', $booking->postcode),
            'ShippingCountry' => $booking->country,
            'ShippingState' => ' ',

            'notifyUrl' => route('sagepay.notify'),
        ];

        //send the request to SP
        $response = $gateway->purchase($data)->send();

        //dd($data);



        //Check response and redirect appropriately
        if($response->isSuccessful()){
            //Successful

            return view('frontend.pages.booking.thank-you', compact('booking'));
        }
        elseif($response->isRedirect()){
            $response->redirect();
        }
        else {
            //Failed
            return view('frontend.pages.booking.payment-failed', compact('booking'))->with('response', $response);
        }
    }

    public function sagepayNotify(Request $request) {
        $gateway = $this->getSagePayGateway();

        $notificationData = $request->all();

        $response = $gateway->completePurchase($notificationData)->send();

        if($response->isSuccessful()){
            // Payment successful
            // Update the status of the booking or order in your application
            // For example, retrieve the booking using the transaction ID received from SagePay
            // $transactionId = $notificationData['VendorTxCode'];
            // $booking = Booking::where('transaction_id', $transactionId)->first();
            // $booking->update(['status' => 'paid']);

            // Return a success response to SagePay
            return response('OK');
        }
        else {
            // Payment failed or invalid notification
            // Log the error or take appropriate action
            // Return a failure response to SagePay
            return response('ERROR');
        }
    }

    public function thankYou() {
        return view('frontend.pages.booking.thank-you');
    }


}
