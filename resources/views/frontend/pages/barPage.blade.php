@extends('layouts.frontend')
@push('page-title')
    {{ $content->page_title }}
@endpush
@push('page-description')
    {{ $content->seo_description }}
@endpush
@push('page-keywords')
    {{ $content->seo_keywords }}
@endpush
@push('page-image')
    {{ Storage::url($content->seo_image) }}
@endpush
@push('page-styles')

@endpush
@push('page-scripts')

@endpush
@section('content')
    <section class="brPageHeroBanner">
        <img class="img-fluid mainBgImage" src="{{ Storage::url($content->hero_banner_background_image) }}">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h1>{{ $content->hero_title }}</h1>
                        {!! $content->hero_content !!}
                        <div class="btn-group">s
                            <button type="button" class="darkGoldBtn" data-bs-toggle="modal" data-bs-target="#viewWineMenuModal">Wine List</button>
                            <button type="button" class="blueBtn" data-bs-toggle="modal" data-bs-target="#viewWhiskyMenuModal">Whisky Flights Menu</button>
                            <button type="button" class="darkGoldBtn" data-bs-toggle="modal" data-bs-target="#viewCocktailsMenuModal">Cocktails List</button>
                            <button type="button" class="blueBtn" data-bs-toggle="modal" data-bs-target="#viewWhiskySpiritsMenuModal">Whisky & Spirits Menu</button>
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
                    <button type='button' class="blueBtn" data-bs-toggle="modal" data-bs-target="#viewWhiskyMenuModal">Whisky Menu</button>
                </div>
                <div class="col-lg-6">
                    <img class="img-fluid featuredImage" src="{{ Storage::url($content->banner_one_image) }}">
                </div>
            </div>
        </div>
    </section>

    <section class="brBanner brBannerOne">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <img class="img-fluid featuredImage" src="{{ Storage::url($content->banner_two_image) }}">
                </div>
                <div class="col-lg-6">
                    <h2 class="secTitle">{{ $content->banner_two_title }}</h2>
                    {!! $content->banner_two_content !!}
                    <button type='button' class="blueBtn" data-bs-toggle="modal" data-bs-target="#viewWineMenuModal">Wine Menu</button>
                </div>
            </div>
        </div>
    </section>

    <section class="brBanner brBannerOne">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="secTitle">{{ $content->banner_three_title }}</h2>
                    {!! $content->banner_three_content !!}
                    <button type='button' class="blueBtn" data-bs-toggle="modal" data-bs-target="#viewCocktailsMenuModal">Cocktails Menu</button>
                </div>
                <div class="col-lg-6">
                    <img class="img-fluid featuredImage" src="{{ Storage::url($content->banner_three_image) }}">
                </div>
            </div>
        </div>
    </section>

    <section class="makeBookingBanner" style="background: linear-gradient(to bottom, rgba(0,0,0, 0.4), rgba(0,0,0,0.4)), url('{{ Storage::url($content->book_banner_background_image) }}'); background-attachment: fixed; background-position: bottom center; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>{{ $content->book_banner_title }}</h2>
                    {!! $content->book_banner_content !!}
                    <a href="{{ $content->book_banner_button_link }}" class="darkGoldBtn">
                        {{ $content->book_banner_button_content }}
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection
