@extends('layouts.admin')
@push('page-title')
    Admin - Edit Booking {{ $booking->booking_ref }}
@endpush
@push('page-scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script>
        $(document).ready(function () {
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
        });
        const defaultSelectedRooms = {!! json_encode($selectedRoomIds) !!};
        // Add event listener for room checkboxes
        const checkAvailability = (roomId) => {
            const checkinDate = $('#checkin_date').val();
            const checkoutDate = $('#checkout_date').val();

            // if the room is already selected, don't send AJAX request
            if (defaultSelectedRooms.includes(roomId)) {
                return;
            }


            // Send AJAX request
            const isChecked = $('#room-' + roomId).is(':checked');
            if (isChecked) {
                $.ajax({
                    url: '/api/check-room',
                    type: 'POST',
                    data: {
                        room_id: roomId,
                        checkin_date: checkinDate,
                        checkout_date: checkoutDate,
                    },
                    success: function (response) {
                        if (response.is_available) {
                            // Room is available, check the checkbox
                            $('input[value="' + roomId + '"]').prop('checked', true);
                        } else {
                            // Room is not available, uncheck the checkbox
                            $('input[value="' + roomId + '"]').prop('checked', false);
                            alert('Room is not available for selected dates.');
                        }
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });
            }
        }
    </script>
@endpush
@push('page-styles')
    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css'
          rel='stylesheet'>
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
            <!-- Error Message -->
            @if ($errors->any())
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>
                                        <i class="fas fa-exclamation-circle"></i> {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <form action="" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Check in date *</label>
                                <input type="text" name="checkin_date" id="checkin_date"
                                       value="{{ $booking ? date('d-m-Y', strtotime(old('checkin_date',$booking->checkin_date))) : '' }}">
                            </div>
                            <div class="col-md-6">
                                <label for="">Check out date *</label>
                                <input type="text" name="checkout_date" id="checkout_date"
                                       value="{{ $booking ? date('d-m-Y', strtotime(old('checkout_date',$booking->checkout_date))) : '' }}">
                            </div>
                            <div class="col-md-4 d-none">
                                <label for="">Arrival Time *</label>
                                <input type="text" name="arrival_time" id="arrival_time"
                                       value="{{ $booking ? $booking->arrival_time : '' }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Number of adults *</label>
                                <input type="number" name="no_of_adults" id="no_of_adults"
                                       value="{{ $booking ? old('no_of_adults',$booking->no_of_adults) : '' }}">
                            </div>
                            <div class="col-md-6">
                                <label for="">Number of children *</label>
                                <input type="number" name="no_of_children" id="no_of_children"
                                       value="{{ $booking ? old('no_of_children',$booking->no_of_children) : '' }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h4 class="pageSecTitle">
                                    Selected Rooms
                                </h4>
                            </div>
                        </div>
                        <!-- Add this inside your form -->
                        <div class="row">
                            @foreach($rooms as $room)
                                <div class="col-md-6">
                                    <label>
                                        <input onclick="checkAvailability({{$room->id}});" id="room-{{$room->id}}"
                                               type="checkbox" name="selected_rooms[]" value="{{ $room->id }}"
                                               @if(in_array($room->id, $selectedRoomIds)) checked @endif>
                                        {{ $room->name }}
                                    </label>
                                </div>
                            @endforeach
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
                                <input type="text" name="first_name" id="first_name"
                                       value="{{ $booking ? old('first_name',$booking->first_name) : '' }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="">Surname *</label>
                                <input type="text" name="last_name" id="last_name"
                                       value="{{ $booking ? old('last_name',$booking->last_name) : '' }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Address line one *</label>
                                <input type="text" name="address_line_one" id="address_line_one"
                                       value="{{ $booking ? old('address_line_one',$booking->address_line_one) : '' }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="">Address line two</label>
                                <input type="text" name="address_line_two" id="address_line_two"
                                       value="{{ $booking ? old('address_line_two',$booking->address_line_two) : '' }}">
                            </div>
                            <div class="col-md-4">
                                <label for="">City *</label>
                                <input type="text" name="city" id="city" value="{{ $booking ? old('city',$booking->city) : '' }}"
                                       required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Postcode *</label>
                                <input type="text" name="postcode" id="postcode"
                                       value="{{ $booking ? old('postcode',$booking->postcode) : '' }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Country *</label>
                                <select name="country" id="country" required>
                                    @foreach($countries as $country)
                                        <option value="{{ $country }}"
                                                @if($booking && $booking->country == $country) selected @endif>{{ $country }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Phone number *</label>
                                <input type="tel" name="phone_number" id="phone_number"
                                       value="{{ $booking ? old('phone_number',$booking->phone_number) : '' }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Email address *</label>
                                <input type="email" name="email_address" id="email_address"
                                       value="{{ $booking ? old('email_address',$booking->email_address) : '' }}" required>
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
