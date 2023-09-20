@extends('layouts.frontend')
@push('page-title')
    {{--{{ $brc->page_title }}--}}
@endpush
@push('page-description')
    {{--{{ $brc->page_description }}--}}
@endpush
@push('page-keywords')
    {{--{{ $brc->page_keywords }}--}}
@endpush
@push('page-image')
    {{--{{ Storage::url($brc->page_image) }}--}}
@endpush
@push('page-styles')

@endpush
@push('page-scripts')

@endpush
@section('content')
    <section class="brPageHeroBanner">
        <img class="img-fluid mainBgImage" src="{{ asset('images/restaurant/restaurant-page-hero-banner.png') }}">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <h1>
                            Dining
                        </h1>
                        <p>
                            Dine at The Mash Tun whilst looking out over the River Spey
                        </p>
                        <div class="btn-group">

                            <button type="button" class="darkGoldBtn" data-bs-toggle="modal" data-bs-target="#viewDinnerMenuModal">Dinner Menu</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="brBanner brBannerOne">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="secTitle">This isn't just another meal, this is a Mash Tun meal</h2>
                    <p>
                        Dining at The Mash Tun can be a casual bite  at the bar or a cozy corner in our historic leather clad room to formal pre arranged meals in Lodge, even dine Alfesco on the deck overlooking the River Spey.  Wherever you dine you can be assured of the freshest local produce prepared daily by out talented chef and his team… don't forget to check our daily specials.
                    </p>
                </div>
                <div class="col-md-6">
                    <img class="img-fluid featuredImage" src="{{ asset('images/restaurant/team.png') }}">
                </div>

            </div>
        </div>
    </section>

    <section class="restaurantPageSliderBanner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="owl-carousel restaurantImageSlider">
                        <div class="item">
                            <img src="{{ asset('images/restaurant/steak-and-chips.jpeg') }}" class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="{{ asset('images/restaurant/fish.jpeg') }}" class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="{{ asset('images/restaurant/oysters.jpeg') }}" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bookMealBanner" style="background: linear-gradient(to bottom, rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('images/_DSC1570.jpg') }}'); background-attachment: fixed; background-position: top center; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <h3 class="secTitle">Book a meal with us today</h3>
                    <p>
                        Come and join us for an amazing meal.
                    </p>
                    <button class="darkGoldBtn" href="">Book Now</button>
                </div>
            </div>
        </div>
    </section>
@endsection
