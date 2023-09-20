@extends('layouts.frontend')
@push('page-title')
{{ $apc->page_title }}
@endpush
@section('content')

    <section id="aboutUsPageTop" style="background: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('{{ Storage::url($apc->hero_banner_background_image) }}'); background-attachment: fixed; background-position: bottom center; background-repeat: no-repeat; background-size: cover;">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <h1>Our History</h1>
                        <p>We invite you to experience all we have to offer, including a deck perfect for drinking and dining with spectacular views of the river Spey…. or relaxing in our wood burning sauna under the trees.  We look forward to welcoming you……</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="aboutPageBannerOne">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 wow slideInLeft" data-wow-duration="1s">
                    <h2>{{ $apc->about_banner_title }}</h2>
                    {!! $apc->about_banner_content !!}
                </div>
                <div class="col-md-6 wow slideInRight" data-wow-duration="1s">
                    <img class="img-fluid mainImg" src="{{--{{ Storage::url($apc->about_banner_image) }}--}}{{ asset('images/outside-image.jpg') }}">
                </div>
            </div>
        </div>
    </section>
    <section id="aboutPageBannerTwo">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 wow slideInLeft" data-wow-duration="1s">
                    <img class="img-fluid mainImg" src="{{--{{ Storage::url($apc->banner_two_image) }}--}}{{ asset('images/waterfalls-picture.webp') }}">
                </div>
                <div class="col-md-6 wow slideInRight" data-wow-duration="1s">
                    <h3>
                        {{ $apc->banner_two_title }}
                    </h3>
                    <p>
                        We can advise guests on how to book fishing on the River Spey or shooting on the nearby estates.  Storage for rods, cycles etc is available.
                    </p>
                    <p>
                        The Speyside Way, a popular walking and cycling route is only a few moments away.
                    </p>
                    <p>
                        Around the local area you will find the world renowned Walkers Shortbread bakery, as well as the Aberlour Distillery, both well worth a visit.  Many of the local distilleries have visitors centres and shops and offer tours where you can sample some of Scotlands finest whisky.  For the more adventurous among you, there is plenty of sport to be had, such as Clay Pigeon Shooting, horse back riding and canoeing, as well as skiing and snowboarding on the cairngorms.
                    </p>
                    <p>
                        For those looking to take a more gentle meander, there is plenty of sight seeing to be had, visit the Craigllachie Bridge, constructed in 1814 or take a visit to Knockando Woolmill. No visit to Scotland would be complete without a stop off at a castle, and there are plenty around to visit, Ballindalloch Castle from the sixteenth century is certainly a sight to behold.
                    </p>
                    <p>
                        Don't forget to take a walk around Aberlour as the streets are adorned with local cafes, bakeries, arts, crafts and gift shops.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section id="aboutPageBannerThree">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3>Under new ownership 2022</h3>
                    <p>
                        The Mash Tun was bought in 2022 by Ron Morrison and Mitchell Orchant and is operated by their company C.Gars Ltd.
                    </p>
                    <p>
                        The premises have been completely refurbished to the highest standards.  The restaurant menus have been revamped and we have a bigger and better whisky selection than ever!
                    </p>
                    <p>
                        C.Gars Ltd owns and operates specialist whisky and cigar shops across the UK as well as Puffin Rooms in Edinburgh and Liverpool.
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="owl-carousel historypageBannerSlider">
                        <div class="item">
                            <img class="img-fluid" src="{{ asset('images/history/ron-mitchell-1.png') }}">
                        </div>
                        <div class="item">
                            <img class="img-fluid" src="{{ asset('images/history/ron-mitchell-2.png') }}">
                        </div>
                        <div class="item">
                            <img class="img-fluid" src="{{ asset('images/mitchell-and-karyn-outside-mash-tun.png') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('frontend.pages.partials.testimonialsBanner')
@endsection
