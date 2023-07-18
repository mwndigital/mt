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
                    <div class="col-lg-8">
                        <div class="inner wow slideInLeft" data-wow-duration="1.2s">
                            <h1>{{ $hpcontent->hero_banner_title }}</h1>
                            <p>
                                {{ $hpcontent->hero_banner_content }}
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
                    <img class="img-fluid wow slideInLeft" data-wow-duration="1.2s" data-wow-delay=".4s" src="{{ Storage::url($hpcontent->banner_one_image) }}" alt="{{ $hpcontent->banner_one_title }} featured image">
                </div>
                <div class="col-md-6 offset-md-1 wow slideInRight" data-wow-duration="1.2s" data-wow-delay=".4s">
                    <h2>{{ $hpcontent->banner_one_title }}</h2>
                    {!! $hpcontent->banner_one_content !!}
                    <a href="{{ $hpcontent->banner_one_button_link }}" class="darkGoldBtn">
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
                    <h5>{{ $hpcontent->rooms_banner_sub_title }}</h5>
                    <h2>{{ $hpcontent->rooms_banner_title }}</h2>
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
    <section id="homepageBookRoomBanner" style="background: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('{{ Storage::url($hpcontent->spend_night_banner_background_image) }}'); background-attachment: fixed; background-position: top center; background-repeat: no-repeat; background-size: cover;">
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
