@extends('layouts.admin')
@push('page-title')
    Admin - Create booking step two
@endpush
@push('page-scripts')

@endpush
@push('page-styles')
    <style>
        .pageMain .bookingFormWrap .stepBanner .innerWrap span {
            width: 50%;
        }
    </style>
@endpush
@section('content')
    <section class="pageHero">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1>
                        Create booking - step two
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

    <section class="pageMain">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="bookingFormWrap">
                        <h4 class="stepTitle">Choose rooms</h4>
                        <div class="stepBanner">
                            <div class="innerWrap">
                                <span>Step 2</span>
                            </div>
                        </div>
                        <form method="post" action="{{ route('admin.book-a-room-step-two-store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="row innerRow">
                                        @foreach($filteredRooms as $room)
                                            <div class="col-md-6">
                                                <label class="checkItem">
                                                    <input type="checkbox" name="room_id[]" id="room_{{ $room->id }}"
                                                           value="{{ $room->id }}"
                                                           @if($booking && $booking->room_id == $room->id) checked @endif>
                                                    <label for="room_{{ $room->id }}">
                                                        <img class="img-fluid"
                                                             src="{{ Storage::url($room->featured_image) }}">
                                                        <h4>{{ $room->name }}</h4>
                                                    </label>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="row align-items-center mt-4">
                                <div class="col-md-6">
                                    <a href="/admin/bookings/create" class="backBtn"><i class='fas fa-chevron-left'></i>
                                        Back</a>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <button type="submit" class="nextBtn">Next <i class="fas fa-chevron-right"></i>
                                    </button>
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
