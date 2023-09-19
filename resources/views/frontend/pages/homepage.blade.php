@extends('layouts.frontend')
@push('page-title')
    Mash Tun Whisky Bar &amp; Restaurant | Aberlour Moray Scotland
@endpush
@push('page-description')
    {{--{{ $rpc->page_description }}--}}
@endpush
@push('page-keywords')
    {{--{{ $rpc->page_keywords }}--}}
@endpush
@push('page-image')
    {{--{{ Storage::url($rpc->page_image) }}--}}
@endpush
@section('content')
    <section id="homepageTop">
        <img class="img-fluid mainBgImage" src="{{ Storage::url($hpcontent->hero_banner_background_image) }}" alt="Mash Tun outside image">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="inner wow slideInLeft" data-wow-duration="1.2s">
                            {{--<h1>{{ $hpcontent->hero_banner_title }}</h1>--}}
                            <h1>Welcome to <span>The Mash Tun</span></h1>
                            <h4 class="wow slideInRight" data-wow-duration="1s" data-wow-delay=".3s">in the heart of Aberlour</h4>
                            {{--<p>
                                {{ $hpcontent->hero_banner_content }}
                            </p>--}}
                            <p>
                                <strong>Riverside Inn * Iconic Whisky Bar * Whisky-Cigar Shop</strong>
                            </p>
                            <p>
                                Nestled within the banks of the River Spey, surrounded by the picturesque landscape of Aberlour.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <svg id="wave" style="transform:rotate(0deg); transition: 0.3s" viewBox="0 0 1440 140" version="1.1" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0"><stop stop-color="rgba(0, 44, 80, 1)" offset="0%"></stop><stop stop-color="rgba(0, 44, 80, 1)" offset="100%"></stop></linearGradient></defs><path style="transform:translate(0, 0px); opacity:1" fill="url(#sw-gradient-0)" d="M0,56L48,60.7C96,65,192,75,288,84C384,93,480,103,576,109.7C672,117,768,121,864,105C960,89,1056,51,1152,49C1248,47,1344,79,1440,79.3C1536,79,1632,47,1728,42C1824,37,1920,61,2016,77C2112,93,2208,103,2304,95.7C2400,89,2496,65,2592,67.7C2688,70,2784,98,2880,91C2976,84,3072,42,3168,28C3264,14,3360,28,3456,30.3C3552,33,3648,23,3744,21C3840,19,3936,23,4032,35C4128,47,4224,65,4320,60.7C4416,56,4512,28,4608,14C4704,0,4800,0,4896,14C4992,28,5088,56,5184,58.3C5280,61,5376,37,5472,23.3C5568,9,5664,5,5760,2.3C5856,0,5952,0,6048,2.3C6144,5,6240,9,6336,23.3C6432,37,6528,61,6624,58.3C6720,56,6816,28,6864,14L6912,0L6912,140L6864,140C6816,140,6720,140,6624,140C6528,140,6432,140,6336,140C6240,140,6144,140,6048,140C5952,140,5856,140,5760,140C5664,140,5568,140,5472,140C5376,140,5280,140,5184,140C5088,140,4992,140,4896,140C4800,140,4704,140,4608,140C4512,140,4416,140,4320,140C4224,140,4128,140,4032,140C3936,140,3840,140,3744,140C3648,140,3552,140,3456,140C3360,140,3264,140,3168,140C3072,140,2976,140,2880,140C2784,140,2688,140,2592,140C2496,140,2400,140,2304,140C2208,140,2112,140,2016,140C1920,140,1824,140,1728,140C1632,140,1536,140,1440,140C1344,140,1248,140,1152,140C1056,140,960,140,864,140C768,140,672,140,576,140C480,140,384,140,288,140C192,140,96,140,48,140L0,140Z"></path></svg>
    </section>
    <section id="homepageWelcomeBanner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5">
                    {{--<img class="img-fluid wow slideInLeft" data-wow-duration="1.2s" data-wow-delay=".4s" src="{{ Storage::url($hpcontent->banner_one_image) }}" alt="{{ $hpcontent->banner_one_title }} featured image">--}}
                    <img class="img-fluid wow slideInLeft" data-wow-duration="1s" data-wow-delay=".4s" src="{{ asset('images/home-banner-new-image.png') }}">
                </div>
                <div class="col-md-6 offset-md-1 wow slideInRight" data-wow-duration="1.2s" data-wow-delay=".4s">
                    {{--<h2>{{ $hpcontent->banner_one_title }}</h2>--}}
                    <h2>Nestled on the banks of the world acclaimed River Spey</h2>
                    {{--{!! $hpcontent->banner_one_content !!}--}}
                    <p>
                        The Mash Tun offers the aspirational opportunity to experience Speyside in all its wonder.. from unparalleled fly fishing, hunting to horseback riding and hiking.
                    </p>
                    <a href="{{ $hpcontent->banner_one_button_link }}" class="darkGoldBtn">
                        Find out more <i class="fa fa-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section id="homepageBannerTwo" class="homepageBanner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 wow slideInLeft">
                    <h2>Follow the whisky trail....</h2>
                    <p>
                        However it is The Whisky that motivates a pilgrimage to this considered place, surrounded by the most famous of distilleries viewed as the ultimate trip for the lover of the Uisge Beatha (water of life)
                    </p>
                </div>
                <div class="col-md-5 offset-md-1">
                    <img class="img-fluid wow slideInRight" data-wow-duration="1s" data-wow-delay=".4s" src="{{ asset('images/homepage-bar-image.png') }}">
                </div>
            </div>
        </div>
    </section>
    <section id="homepageBannerThree" class="homepageBanner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <img class="img-fluid wow slideInLeft" data-wow-duration="1s" data-wow-delay=".4s" src="{{ asset('images/homepage-banner-3-seating.png') }}">
                </div>
                <div class="col-md-6 offset-md-1 wow slideInRight">
                    <h3>
                        Enjoy our whisky themed rooms...
                    </h3>
                    <p>
                        So step into our wee world... where we can assist in all your plans... offering the finest highland hospitality, in our super comfy, whisky themed rooms, some with a beautiful view of the river.  You will find a warm welcome, comfortable refurbished accommodation, freshly prepared food and an astonishing array of whiskies including what is thought to be the worlds only complete <strong>Glenfarclas Family Collection</strong>.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section id="homepageHomeFromHomeBanner" >
        <div class="container">
            <div class="row">
                <div class="col-md-6 wow slideInLeft" data-wow-duration="1.2s">
                    <h5>{{ $hpcontent->rooms_banner_sub_title }}</h5>
                    <h3>{{ $hpcontent->rooms_banner_title }}</h3>
                    {!! $hpcontent->rooms_banner_content !!}
                    <a href="{{ $hpcontent->rooms_banner_button_link }}" class="darkGoldBtn">
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
    <section class="homepageBanner">
        <div class="container">
            <div class="row">
                <div class="col-md-5 wow slideInLeft">
                    <img class="img-fluid" src="{{ asset('images/lodge/lodge_lounge.jpg') }}">
                </div>
                <div class="col-md-6 offset-md-1 wow slideInRight">
                    <h3>
                        Peacefulness and tranquility...
                    </h3>
                    <p>
                        Our 4 bedroom lodge with a luxury log cabin feel offers sumptuous relaxing options with sun deck, views of river to leathery embrace of gathering room.  It is rented as a single rental and can accommodate 2-8 persons
                    </p>
                    <a href="" class="darkGoldBtn">
                        Find out more <i class="fa fa-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="ourRatingsBanner">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h4>Our Ratings</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="reviewItem">
                        <a href="https://www.yelp.com/biz/mash-tun-aberlour" rel="nofollow" target="_blank">
                            <img src="{{ asset('images/review-stats/yelp.png') }}" class="img-fluid">
                            <div class="content">
                                <h4>4.3</h4>
                                <h6>Yelp</h6>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="reviewItem">
                        <a href="https://www.google.com/travel/search?q=Mash%20Tun%20aberlour&g2lb=2502548%2C2503771%2C2503781%2C4258168%2C4270442%2C4284970%2C4291517%2C4597339%2C4757164%2C4814050%2C4864715%2C4874190%2C4886480%2C4893075%2C4899571%2C4899573%2C4924070%2C4965990%2C4990494%2C72298667%2C72302247%2C72313834%2C72317059%2C72321071%2C72370226&hl=en-GB&gl=uk&cs=1&ssta=1&ts=CAESABpGCigSJjIkMHg0ODg1YTQ2MzMxNmViMDk3OjB4ODg2Y2RlNzQ4NTVjOThhEhoSFAoHCOcPEAkYGBIHCOcPEAkYGRgBMgIQAA&qs=CAEyE0Nnb0lpcFBYd3ZTOHM4TUlFQUU4AkIJCYrJVUjnzYYIQgkJislVSOfNhgg&ap=ugEHcmV2aWV3cw&ictx=1&sa=X&ved=0CAAQ5JsGahcKEwjI_q3xtbSBAxUAAAAAHQAAAAAQBQ" rel="nofollow" target="_blank">
                            <img class="img-fluid" src="{{ asset('images/review-stats/google.png') }}">
                            <div class="content">
                                <h4>
                                    4.5
                                </h4>
                                <h6>
                                    Google
                                </h6>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="reviewItem">
                        <a href="https://foursquare.com/v/the-mash-tun/4c6ab4dca3932c7a12ebfdf4" rel="nofollow" target="_blank">
                            <img class="img-fluid" src="{{ asset('images/review-stats/foursquare.png') }}">
                            <div class="content">
                                <h4>8.4/10</h4>
                                <h6>FourSquare</h6>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="reviewItem">
                        <a href="https://www.facebook.com/themashtunaberlour/reviews" rel="nofollow" target="_blank">
                            <img class="img-fluid" src="{{ asset('images/review-stats/facebook.png') }}">
                            <div class="content">
                                <h4>4.4</h4>
                                <h6>Facebook</h6>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="homepageBookRoomBanner" style="background: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('{{--{{ Storage::url($hpcontent->spend_night_banner_background_image) }}--}}{{ asset('images/rooms/_DSC1684.jpg') }}'); background-attachment: fixed; background-position: top center; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4>{{ $hpcontent->spend_night_banner_title }}</h4>
                    {!! $hpcontent->spend_night_banner_content !!}
                    <a href="{{ $hpcontent->spend_night_banner_button_link }}" class="blueBtn">Book a room <i class="fa fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.pages.partials.testimonialsBanner')
@endsection
