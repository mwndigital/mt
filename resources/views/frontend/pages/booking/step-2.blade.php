@extends('layouts.frontend')
@push('page-title')
    Book a room - Step 2 | Aberlour Moray Scotland
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
            })
        });
    </script>
@endpush
@push('page-styles')
    <link href=
              'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css'
          rel='stylesheet'>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <style>
        .bookingPageMain .formWrap .stepBanner .innerWrap span {
            width: 40%;
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
                        <h4 class="stepTitle">Booking Details</h4>
                        <div class="stepBanner">
                            <div class="innerWrap">
                                <span>Step 2</span>
                            </div>
                        </div>
                        <form method="post" action="{{ route('book-a-room-step-2-store') }}">
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
                                    <input type="time" name="arrival_time" id="arrival_time" value="{{ $booking ? $booking->arrival_time : '' }}">
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

                            <div class="row align-items-center mt-4">
                                <div class="col-md-6">
                                    <a href="{{ route('book-a-room-index') }}" class="backBtn"><i class='fas fa-chevron-left'></i> Back</a>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <button type="submit" class="nextBtn">Next <i class="fas fa-chevron-right"></i></button>
                                    {{--<a href="{{ route('book-a-room-step-3') }}" class="nextBtn">Next <i class="fas fa-chevron-right"></i></a>--}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
