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
use Omnipay\Common\CreditCard;

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
        $validated = $request->validate([
            'cancellationPolicyAgree' => ['required'],
        ]);

        $booking = $request->session()->get('booking');
        $booking->fill($validated);
        $request->session()->put('booking', $booking);

        return to_route('book-a-room-payment-step');
    }


    protected function getSagePayGateway() {
        $gateway =  \Omnipay::gateway('opayo');
        $gateway->setBillingForShipping(true);
        return $gateway;
    }

    public function paymentStep(Request $request){
        $booking = $request->session()->get('booking');
        $request->session()->put('transactionId', uniqid());
        return view('frontend.pages.booking.step-payment', compact('booking'));
    }

    public function processPayment(Request $request){
        $booking = $request->session()->get('booking');
        $gateway = $this->getSagePayGateway();
        $transactionId = $request->session()->get('transactionId');

       try{
        $response = $gateway->purchase([
            'amount' => '50.00', // Replace with the actual amount
            'currency' => 'GBP',
            'transactionID' => $transactionId,
            'VendorTxCode' => uniqid(),
            'description' => 'The Mash Tun room booking deposit',
            'clientIp' => '90.242.7.117',
            'card' => $this->getCardDetails($booking, $request),
            'returnUrl' => route('book-a-room-thank-you'),
            'cancelUrl' => route('book-a-room-failed'),
        ])->send();
       } catch(\Exception $e){
           return redirect()->back()->with('error', $e->getMessage())->withInput();
         }

        if($response->isSuccessful()){
            $booking->save();
            // Send email
             try{
                Mail::to($booking['email_address'])->send(new BookingConfirmationMail($booking));
             } catch(\Exception $e){ }
             $this->cleanSession($request);
            return view('frontend.pages.booking.thank-you', compact('booking'));
        }
        elseif($response->isRedirect()){
            $request->session()->put('transactionId', $transactionId);
            $request->session()->put('transactionReference', $response->getTransactionReference());
            $request->session()->put('transactionSecure', $response->getSecurityKey());
            // Redirect
            $response->redirect();
        }
        else {
            //Failed
            return view('frontend.pages.booking.payment-failed', compact('booking'))->with('response', $response);
        }
    }

    public function thankYou(Request $request) {
        // dd($request->all());exit;
        $gateway = $this->getSagePayGateway();
        $completeRequest = $gateway->completeAuthorize([
            'transactionId' => $request->session()->get('transactionId'),
        ]);
        $completeResponse = $completeRequest->send();
        if($completeResponse->isSuccessful()){
            $booking = $request->session()->get('booking');
            $booking->save();
            try{
                Mail::to($booking['email_address'])->send(new BookingConfirmationMail($booking));
             } catch(\Exception $e){ }
            $this->cleanSession($request);
            return view('frontend.pages.booking.thank-you', compact('booking'));
        }
        else {
            //Failed
            return view('frontend.pages.booking.payment-failed', compact('booking'))->with('response', $completeResponse);

        }
    }

    public function paymentFailed() {
        return view('frontend.pages.booking.payment-failed');
    }

    private function getCardDetails($booking, $request){
        return new CreditCard([
            'number' => str_replace('-', '', $request->card_number),
            'expiryMonth' => $request->expiry_month,
            'expiryYear' => $request->expiry_year,
            'cvv' => $request->cvv,
            'firstName' => $request->name,
            'lastName' => '',
            'email' => $booking->email_address,
            'BillingFirstName' => $booking->first_name,
            'BillingLastName' => $booking->last_name,
            'BillingAddress1' => $booking->address_line_one,
            'BillingCity' => $booking->city,
            'BillingPostCode' => str_replace(' ', '', $booking->postcode),
            'BillingCountry' => $booking->country,
            'BillingState' => '',
        ]);
    }

    private function cleanSession(Request $request){
        $request->session()->forget('booking');
        $request->session()->forget('transactionId');
        $request->session()->forget('transactionReference');
        $request->session()->forget('transactionSecure');
    }
}
