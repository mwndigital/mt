@extends('layouts.frontend')
@push('page-title')
    {{ $content->page_title }}
@endpush
@push('page-description')
    {{ $content->seo_description }}
@endpush
@push('page-keywords')
    {{ $content->seo_keyworkds }}
@endpush
@push('page-image')
    {{ Storage::url($content->seo_image) }}
@endpush
@push('page-styles')

@endpush
@push('page-scripts')

@endpush
@section('content')
    <section class="brPageHeroBanner" id="diningPageTop">
        <img class="img-fluid mainBgImage" src="{{ Storage::url($content->hero_background_image) }}">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <h1>
                            {{ $content->hero_title }}
                        </h1>
                        {!! $content->hero_content !!}
                        <div class="btn-group">

                            <button type="button" class="darkGoldBtn" data-bs-toggle="modal"
                                    data-bs-target="#viewDinnerMenuModal">Dinner Menu
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="brBanner brBannerOne">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="secTitle">{{ $content->banner_one_title }}</h2>
                    {!! $content->banner_one_content !!}
                </div>
                <div class="col-lg-6">
                    <img class="img-fluid featuredImage" src="{{ Storage::url($content->banner_one_image) }}">
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

    <section class="bookMealBanner"
             style="background: linear-gradient(to bottom, rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ Storage::url($content->book_banner_background_image) }}'); background-attachment: fixed; background-position: top center; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <h3 class="secTitle">{{ $content->book_banner_title }}</h3>
                    {!! $content->book_banner_content !!}
                    <button class="darkGoldBtn"
                            href="{{ $content->book_banner_button_link }}">{{ $content->book_banner_button_content }}</button>
                </div>
            </div>
        </div>
    </section>
@endsection
