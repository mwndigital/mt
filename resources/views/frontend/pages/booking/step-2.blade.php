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
    </script>
@endpush
@push('page-styles')

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
                        <form method="post" action="{{ route('book-a-room-step-2-store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="row innerRow">
                                        @foreach($filteredRooms as $room)
                                            <div class="col-md-6">
                                                <label class="checkItem">
                                                    <input type="radio" name="room_id" id="room_{{ $room->id }}" value="{{ $room->id }}" @if($booking && $booking->room_id == $room->id) checked @endif>
                                                    <label for="room_{{ $room->id }}">
                                                        <img class="img-fluid" src="{{ Storage::url($room->featured_image) }}">
                                                        <div class="content">
                                                            <h4>{{ $room->name }}</h4>
                                                            <h6 class="price">
                                                                Price from: £{{ $room->price_per_night_single }}
                                                            </h6>
                                                            {!! $room->short_description !!}
                                                        </div>
                                                    </label>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
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
                            <li class="list-inline-item">
                                <strong>To</strong><br>
                                {{ date('d/m/Y', strtotime($booking->checkout_date )) }}
                            </li>
                        </ul>
                        <hr>
                        <ul class="list-inline adultChildCap">
                            <li class="list-inline-item">
                                <strong>No of adults</strong><br>
                                {{ $booking->no_of_adults }}
                            </li>
                            <li class="list-inline-item">
                                <strong>No of children</strong><br>
                                {{ $booking->no_of_children }}
                            </li>
                        </ul>
                        <hr>
                    </aside>
                </div>
            </div>
        </div>
    </section>

@endsection
