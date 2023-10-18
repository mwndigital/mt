@extends('layouts.admin')
@push('page-title')
    Admin - Create booking step three
@endpush
@push('page-scripts')

@endpush
@push('page-styles')
    <style>
        .pageMain .bookingFormWrap .stepBanner .innerWrap span {
            width: 75%;
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
            The selected room is already booked for the chosen dates. Please choose another room or go back and choose
            different dates.
        </div>
    @endif

    <section class="pageMain">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="bookingFormWrap">
                        <h4 class="stepTitle">Your Details</h4>
                        <div class="stepBanner">
                            <div class="innerWrap">
                                <span>Step 3</span>
                            </div>
                        </div>
                        <form method="post" action="{{ route('admin.book-a-room-step-three-store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Title</label>
                                    <select name="user_title" id="user_title">
                                        <option value="mr">Mr</option>
                                        <option value="mrs">Mrs</option>
                                        <option value="miss">Miss</option>
                                        <option value="ms">Ms</option>
                                        <option value="dr">Dr</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">First name * </label>
                                    <input type="text" name="first_name" id="first_name"
                                           value="{{ $booking ? $booking->first_name : '' }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Last name *</label>
                                    <input type="text" name="last_name" id="last_name"
                                           value="{{ $booking ? $booking->last_name : '' }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Address line one *</label>
                                    <input type="text" name="address_line_one" id="address_line_one"
                                           value="{{ $booking ? $booking->address_line_one : '' }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
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
                                    <input type="text" name="postcode" id="postcode"
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
                                    <a href="{{ route('admin.book-a-room-step-two') }}" class="backBtn"><i
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
            </div>
        </div>
    </section>
@endsection
