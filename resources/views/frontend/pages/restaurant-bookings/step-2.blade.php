@extends('layouts.frontend')
@push('page-title')
    Book a table - step 2
@endpush
@push('page-styles')
    <style>
        .bookingPageMain .formWrap .stepBanner .innerWrap span {
            width: 50%;
        }
    </style>
@endpush
@push('page-scripts')

@endpush
@section('content')
    <section class="bookingPageTop"
             style="background: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('{{ asset('images/restaurant/restaurant-page-hero-banner.png') }}'); background-attachment: fixed; background-position: bottom center; background-repeat: no-repeat; background-size: cover;">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1>Book a table with us</h1>
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
    @if(session('booking_conflict'))
        <div class="alert alert-danger" role="alert">
            The selected dates are already booked. Please choose different dates.
        </div>
    @endif
    <section class="bookingPageMain">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="formWrap">
                        <form action="{{ route('book-a-table-step-two-store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="stepBanner">
                                        <div class="innerWrap"><span>Step 2</span></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">First Name *</label>
                                            <input type="text" name="first_name" id="first_name"
                                                   value="{{ old('first_name') }}" required>
                                            @error('first_name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Last Name *</label>
                                            <input type="text" name="last_name" id="last_name"
                                                   value="{{ old('last_name') }}" required>
                                            @error('last_name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">Email Address *</label>
                                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                                   required>
                                            @error('email')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Mobile Number</label>
                                            <input type="tel" name="mobile_number" id="mobile_number"
                                                   value="{{ old('mobile_number') }}">
                                            @error('mobile_number')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">Additional Information</label>
                                            <textarea name="additional_information" id="additional_information"
                                                      cols="30" rows="10">{{ old('additional_information') }}</textarea>
                                            @error('additional_information')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Dietary Information</label>
                                            <textarea name="dietary_information" id="dietary_information" cols="30"
                                                      rows="10">{{ old('dietary_information') }}</textarea>
                                            @error('dietary_information')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row" style="display: none;">
                                        <div class="col-12">
                                            <label for="table_id">Table</label>
                                            <select name="table_id" id="table_id">
                                                @foreach($availableTables as $table)
                                                    <option value="{{ $table->id }}">{{ $table->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="">Would you like to create an account?</label>
                                            <select name="create_account" id="create_account">
                                                <option value="yes" selected>Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                            @error('create_account')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            <script>
                                                $(document).ready(function () {
                                                    $('#create_account').change(function () {
                                                        var selected = $(this).val();
                                                        if (selected === 'yes') {
                                                            $('#passwordAccountField').css('display', 'flex');
                                                        } else if (selected === 'no') {
                                                            $('#passwordAccountField').css('display', 'none');
                                                        }
                                                    });
                                                });
                                            </script>
                                        </div>
                                    </div>
                                    <div class="row" id="passwordAccountField">
                                        <div class="col-md-6">
                                            <label for="">Password</label>
                                            <input type="password" name="password" id="password">
                                            @error('password')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Confirm Password</label>
                                            <input type="password" name="confirmation_password"
                                                   id="confirmation_password">
                                            @error('confirmation_password')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="input-group">
                                                <input type="checkbox" name="newsletter_signup" id="newsletter_signup" checked>
                                                <label for="" class="ms-2">I would like to be kept up to date with all of the latest news, events and offers at The Mash Tun </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="resSummary">
                                        <h2>Booking Summary</h2>
                                        <ul class="list-inline restaurantBookingOverview">
                                            <li class="list-inline-item">
                                                <strong>Reservation Date</strong>
                                            </li>
                                            <li class="list-inline-item">
                                                {{ date('d/m/Y', strtotime($table_booking->reservation_date))  }}
                                            </li>
                                        </ul>
                                        <hr>
                                        <ul class="list-inline restaurantBookingOverview">
                                            <li class="list-inline-item">
                                                <strong>Reservation Time</strong>
                                            </li>
                                            <li class="list-inline-item">
                                                {{ $table_booking->reservation_time }}
                                            </li>
                                        </ul>
                                        <hr>
                                        <ul class="list-inline restaurantBookingOverview">
                                            <li class="list-inline-item">
                                                <strong>Number of guests</strong>
                                            </li>
                                            <li class="list-inline-item">
                                                @if($table_booking->no_of_guests == 1)
                                                    {{ $table_booking->no_of_guests }} guest
                                                @else
                                                    {{ $table_booking->no_of_guests }} guests
                                                @endif
                                            </li>
                                        </ul>
                                        <hr>
                                        <ul class="list-inline restaurantBookingOverview">
                                            <li class="list-inline-item">
                                                <strong>Joining for</strong>
                                            </li>
                                            <li class="list-inline-item">
                                                {{ $table_booking->joining_for }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <a href="{{ route('book-a-table-index') }}" class="backBtn">
                                        <i class="fas fa-chevron-left"></i> Back
                                    </a>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <button type="submit" class="nextBtn">Complete Booking <i
                                            class="fas fa-chevron-right"></i></button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
