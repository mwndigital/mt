@extends('layouts.frontend')
@push('page-title')
    Book a table - step 1
@endpush
@push('page-styles')

@endpush
@push('page-scripts')
    <script>
        $(document).ready(function () {
            var selectedJoiningFor = '';

            $('#joining_for').change(function () {
                selectedJoiningFor = $(this).val();
                updateReservationTime(selectedJoiningFor);
            });

            function updateReservationTime(joiningFor) {
                var timeOptions = '';

                if (joiningFor === 'lunch') {
                    timeOptions =
                        '<option value="12:00">12:00</option>' +
                        '<option value="12:15">12:15</option>' +
                        '<option value="12:30">12:30</option>' +
                        '<option value="12:45">12:45</option>' +
                        '<option value="13:00">13:00</option>' +
                        '<option value="13:15">13:15</option>' +
                        '<option value="13:30">13:30</option>' +
                        '<option value="13:45">13:45</option>' +
                        '<option value="14:00">14:00</option>'
                } else if (joiningFor === 'evening') {
                    timeOptions =
                        '<option value="18:00">18:00</option>' +
                        '<option value="18:15">18:15</option>' +
                        '<option value="18:30">18:30</option>' +
                        '<option value="18:45">18:45</option>' +
                        '<option value="19:00">19:00</option>' +
                        '<option value="19:15">19:15</option>' +
                        '<option value="19:30">19:30</option>' +
                        '<option value="19:45">19:45</option>' +
                        '<option value="20:00">20:00</option>'
                }

                //Update the html element
                $('#reservation_time').html(timeOptions);
            }
        });
    </script>
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
                <div class="col-lg-10 offset-lg-1">
                    <div class="formWrap">
                        <div class="stepBanner">
                            <div class="innerWrap"><span>Step 1</span></div>
                        </div>
                        <form action="{{ route('book-a-table-index-store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <label for="">What are you joining us for? *</label>
                                    <select name="joining_for" id="joining_for" required>
                                        <option @if($table_booking)@if($table_booking->joining_for) @else()selected
                                                disabled @endif @endif> -- Select an option --
                                        </option>
                                        <option value="lunch"
                                                @if($table_booking)@if($table_booking->joining_for == 'lunch') selected @endif @endif>
                                            Lunch
                                        </option>
                                        <option value="evening"
                                                @if($table_booking)@if($table_booking->joining_for == 'evening') selected @endif @endif>
                                            Evening
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Choose your date *</label>
                                    <input type="date" name="reservation_date" id="reservation_date"
                                           min="{{ $min_date->format('Y-m-d') }}"
                                           max="{{ $max_date->addMonths(6)->format('Y-m-d') }}"
                                           value="{{ old('reservation_date', isset($table_booking) ? $table_booking->reservation_date : null) }}">
                                    @error('reservation_date')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="">Choose your time *</label>
                                    <select name="reservation_time" id="reservation_time" required>
                                        @if(isset($table_booking->reservation_time))
                                            <option
                                                value="{{ isset($table_booking->reservation_time) ? $table_booking->reservation_time : null }}"
                                                selected> {{ isset($table_booking->reservation_time) ? $table_booking->reservation_time : null }}</option>
                                        @endif
                                        <option value="{{ old('reservation_time') }}">
                                            {{ old('reservation_time') }}
                                        </option>
                                    </select>
                                    <small>
                                        For bookings longer than 2 hours please contact us
                                    </small>
                                    @error('reservation_time')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>
                                <div class="col-md-4">
                                    <label for="">Number of guests</label>
                                    <select name="no_of_guests" id="no_of_guests" required>
                                        <option @if(!isset($table_booking) || !$table_booking->no_of_guests) selected
                                                disabled @endif>Select number of guests
                                        </option>
                                        @foreach(['1', '2', '3', '4', '5', '6'] as $g_number)
                                            <option value="{{ $g_number }}"
                                                    @if(isset($table_booking) && $g_number == $table_booking->no_of_guests) selected @endif>{{ ucfirst($g_number) }}</option>
                                        @endforeach
                                    </select>

                                    <small>For more than 6 guests please contact us</small>
                                    @error('no_of_guests')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"></div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <button type="submit" class="nextBtn">Next Step <i class="fas fa-chevron-right"></i>
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
