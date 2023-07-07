@extends('layouts.frontend')
@push('page-title')
    The Rooms
@endpush
@section('content')
    <section id="roomsPageTop" style="background: url('{{ asset('images/bed-with-flowers-image.webp') }}'); background-attachment: fixed; background-position: top center; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Our Rooms</h1>

                </div>
            </div>
        </div>
    </section>
    <section id="roomsPageInfoBanner">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <p>
                        We have 5 chic en-suite bedrooms, named after local distilleries.  A roll top bath enhances The Glenlivet Room, and most rooms enjoy glorious views over the River Spey.  The Macallan Room, which follows the curve of the building, looks towards Easter Elchies House - the original home of The Macallan Malt Whisky.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="roomsPageRoomsBanner">
        <div class="container">
            <div class="row">
                @foreach($rooms as $room)
                    <div class="col-lg-4 col-md-6">
                        <div class="roomItem card">
                            <div class="card-header">
                                <img class="img-fluid" src="{{ Storage::url($room->featured_image) }}">
                            </div>
                            <div class="card-body">
                                <h4>{{ $room->name }}</h4>
                                <div class="content">
                                    {!! $room->short_description !!}
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="" class="blueBtn">Book Now</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
