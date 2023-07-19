@extends('layouts.frontend')
@push('page-title')
    Book a room - Step 1 | Aberlour Moray Scotland
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
                        <div class="stepBanner">
                            <div></div>
                        </div>
                        <form method="post" action="{{ route('book-a-room-step-1-store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Choose a room</label>
                                    <select name="room" id="room" required>
                                        @foreach($rooms as $room)
                                            <option value="{{ $room->id }}" @if($booking && $booking->room == $room->id) selected @endif>
                                                <div class="roomSelectInner">
                                                    <img class="img-fluid" src="{{ Storage::url($room->featured_image) }}">
                                                    <span>{{ $room->name }}</span>
                                                </div>
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Check in date</label>
                                    <input type="date" name="checkin_date" id="checkin_date" value="{{ $booking ? $booking->checkin_date : '' }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Check out date</label>
                                    <input type="date" name="checkout_date" id="checkout_date" value="{{ $booking ? $booking->checkout_date : '' }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Arrival Time</label>
                                    <input type="time" name="arrival_time" id="arrival_time" value="{{ $booking ? $booking->arrival_time : '' }}">
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
