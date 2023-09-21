@extends('layouts.frontend')
@push('page-title')
    {{ $rpc->page_title }}
@endpush
@push('page-description')
    {{ $rpc->page_description }}
@endpush
@push('page-keywords')
    {{ $rpc->page_keywords }}
@endpush
@push('page-image')
    {{ Storage::url($rpc->page_image) }}
@endpush
@section('content')
    <section id="roomsPageTop">
        <img src="{{ Storage::url($rpc->hero_banner_background_image) }}" alt="" class="mainBgImage">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h1>{{ $rpc->hero_banner_title }}</h1>
                        <p>
                            We have 5 chic en-suite bedrooms, named after local distilleries. A roll top bath enhances The Glenlivet Room, and most rooms enjoy glorious views over the River Spey. The Macallan Room, which follows the curve of the building, looks towards Easter Elchies House - the original home of The Macallan Malt Whisky.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--<section id="roomsPageInfoBanner">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    {!! $rpc->rooms_info_banner_content !!}
                </div>
            </div>
        </div>
    </section>--}}

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
    <section id="roomsPageLodgeBanner">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h2>Our Lodge</h2>
                    <p>
                        Our 4 bedroom lodge with a luxury log cabin feel offers sumptuous relaxing options with sun deck, views of river to leathery embrace of gathering room. It is rented as a single rental and can accommodate 2-8 persons.
                    </p>
                    <a href="" class="darkGoldBtn">
                        Find out more <i class="fa fa-chevron-right"></i>
                    </a>
                </div>
                <div class="col-md-5">
                    <div class="owl-carousel roomsPageLodgeSlider">
                        <div class="item">
                            <img src="{{ asset('images/lodge/_DSC1555.jpg') }}" alt="" class="sliderImage">
                        </div>
                        <div class="item">
                            <img src="{{ asset('images/lodge/_DSC1557.jpg') }}" alt="" class="sliderImage">
                        </div>
                        <div class="item">
                            <img src="{{ asset('images/lodge/lodge_lounge.jpg') }}" alt="" class="sliderImage">
                        </div>
                        <div class="item">
                            <img src="{{ asset('images/lodge/_DSC1550.jpg') }}" alt="" class="sliderImage">
                        </div>
                        <div class="item">
                            <img src="{{ asset('images/lodge/_DSC1542.jpg') }}" alt="" class="sliderImage">
                        </div>
                        <div class="item">
                            <img src="{{ asset('images/lodge/_DSC1521.jpg') }}" alt="" class="sliderImage">
                        </div>
                        <div class="item">
                            <img src="{{ asset('images/lodge/_DSC1534.jpg') }}" alt="" class="sliderImage">
                        </div>
                        <div class="item">
                            <img src="{{ asset('images/lodge/_DSC1529.jpg') }}" alt="" class="sliderImage">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
