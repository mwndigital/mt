@extends('layouts.frontend')
@push('page-title')
    Book a room - Step 2 | Aberlour Moray Scotland
@endpush
@push('page-scripts')
    <script>
        const radioButtons = document.querySelectorAll('input[type="radio"]');

        radioButtons.forEach((radio) => {
            radio.addEventListener('change', () => {
                if (radio.checked) {
                    radioButtons.forEach((otherRadio) => {
                        if (otherRadio !== radio) {
                            otherRadio.parentElement.classList.remove('checked');
                        }
                    });
                    radio.parentElement.classList.add('checked');
                }
            });
        });

        const selectRoom = (room) => {
            // display next button
            const nextElement = document.getElementById('next');
            const roomWarningElement = document.getElementById('roomWarning');

            if (nextElement && roomWarningElement) {
                nextElement.classList.remove('d-none');
                roomWarningElement.classList.add('d-none');
            }


            const summary = document.getElementById('sub-list');
            const phpSummary = document.getElementById('php-list');
            phpSummary.innerHTML = '';
            // Add room name to reservation summary and price
            summary.innerHTML = `
                <ul class="list-inline roomList">
                    <li class="list-inline-item" style="width: 100%;">
                        <strong style="color: #002C50;">Room</strong><br>
                        ${room.name} - ${room.price_per_night_single} per night
                    </li>
                </ul>
                <hr>
                <ul class="list-inline">
                    <li class="list-inline-item" style="width: 48%; color: #002C50; font-size: 1.15rem;">
                        <strong>Room(s)</strong>
                    </li>
                    <li class="list-inline-item" style="width: 48%; text-align: right; font-size: 1rem;">
                        £${room.price_per_night_single * {{ $booking->duration_of_stay }}}
                    </li>
                </ul>
                <hr>
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
                           <li class="list-inline-item" style="font-size: 1rem; text-align: right; width: 48%; color: #002C50;">£${room.price_per_night_single * {{ $booking->duration_of_stay }} - 50} </li>
                   </ul>

                       <ul class="list-inline">
                           <li class="list-inline-item" style="font-size: 2rem; width: 48%; color: #BEA058;"><strong>TOTAL</strong></li>
                           <li class="list-inline-item" style="font-size: 2rem; text-align: right; width: 48%; color: #BEA058;">
                                £${room.price_per_night_single * {{ $booking->duration_of_stay }}}
                            </li>
                          </ul>
                          </div>
                <hr>
            `;

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

    @if(session('room_conflict'))
        <div class="alert alert-danger" role="alert">
            The selected room is already booked for the chosen dates. Please choose another room or go back and choose different dates.
        </div>
    @endif

    <section class="bookingPageMain">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="formWrap">
                        <h4 class="stepTitle">Choose a room</h4>
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
                                                    <input type="radio" name="room_id" id="room_{{ $room->id }}" value="{{ $room->id }}" @if($booking && $booking->room_id == $room->id) checked @endif>
                                                    <label for="room_{{ $room->id }}">
                                                        <img class="img-fluid" src="{{ Storage::url($room->featured_image) }}">
                                                        <div class="content">
                                                            <h4>{{ $room->name }}</h4>
                                                            <h6 class="price">
                                                                Price from: £{{ $room->price_per_night_single }}
                                                            </h6>
                                                            <button style="width: 100%;background:#bea058;" type="button" class="btn mb-3 text-white">Select</button>
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
                            <li class="list-inline-item" style="text-align: right; width: 35%; color: #000000; font-size: 1rem;">
                                {{ $booking->duration_of_stay }}
                            </li>
                        </ul>
                        <hr>
                        @if(!$isRoom)
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
                                {{ $booking->room->name }} - @if($booking->no_of_adults >= 2 && $booking->no_of_children >= 1 || $booking->no_of_adults >= 2 && $booking->no_of_children == 0) £{{ $booking->room->price_per_night_double }} @else £{{ $booking->room->price_per_night_single }} @endif per night
                            </li>
                        </ul>
                        <hr>
                        <ul class="list-inline">
                            <li class="list-inline-item" style="width: 48%; color: #002C50; font-size: 1.15rem;">
                                <strong>Room(s)</strong>
                            </li>
                            <li class="list-inline-item" style="width: 48%; text-align: right; font-size: 1rem;">
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
                                   <li class="list-inline-item" style="font-size: 1rem; width: 48%; color: #002C50;">
                                       <strong>Deposit</strong>
                                   </li>
                                   <li class="list-inline-item" style="font-size: 1rem; text-align: right; width: 48%; color: #002C50;">£50.00 </li>
                           </ul>
                             <ul class="list-inline">
                                   <li class="list-inline-item" style="font-size: 1rem; width: 48%; color: #002C50;">
                                       <small>Payable 24 hours prior</small>
                                   </li>
                                   <li class="list-inline-item" style="font-size: 1rem; text-align: right; width: 48%; color: #002C50;">£{{$booking->getPayableAmount()}} </li>
                           </ul>

                               <ul class="list-inline">
                                   <li class="list-inline-item" style="font-size: 2rem; width: 48%; color: #BEA058;"><strong>TOTAL</strong></li>
                                   <li class="list-inline-item" style="font-size: 2rem; text-align: right; width: 48%; color: #BEA058;">
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
                        <div class="row @if (!$booking->room) d-none @endif" id="next">
                            <div class="col-12">
                                <button  type="button" style="width: 100%;background-color:#bea058;color:#fff;" class="btn" onclick="onSubmit()"><h3>Next <i class="fas fa-chevron-right"></i></h3></button>
                            </div>

                            <div class="col-12 mt-2">
                                <a href="{{ route('book-a-room-index') }}" style="width: 100%;" class="btn"><i class='fas fa-chevron-left'></i> Back</a>
                            </div>
                        </div>



                 </aside>
                </div>
            </div>
        </div>
    </section>

@endsection
