@extends('layouts.frontend')
@push('page-title')
    About Us
@endpush
@section('content')
    <section id="aboutPageTopNew">
        <img class="img-fluid " src="{{ Storage::url($content->hero_bg_image) }}">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <h1>{{ $content->hero_title }}</h1>
                        {!! $content->hero_content !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="aboutPageMainBannerOne">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>{{ $content->banner_one_title }}</h2>
                    {!! $content->banner_one_content !!}

                </div>
                <div class="col-md-6">
                    <img class="img-fluid mainImg" src="{{ Storage::url($content->banner_one_image) }}">
                </div>
            </div>
        </div>
    </section>

    <section id="aboutPageMainBannerTwo">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img class="img-fluid mainImg" src="{{ Storage::url($content->banner_two_image) }}">
                </div>
                <div class="col-md-6">
                    <h2>{{ $content->banner_two_title }}</h2>
                    {!! $content->banner_two_content !!}
                </div>
            </div>
        </div>
    </section>

    <section id="aboutPageMainBannerThree">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <h3>{{ $content->banner_three_title }}</h3>
                    {!! $content->banner_three_content !!}
                </div>
            </div>
        </div>
    </section>

    <section id="aboutPageMainBannerFour">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3>{{ $content->banner_four_title }}</h3>
                    {!! $content->banner_four_content !!}
                </div>
                <div class="col-md-6">
                    <img class='img-fluid mainImg' src="{{ Storage::url($content->banner_four_image) }}">
                </div>
            </div>
        </div>
    </section>
    <section id="aboutPageMainBannerFive">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img class="img-fluid mainImg" src="{{ Storage::url($content->banner_five_image) }}">
                </div>
                <div class="col-md-6">
                    <h3>{{ $content->banner_five_title }}</h3>
                    {!! $content->banner_five_content !!}
                </div>
            </div>
        </div>
    </section>
    <section id="aboutPageMainBannerSix">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h4>{{ $content->banner_six_title }}</h4>
                    {!! $content->banner_six_content !!}
                </div>
                <div class="col-md-6">
                    <img class="img-fluid mainImg" src="{{ Storage::url($content->banner_six_image) }}">
                </div>
            </div>
        </div>
    </section>

    <section id="aboutPageMainBannerSeven">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <h4>{{ $content->banner_seven_title }}</h4>
                    {!! $content->banner_seven_content !!}
                </div>
            </div>
        </div>
    </section>

    <section id="aboutPageMainBannerEight">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img class="img-fluid mainImg" src="{{ Storage::url($content->banner_eight_image) }}">
                </div>
                <div class="col-md-6">
                    <h4>{{ $content->banner_eight_title }}</h4>
                    {!! $content->banner_eight_content !!}
                </div>
            </div>
        </div>
    </section>

@endsection
