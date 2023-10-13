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
                minDate: 0,
                onSelect: function(selectedDate) {
                    const type = $('#type').val();
                    const date = $(this).datepicker('getDate');

                    if(type === 'lodge'){
                        date.setDate(date.getDate() + 2);
                    } else {
                        date.setDate(date.getDate() + 1);
                    }

                    $('#checkout_date').datepicker('option', 'minDate', date || 1);
                }
            });

            $('#checkout_date').datepicker({
                dateFormat: "dd-mm-yy",
                defaultDate: "{{ now()->setTimezone('Europe/London')->format('d-m-y') }}",
                minDate: 1,
            });

            $('#arrival_time').timepicker({
            timeFormat: 'HH:mm',
            minTime: '14:00',
            maxTime: '21:00',
            interval: 30,
            defaultTime: '14:00',
            startTime: '14:00',
            dropdown: true,
            scrollbar: false,
            use24Hours: true
            });

            document.getElementById('no_of_adults').defaultValue = '1';
            document.getElementById('no_of_children').defaultValue = '0';
            // Check in date default value today
            document.getElementById('checkin_date').defaultValue = '{{ now()->setTimezone('Europe/London')->format('d-m-Y') }}';

            // Function to toggle visibility of adult and children inputs
            function toggleGuestInputs() {
                var selectedType = $('#type').val();
                if (selectedType === 'room') {
                    $('#no_of_adults').closest('.col-md-6').show();
                    $('#no_of_children').closest('.col-md-6').show();
                    // reset restriction on date
                    $('#checkout_date').datepicker('option', 'minDate', 1);
                } else if (selectedType === 'lodge') {
                    $('#no_of_adults').closest('.col-md-6').hide();
                    $('#no_of_children').closest('.col-md-6').hide();
                    $('#checkout_date').datepicker('option', 'minDate', 2);

                }
            }

            // Call the function when the page loads
            toggleGuestInputs();

            // Listen for changes in the #type field
            $('#type').on('change', function() {
                toggleGuestInputs();
            });



        });
    </script>

@endpush
@section('content')
    <section class="bookingPageTop" style="background: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('{{ asset('images/rooms/Room_Aberlour.webp') }}'); background-attachment: fixed; background-position: bottom center; background-repeat: no-repeat; background-size: cover;">
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
                                    <input type="text" autocomplete="off" name="checkin_date" id="checkin_date" value="{{ $booking ? $booking->checkin_date : '' }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Check out date</label>
                                    <input type="text" autocomplete="off" name="checkout_date" id="checkout_date" value="{{ $booking ? \Carbon\Carbon::parse($booking->checkout_date)->format('d-m-Y') : '' }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Type</label>
                                    <select name="type" id="type">
                                        <option value="room" {{ $isRoom ? 'selected' : '' }}>Room</option>
                                        <option value="lodge" {{ !$isRoom ? 'selected' : '' }}>Lodge</option>
                                    </select>
                                </div>
                                <div class="col-md-4 d-none">
                                    <label for="">Arrival Time</label>
                                    <input type="text" name="arrival_time" id="arrival_time" value="{{ $booking ? $booking->arrival_time : '' }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Number of adults</label>
                                    <input min="1" type="number" name="no_of_adults" id="no_of_adults" value="{{ $booking ? $booking->no_of_adults : 1 }}">
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
