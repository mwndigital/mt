@extends('layouts.frontend')
@push('page-title')
Mash Tun Whisky Bar &amp; Restaurant | Aberlour Moray Scotland
@endpush
@section('content')
    <section id="homepageTop">
        <img class="img-fluid mainBgImage" src="{{ asset('images/outside-image-2.jpg') }}" alt="Mash Tun outside image">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="inner wow slideInLeft" data-wow-duration="1.2s">
                            <h1>Welcome to The Mash Tun</h1>
                            <p>
                                Our bar is now open with an interim menu.  During our renovations, we offer a changing freshly prepared menu.  Please check the bar daily.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="homepageWelcomeBanner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <img class="img-fluid wow slideInLeft" data-wow-duration="1.2s" data-wow-delay=".4s" src="{{ asset('images/holding-whisky-glass.webp') }}" alt="Hand holding whisky glass image">
                </div>
                <div class="col-md-6 offset-md-1 wow slideInRight" data-wow-duration="1.2s" data-wow-delay=".4s">
                    <h2>In the heart of Scotland's Malt Whisky Country</h2>
                    <p>
                        We have a passion for food and whisky which is reflected in the locally sourced ingredients for our menu and our enviable selection of malts.
                    </p>
                    <p>
                        As private guests in the seperate accomodation, you are welcome to eat or enjoy a dram in The Mash Tun Whisky Bar, where breakfast, lunch and dinner is available.
                    </p>
                    <a href="" class="darkGoldBtn">
                        Find out more <i class="fa fa-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section id="homepageHomeFromHomeBanner">
        <div class="container">
            <div class="row">
                <div class="col-md-6 wow slideInLeft" data-wow-duration="1.2s">
                    <h5>staying at the Mash Tun</h5>
                    <h2>A home from home...</h2>
                    <p>
                        We have 5 chic en-suite bedrooms, named after local distilleries.  A roll top bath enhances Then Glenlivet Room, and most rooms enjoy spectacular views.  The Macallan Room, which follows the curve of the building, looks towards Easter Elchies House - the original home of The Macallan Malt Whisky.
                    </p>
                    <a href="" class="darkGoldBtn">
                        Find out more <i class="fa fa-chevron-right"></i>
                    </a>
                </div>
                <div class="col-md-6 wow slideInRight" data-wow-duration="1.2s">
                    <div class="owl-carousel homeFromHomeSlider">
                        @foreach($rooms as $room)
                            <div class="item">
                                <div class="card">
                                    <div class="card-header">
                                        <img class="img-fluid slideImage" src="{{ Storage::url($room->featured_image) }}">
                                    </div>
                                    <div class="card-body">
                                        <h3>{{ $room->name }}</h3>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="homepageBookRoomBanner" style="background: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('{{ asset('images/book-room-banner-bg.jpg') }}'); background-attachment: fixed; background-position: top center; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4>Spend a night with us</h4>
                    <p>
                        When you book a room you won't be charged until you check out.
                    </p>
                    <a href="" class="blueBtn">Book a room <i class="fa fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </section>
    @include('frontend.pages.partials.testimonialsBanner')
@endsection
