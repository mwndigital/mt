@extends('layouts.admin')
@push('page-title')
    Admin - Edit Booking {{ $booking->booking_ref }}
@endpush
@push('page-scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#checkin_date').datepicker({
                dateFormat: "dd-mm-yy",
                defaultDate: "{{ now()->setTimezone('Europe/London')->format('d-m-y') }}",
                minDate: 0
            });
            $('#checkout_date').datepicker({
                dateFormat: "dd-mm-yy",
                defaultDate: "{{ now()->setTimezone('Europe/London')->format('d-m-y') }}",
                minDate: 0
            });
            $('#arrival_time').timepicker({
                timeFormat: 'h:mm',
                interval: 30,
                minTime: '14:00',
                maxTime: '21:00',
                defaultTime: '14:00',
                startTime: '14:00',
                dynamic: false,
                dropdown: true,
                scrollbar: true,
                use24Hours: true,
            });
            document.getElementById('no_of_adults').defaultValue = '0';
            document.getElementById('no_of_children').defaultValue = '0';

        });
    </script>
@endpush
@push('page-styles')
    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
@endpush
@section('content')
    <section class="pageHero">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1>
                        Edit {{ $booking->first_name }} {{ $booking->last_name }}'s booking
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
    <section class="pageMain">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Check in date *</label>
                                <input type="text" name="checkin_date" id="checkin_date" value="{{ $booking ? $booking->checkin_date : '' }}">
                            </div>
                            <div class="col-md-4">
                                <label for="">Check out date *</label>
                                <input type="text" name="checkout_date" id="checkout_date" value="{{ $booking ? $booking->checkout_date : '' }}">
                            </div>
                            <div class="col-md-4">
                                <label for="">Arrival Time *</label>
                                <input type="text" name="arrival_time" id="arrival_time" value="{{ $booking ? $booking->arrival_time : '' }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Number of adults *</label>
                                <input type="number" name="no_of_adults" id="no_of_adults" value="{{ $booking ? $booking->no_of_adults : '' }}">
                            </div>
                            <div class="col-md-6">
                                <label for="">Number of children *</label>
                                <input type="number" name="no_of_children" id="no_of_children" value="{{ $booking ? $booking->no_of_children : '' }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h4 class="pageSecTitle">
                                    Customer Details
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Title *</label>
                                <select name="user_title" id="user_title">
                                    <option value="mr">Mr</option>
                                    <option value="mrs">Mrs</option>
                                    <option value="miss">Miss</option>
                                    <option value="ms">Ms</option>
                                    <option value="dr">Dr</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="">First Name *</label>
                                <input type="text" name="first_name" id="first_name" value="{{ $booking ? $booking->first_name : '' }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="">Surname *</label>
                                <input type="text" name="last_name" id="last_name" value="{{ $booking ? $booking->last_name : '' }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Address line one *</label>
                                <input type="text" name="address_line_one" id="address_line_one" value="{{ $booking ? $booking->address_line_one : '' }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="">Address line two</label>
                                <input type="text" name="address_line_two" id="address_line_two" value="{{ $booking ? $booking->address_line_two : '' }}">
                            </div>
                            <div class="col-md-4">
                                <label for="">City *</label>
                                <input type="text" name="city" id="city" value="{{ $booking ? $booking->city : '' }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Postcode *</label>
                                <input type="text" name="postcode" id="postcode" value="{{ $booking ? $booking->postcode : '' }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Country *</label>
                                <select name="country" id="country" required>
                                    @foreach($countries as $country)
                                        <option value="{{ $country }}" @if($country === 'United Kingdom') selected @endif>{{ $country }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Phone number *</label>
                                <input type="tel" name="phone_number" id="phone_number" value="{{ $booking ? $booking->phone_number : '' }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Email address *</label>
                                <input type="email" name="email_address" id="email_address" value="{{ $booking ? $booking->email_address : '' }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class='blueBtn'>Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
