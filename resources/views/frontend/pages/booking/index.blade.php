@extends('layouts.frontend')
@push('page-title')
    Book a room - Step 1 | Aberlour Moray Scotland
@endpush
@push('page-styles')
    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
@endpush
@push('page-scripts')

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


        });
    </script>

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
    @if(session('booking_conflict'))
        <div class="alert alert-danger" role="alert">
            The selected dates are already booked. Please choose different dates.
        </div>
    @endif


    <section class="bookingPageMain">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="formWrap">
                        <h4 class="stepTitle">Booking Details</h4>
                        <div class="stepBanner">
                            <div class="innerWrap">
                                <span>Step 1</span>
                            </div>
                        </div>
                        <form method="post" action="{{ route('book-a-room-step-1-store') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Check in date</label>
                                    <input type="text" name="checkin_date" id="checkin_date" value="{{ $booking ? $booking->checkin_date : '' }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Check out date</label>
                                    <input type="text" name="checkout_date" id="checkout_date" value="{{ $booking ? $booking->checkout_date : '' }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Arrival Time</label>
                                    <input type="text" name="arrival_time" id="arrival_time" value="{{ $booking ? $booking->arrival_time : '' }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Number of adults</label>
                                    <input type="number" name="no_of_adults" id="no_of_adults" value="{{ $booking ? $booking->no_of_adults : '' }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Number of children</label>
                                    <input type="number" name="no_of_children" id="no_of_children" value="{{ $booking ? $booking->no_of_children : '' }}">
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="nextBtn">Next <i class="fas fa-chevron-right"></i></button>
                                    {{--<a href="{{ route('book-a-room-step-2') }}" class="nextBtn">Next <i class="fas fa-chevron-right"></i></a>--}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
