@extends('layouts.admin')
@push('page-title')
    Admin - Create booking step three
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
    <section class="pageHero">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1>
                        Create booking - step three
                    </h1>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.bookings.index') }}" class="blueBtn">
                            <i class="fas fa-chevron-left"></i> Back to Bookings
                        </a>
                    </div>
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

    @if(session('room_conflict'))
        <div class="alert alert-danger" role="alert">
            The selected room is already booked for the chosen dates. Please choose another room or go back and choose different dates.
        </div>
    @endif

    <section class="pageMain">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="bookingFormWrap">
                        <h4 class="stepTitle">Booking overview</h4>
                        <div class="stepBanner">
                            <div class="innerWrap">
                                <span>Step 4</span>
                            </div>
                        </div>
                        <form method="post" action="{{ route('admin.book-a-room-step-four-store') }}">
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
                            {{--<div class="row">
                                <div class="col-12">
                                    <label for="">
                                        <input type="checkbox" name="cancellationPolicyAgree" id="cancellationPolicyAgree" value="I have read and agree to The Mash Tun's Deposit and Cancellation Policy" required> By submitting your booking you agree to The Mash Tun's <a href="/deposit-cancellations-policy" target="_blank">Deposit & Cancellation Policy</a>.
                                    </label>
                                </div>
                            </div>--}}

                            <div class="row align-items-center mt-4">
                                <div class="col-md-6">
                                    <a href="{{ route('admin.book-a-room-step-three') }}" class="backBtn"><i class='fas fa-chevron-left'></i> Back</a>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <button type="submit" class='nextBtn'>Submit <i class="fas fa-chevron-right"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
