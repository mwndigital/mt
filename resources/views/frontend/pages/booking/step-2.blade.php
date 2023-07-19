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

    <section class="bookingPageMain">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="formWrap">
                        <div class="stepBanner">
                            <div></div>

                        </div>
                        <form method="post" action="{{ route('book-a-room-step-2-store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Choose a room</label>
                                    <div class="row innerRow">
                                        @foreach($rooms as $room)
                                            <div class="col-md-6">
                                                <label class="checkItem">
                                                    <input type="radio" name="selected_room" id="room_{{ $room->id }}">
                                                    <label for="room_{{ $room->id }}">
                                                        <img class="img-fluid" src="{{ Storage::url($room->featured_image) }}">
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
