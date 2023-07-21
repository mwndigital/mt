@extends('layouts.frontend')
@push('page-title')
    Book a room - Step 4 Booking Overview | Aberlour Moray Scotland
@endpush
@push('page-scripts')

@endpush
@push('page-styles')
    <style>
        .bookingPageMain .formWrap .stepBanner .innerWrap span {
            width: 80%;
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
                                        <td><strong>Room:</strong></td>
                                        <td>
                                            {{ $booking->room->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Check in Date</strong></td>
                                        <td>{{ $booking->checkin_date }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Check out date</strong></td>
                                        <td>{{ $booking->checkout_date }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Arrival Time:</strong></td>
                                        <td>{{ $booking->arrival_time }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total number of nights</strong></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Number of Adults</strong></td>
                                        <td>{{ $booking->no_of_adults }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Number of children</strong></td>
                                        <td>{{ $booking->no_of_children }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Title</strong></td>
                                        <td>{{ $booking->user_title }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Name</strong></td>
                                        <td>{{ $booking->first_name }} {{ $booking->last_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Address</strong></td>
                                        <td>
                                            {{ $booking->address_line_one }} <br>
                                            @if($booking->address_line_two)
                                                {{ $booking->address_line_two }}<br>
                                            @endif
                                            {{ $booking->postcode }} <br>
                                            {{ $booking->city }} <br>
                                            {{ $booking->country }} <br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Phone Number</strong></td>
                                        <td>{{ $booking->phone_number }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email Address</strong></td>
                                        <td>{{ $booking->email_address }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-12">
                                    <label for="">
                                        <input type="checkbox" name="cancellationPolicyAgree" id="cancellationPolicyAgree" value="I have read and agree to The Mash Tun's Deposit and Cancellation Policy" required> I have read and agree to The Mash Tun's <a href="/deposit-cancellations-policy" target="_blank">Deposit & Cancellation Policy</a>.
                                    </label>
                                </div>
                            </div>

                            <div class="row align-items-center mt-4">
                                <div class="col-md-6">
                                    <a href="{{ route('book-a-room-step-3') }}" class="backBtn"><i class='fas fa-chevron-left'></i> Back</a>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <button type="submit" class='nextBtn'>Continue to Payment <i class="fas fa-chevron-right"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
