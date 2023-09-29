@extends('layouts.frontend')
@push('page-title')
    Book a room - Step 4 Booking Overview | Aberlour Moray Scotland
@endpush
@push('page-scripts')

@endpush
@push('page-styles')
    <style>
        .bookingPageMain .formWrap .stepBanner .innerWrap span {
            width: 100%;
        }
    </style>
@endpush
@section('content')
    <section class="bookingPageTop" style="background: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('{{ asset('images/rooms/Room_Aberlour.webp') }}'); background-attachment: fixed; background-position: bottom center; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Book a stay with us</h1>
                </div>
            </div>
        </div>
    </section>

    @if($errors->any())
        <div class="flex flex-row alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="bookingPageMain">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="formWrap">
                        <h4 class="stepTitle">Booking overview</h4>
                        <div class="stepBanner">
                            <div class="innerWrap">
                                <span>Step 4</span>
                            </div>
                        </div>
                        <form method="post" action="{{ route('book-a-room-step-four-store') }}">
                            @csrf
                            <table class="table table-responsive w-100">
                                <tbody>
                                    <tr>
                                        <td><strong style="color: #002C50; font-size: 1.15rem; font-weight: bold;">Room:</strong></td>
                                        <td style="color: #000; font-size: 1rem;">
                                            {{ $booking->room->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong style="color: #002C50; font-size: 1.15rem; font-weight: bold;">Check in Date</strong></td>
                                        <td style="color: #000; font-size: 1rem;">{{ $booking->checkin_date }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong style="color: #002C50; font-size: 1.15rem; font-weight: bold;">Check out date</strong></td>
                                        <td style="color: #000; font-size: 1rem;">{{ $booking->checkout_date }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong style="color: #002C50; font-size: 1.15rem; font-weight: bold;">Arrival Time:</strong></td>
                                        <td style="color: #000; font-size: 1rem;">{{ $booking->arrival_time }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong style="color: #002C50; font-size: 1.15rem; font-weight: bold;">Number of Adults</strong></td>
                                        <td style="color: #000; font-size: 1rem;">{{ $booking->no_of_adults }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong style="color: #002C50; font-size: 1.15rem; font-weight: bold;">Number of children</strong></td>
                                        <td style="color: #000; font-size: 1rem;">{{ $booking->no_of_children }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong style="color: #002C50; font-size: 1.15rem; font-weight: bold;">Title</strong></td>
                                        <td style="color: #000; font-size: 1rem;">{{ ucfirst($booking->user_title) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong style="color: #002C50; font-size: 1.15rem; font-weight: bold;">Name</strong></td>
                                        <td style="color: #000; font-size: 1rem;">{{ $booking->first_name }} {{ $booking->last_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong style="color: #002C50; font-size: 1.15rem; font-weight: bold;">Address</strong></td>
                                        <td style="color: #000; font-size: 1rem;">
                                            {{ $booking->address_line_one }} <br>
                                            @if($booking->address_line_two)
                                                {{ $booking->address_line_two }}<br>
                                            @endif
                                            {{ $booking->postcode }} <br>
                                            {{ $booking->city }} <br>
                                            {{ $currentCountry  }} <br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong style="color: #002C50; font-size: 1.15rem; font-weight: bold;">Phone Number</strong></td>
                                        <td style="color: #000; font-size: 1rem;">{{ $booking->phone_number }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong style="color: #002C50; font-size: 1.15rem; font-weight: bold;">Email Address</strong></td>
                                        <td style="color: #000; font-size: 1rem;">{{ $booking->email_address }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="row">
                                <div class="col-12">
                                    <label for="">
                                        <input type="checkbox" name="cancellationPolicyAgree" id="cancellationPolicyAgree" value="I have read and agree to The Mash Tun's Deposit and Cancellation Policy" required> By submitting your booking you agree to The Mash Tun's <a href="/deposit-cancellations-policy" target="_blank">Deposit & Cancellation Policy</a>.
                                    </label>
                                </div>
                            </div>

                            <div class="row align-items-center mt-4">
                                <div class="col-md-6">
                                    <a href="{{ route('book-a-room-step-3') }}" class="backBtn"><i class='fas fa-chevron-left'></i> Back</a>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <button type="submit" class='nextBtn'>Book Now <i class="fas fa-chevron-right"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
