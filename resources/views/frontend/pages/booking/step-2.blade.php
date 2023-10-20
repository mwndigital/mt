@extends('layouts.frontend')
@push('page-title')
    Book rooms - Step 2 | Aberlour Moray Scotland
@endpush
@push('page-scripts')
    <script>
        const selectRoom = (currentRoom) => {
            const isRoom = {{ $isRoom ? 'true' : 'false' }};
            const selectedRooms = document.querySelectorAll('input[name="room_id[]"]:checked');
            if (!isRoom) {
                // remove all selected rooms except the current one
                selectedRooms.forEach(room => {
                    const roomId = room.value
                    if (roomId != currentRoom.id) {
                        room.checked = false;
                    }
                });
            }
            const newSelectedRooms = document.querySelectorAll('input[name="room_id[]"]:checked');
            const summary = document.getElementById('sub-list');
            const phpSummary = document.getElementById('php-list');
            const totalElement = document.getElementById('total');

            // Clear previous content
            summary.innerHTML = '';

            // Display next button if at least one room is selected
            const nextElement = document.getElementById('next');
            const roomWarningElement = document.getElementById('roomWarning');

            if (newSelectedRooms.length > 0) {
                // Generate summary for selected rooms
                let totalCost = 0;
                nextElement.classList.remove('d-none');
                roomWarningElement.classList.add('d-none');

                summary.innerHTML = `
            <ul class="list-inline roomList">
                <li class="list-inline-item" style="width: 100%;">
                    <strong style="color: #002C50;">Room(s)</strong><br>
                </li>
            `;

                newSelectedRooms.forEach(room => {
                    const roomName = room.getAttribute('data-name');
                    const roomPrice = parseFloat(room.getAttribute('data-price'));
                    totalCost += roomPrice;
                    // Update select button text to selected
                    const selectButton = document.getElementById('select-text' + room.value);
                    selectButton.innerHTML = 'Selected';

                    summary.innerHTML += `
                        <li class="list-inline-item" style="width: 100%;">
                            ${roomName} - ${roomPrice} per night
                        </li>
                `;
                });

                summary.innerHTML += `
            </ul>
            <hr>`

                // Update total cost
                summary.innerHTML += `
            <div class="totalWrapper" id="total">

            <ul class="list-inline">
                           <li class="list-inline-item" style="font-size: 1rem; width: 48%; color: #002C50;">
                               <strong>Deposit</strong>
                           </li>
                           <li class="list-inline-item" style="font-size: 1rem; text-align: right; width: 48%; color: #002C50;">£50.00 </li>
                   </ul>
                     <ul class="list-inline">
                           <li class="list-inline-item" style="font-size: 1rem; width: 48%; color: #002C50;">
                               <small>Payable 24 hours prior</small>
                           </li>
                           <li class="list-inline-item" style="font-size: 1rem; text-align: right; width: 48%; color: #002C50;">£${parseFloat(totalCost - 50)} </li>
                   </ul>

                <ul class="list-inline">
                    <li class="list-inline-item" style="font-size: 2rem; width: 48%; color: #BEA058;"><strong>TOTAL</strong></li>
                    <li class="list-inline-item" style="font-size: 2rem; text-align: right; width: 48%; color: #BEA058;">
                        £${totalCost * {{ $booking->duration_of_stay }}}
                    </li>
                </ul>
            </div>


            `;
            } else {
                // If no rooms are selected, show a warning and hide total and next button
                roomWarningElement.classList.remove('d-none');
                nextElement.classList.add('d-none');
            }
            // Update select button text if not checked to select
            const unCheckedCheckboxes = document.querySelectorAll('input[type="checkbox"]:not(:checked)');
            unCheckedCheckboxes.forEach(checkbox => {
                const selectButton = document.getElementById('select-text' + checkbox.value);
                selectButton.innerHTML = 'Select';
            });
        }

        const onSubmit = () => {
            const form = document.getElementById('formRoom');
            form.submit();
        }
    </script>

@endpush
@push('page-styles')
    <style>
        .bookingPageMain .formWrap .stepBanner .innerWrap span {
            width: 50%;
        }

        .checkItem:hover {
            background-color: #f0f0f0;
            cursor: pointer !important;
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

    <section class="bookingPageMain">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="formWrap">
                        <h4 class="stepTitle">Choose rooms</h4>
                        <div class="stepBanner">
                            <div class="innerWrap">
                                <span>Step 2</span>
                            </div>
                        </div>
                        <form method="post" action="{{ route('book-a-room-step-2-store') }}" id="formRoom">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="row innerRow">
                                        @foreach($filteredRooms as $room)
                                            <div class="col-md-6" onclick="selectRoom({{$room}});">
                                                <label class="checkItem">
                                                    <input type="checkbox" name="room_id[]" id="room_{{ $room->id }}"
                                                           value="{{ $room->id }}"
                                                           @if($booking && $booking->room_id == $room->id) checked
                                                           @endif data-price="{{ $booking->no_of_adults > 1 ? $room->price_per_night_double : $room->price_per_night_single }}"
                                                           data-name="{{ $room->name }}"
                                                           data-duration="{{ $room->duration_of_stay }}">
                                                    <label for="room_{{ $room->id }}">
                                                        <img class="img-fluid"
                                                             src="{{ Storage::url($room->featured_image) }}">
                                                        <div class="content">
                                                            <h4>{{ $room->name }}</h4>
                                                            <h6 class="price">
                                                                Price from: £{{ $room->price_per_night_single }}
                                                            </h6>
                                                            <button type="button" class="btn mb-3"
                                                                    id="select-text{{ $room->id }}">Select
                                                            </button>
                                                            {!! $room->short_description !!}
                                                        </div>
                                                    </label>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
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
                        <div id="sub-list"></div>
                        <div id="php-list">
                            @if ($booking->room)
                                <ul class="list-inline roomList">
                                    <li class="list-inline-item" style="width: 100%;">
                                        <strong style="color: #002C50;">Room</strong><br>
                                        {{ $booking->room->name }}
                                        - @if($booking->no_of_adults >= 2 && $booking->no_of_children >= 1 || $booking->no_of_adults >= 2 && $booking->no_of_children == 0)
                                            £{{ $booking->room->price_per_night_double }}
                                        @else
                                            £{{ $booking->room->price_per_night_single }}
                                        @endif per night
                                    </li>
                                </ul>
                                <hr>
                                <ul class="list-inline">
                                    <li class="list-inline-item"
                                        style="width: 48%; color: #002C50; font-size: 1.15rem;">
                                        <strong>Room(s)</strong>
                                    </li>
                                    <li class="list-inline-item"
                                        style="width: 48%; text-align: right; font-size: 1rem;">
                                        @if($booking->no_of_children >= 2 && $booking->no_of_children >= 1 || $booking->no_of_adults >= 2 && $booking->no_of_children == 0)
                                            £{{ $booking->room->price_per_night_double * $booking->duration_of_stay }}
                                        @else
                                            £{{ $booking->room->price_per_night_single * $booking->duration_of_stay }}
                                        @endif
                                    </li>
                                </ul>
                                <hr>
                                <div class="totalWrapper" id="total">
                                    <ul class="list-inline">
                                        <li class="list-inline-item"
                                            style="font-size: 1rem; width: 48%; color: #002C50;">
                                            <strong>Deposit</strong>
                                        </li>
                                        <li class="list-inline-item"
                                            style="font-size: 1rem; text-align: right; width: 48%; color: #002C50;">
                                            £50.00
                                        </li>
                                    </ul>
                                    <ul class="list-inline">
                                        <li class="list-inline-item"
                                            style="font-size: 1rem; width: 48%; color: #002C50;">
                                            <small>Payable 24 hours prior</small>
                                        </li>
                                        <li class="list-inline-item"
                                            style="font-size: 1rem; text-align: right; width: 48%; color: #002C50;">
                                            £{{$booking->getPayableAmount()}} </li>
                                    </ul>

                                    <ul class="list-inline">
                                        <li class="list-inline-item"
                                            style="font-size: 2rem; width: 48%; color: #BEA058;"><strong>TOTAL</strong>
                                        </li>
                                        <li class="list-inline-item"
                                            style="font-size: 2rem; text-align: right; width: 48%; color: #BEA058;">
                                            £{{$booking->getTotalAmount()}}
                                        </li>
                                    </ul>
                                </div>

                                <hr>
                            @else
                                <div class="row" id="roomWarning">
                                    <div class="col-12 text-center alert alert-info">
                                        Please select a room to continue
                                    </div>
                                </div>
                            @endif
                        </div>
                        <!-- next button -->
                        <div class="row d-none" id="next">
                            <div class="col-12">
                                <button class="darkGoldBtn" type="button" onclick="onSubmit()"
                                        style="font-size: 1.5rem;">Next <i class="fas fa-chevron-right"></i></button>
                            </div>

                            <div class="col-12 mt-2">
                                <a href="{{ route('book-a-room-index') }}" style="width: 100%;" class="btn"><i
                                        class='fas fa-chevron-left'></i> Back</a>
                            </div>
                        </div>


                    </aside>
                </div>
            </div>
        </div>
    </section>

@endsection
