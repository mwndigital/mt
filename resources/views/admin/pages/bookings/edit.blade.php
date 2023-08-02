@extends('layouts.admin')
@push('page-title')
    Admin - Edit Booking {{ $booking->booking_ref }}
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
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
