@extends('layouts.frontend')
@push('page-title')
    Book a room - Step 3 | Aberlour Moray Scotland
@endpush
@push('page-styles')
    <style>
        .bookingPageMain .formWrap .stepBanner .innerWrap span {
            width: 75%;
        }
    </style>
@endpush
@section('content')
    <section class="bookingPageTop"
             style="background: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('{{ asset('images/rooms/Room_Aberlour.webp') }}'); background-attachment: fixed; background-position: bottom center; background-repeat: no-repeat; background-size: cover;">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1>Book a stay with us</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($errors->any())
        <div class="flex flex-row alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{!! $error !!}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="bookingPageMain">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="formWrap">
                        <h4 class="stepTitle">Your Details</h4>
                        <div class="stepBanner">
                            <div class="innerWrap">
                                <span>Step 3</span>
                            </div>
                        </div>
                        <form method="post" action="{{ route('book-a-room-step-3-store') }}">
                            @csrf
                            @if (!$booking->user_id)
                                <div class="row">
                                    <div class="col-12">
                                        <label for="">Would you like to create an account?</label>
                                        <select name="create_account" id="create_account">
                                            <option value="yes" @if($current_option) selected @endif>Yes</option>
                                            <option value="no" @if(!$current_option) selected @endif>No</option>
                                        </select>
                                        @error('create_account')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <div>
                                            <p>If you already have an account, you can <a
                                                    href="{{ route('login',['redirect' => 'book-a-room-step-3']) }}">login
                                                    here</a></p>
                                        </div>
                                        <script>
                                            $(document).ready(function () {
                                                // Check current field state
                                                var currentOption = $('#create_account').val();
                                                if (currentOption === 'yes') {
                                                    $('#passwordAccountField').css('display', 'flex');
                                                } else {
                                                    $('#passwordAccountField').css('display', 'none');
                                                }
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
                                        <input type="password" name="password" id="password"
                                               value="{{ old('password') }}">
                                        @error('password')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Confirm Password</label>
                                        <input type="password" name="confirmation_password" id="confirmation_password"
                                               value="{{ old('confirmation_password') }}">
                                        @error('confirmation_password')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Title</label>
                                    <select name="user_title" id="user_title">
                                        <option value="mr">Mr</option>
                                        <option value="mrs">Mrs</option>
                                        <option value="miss">Miss</option>
                                        <option value="ms">Ms</option>
                                        <option value="dr">Dr</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="">First name * </label>
                                    <input type="text" name="first_name" id="first_name"
                                           value="{{ $booking ? $booking->first_name : '' }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Last name *</label>
                                    <input type="text" name="last_name" id="last_name"
                                           value="{{ $booking ? $booking->last_name : '' }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Address line one *</label>
                                    <input type="text" name="address_line_one" id="address_line_one"
                                           value="{{ $booking ? $booking->address_line_one : '' }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Address line two</label>
                                    <input type="text" name="address_line_two" id="address_line_two"
                                           value="{{ $booking ? $booking->address_line_two : '' }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">City *</label>
                                    <input type="text" name="city" id="city"
                                           value="{{ $booking ? $booking->city : '' }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Postcode *</label>
                                    <input type="text" name="postcode" id="postcode" maxlength="8"
                                           value="{{ $booking ? $booking->postcode : '' }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Country *</label>
                                    <select name="country" id="country" required>
                                        @foreach($countries as $country)
                                            <option value="{{ $country }}"
                                                    @if($country === 'United Kingdom') selected @endif>{{ $country }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Phone number *</label>
                                    <input type="tel" name="phone_number" id="phone_number"
                                           value="{{ $booking ? $booking->phone_number : '' }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Email address *</label>
                                    <input type="email" name="email_address" id="email_address"
                                           value="{{ $booking ? $booking->email_address : '' }}" required>
                                </div>
                            </div>
                            <div class="row align-items-center mt-4">
                                <div class="col-md-6">
                                    <a href="{{ route('book-a-room-step-2') }}" class="backBtn"><i
                                            class='fas fa-chevron-left'></i> Back</a>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <button type="submit" class='nextBtn'>Next <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <aside class="resSummary">
                        <h2>Reservation Summary</h2>
                        <ul class="list-inline resDates">
                            <li class="list-inline-item">
                                <strong>From</strong><br>
                                {{ date('d/m/Y', strtotime($booking->checkin_date)) }}
                            </li>
                            <li class="list-inline-item">
                                <i class="fa-solid fa-arrow-right"></i>
                            </li>
                            <li class="list-inline-item" style="text-align: right;">
                                <strong>To</strong><br>
                                {{ date('d/m/Y', strtotime($booking->checkout_date )) }}
                            </li>
                        </ul>
                        <hr>
                        <ul class="list-inline">
                            <li class="list-inline-item" style="color: #002C50; font-size: 1.15rem; width: 60%;">
                                <strong>Total number of nights</strong>
                            </li>
                            <li class="list-inline-item"
                                style="text-align: right; width: 35%; color: #000000; font-size: 1rem;">
                                {{ $booking->duration_of_stay }}
                            </li>
                        </ul>
                        <hr>
                        @if($isRoom)
                            <ul class="list-inline adultChildCap">
                                <li class="list-inline-item">
                                    <strong>No of adults</strong><br>
                                    {{ $booking->no_of_adults }}
                                </li>
                                <li class="list-inline-item" style="text-align: right;">
                                    <strong>No of children</strong><br>
                                    {{ $booking->no_of_children }}
                                </li>
                            </ul>
                            <hr>
                        @endif
                        <ul class="list-inline roomList">
                            <li class="list-inline-item" style="width: 100%;">
                                <strong style="color: #002C50;">Room</strong><br>
                                @foreach ($booking->rooms as $room )
                                    {{ $room->name }}
                                    - @if($booking->no_of_adults >= 2 && $booking->no_of_children >= 1 || $booking->no_of_adults >= 2 && $booking->no_of_children == 0)
                                        £{{ $room->price_per_night_double }}
                                    @else
                                        £{{ $room->price_per_night_single }}
                                    @endif per night <br>
                                @endforeach
                            </li>
                        </ul>
                        <hr>
                        <div class="totalWrapper">
                            <ul class="list-inline">
                                <li class="list-inline-item" style="font-size: 1rem; width: 48%; color: #002C50;">
                                    <strong>Deposit</strong>
                                </li>
                                <li class="list-inline-item"
                                    style="font-size: 1rem; text-align: right; width: 48%; color: #002C50;">£50.00
                                </li>
                            </ul>
                            <ul class="list-inline">
                                <li class="list-inline-item" style="font-size: 1rem; width: 48%; color: #002C50;">
                                    <small>Payable 24 hours prior</small>
                                </li>
                                <li class="list-inline-item"
                                    style="font-size: 1rem; text-align: right; width: 48%; color: #002C50;">
                                    £{{$booking->getPayableAmount()}} </li>
                            </ul>

                            <ul class="list-inline">
                                <li class="list-inline-item" style="font-size: 2rem; width: 48%; color: #BEA058;">
                                    <strong>TOTAL</strong></li>
                                <li class="list-inline-item"
                                    style="font-size: 2rem; text-align: right; width: 48%; color: #BEA058;">
                                    £{{$booking->getTotalAmount()}}
                                </li>
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>

@endsection
