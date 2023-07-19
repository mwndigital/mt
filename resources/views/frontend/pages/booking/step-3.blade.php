@extends('layouts.frontend')
@push('page-title')
    Book a room - Step 3 | Aberlour Moray Scotland
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

    <section class="bookingPageMain">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="formWrap">
                        <div class="stepBanner">
                            <div></div>
                        </div>
                        <form method="post" action="{{ route('book-a-room-step-3-store') }}">
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
                                    <input type="text" name="first_name" id="first_name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Last name *</label>
                                    <input type="text" name="last_name" id="last_name" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Address line one *</label>
                                    <input type="text" name="address_line_one" id="address_line_one" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Address line two</label>
                                    <input type="text" name="address_line_two" id="address_line_two">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Postcode *</label>
                                    <input type="text" name="postcode" id="postcode" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="">City *</label>
                                    <input type="text" name="city" id="city" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Country *</label>
                                    <select name="country" id="country" required>
                                        <option selected disabled>Select a country</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country }}">{{ $country }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Phone number *</label>
                                    <input type="tel" name="phone_number" id="phone_number" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Email address *</label>
                                    <input type="email" name="email_address" id="email_address" required>
                                </div>
                            </div>



                            <div class="row align-items-center mt-4">
                                <div class="col-md-6">
                                    <a href="{{ route('book-a-room-step-2') }}" class="backBtn"><i class='fas fa-chevron-left'></i> Back</a>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    {{--<button type="submit">Next <i class="fas fa-chevron-right"></i></button>--}}
                                    <a href="{{ route('book-a-room-payment-step') }}" class="nextBtn">Continue To Payment <i class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
