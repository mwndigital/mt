@extends('layouts.frontend')
@push('page-title')
{{ $apc->page_title }}
@endpush
@section('content')

    <section id="aboutUsPageTop" style="background: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('{{ Storage::url($apc->hero_banner_background_image) }}'); background-attachment: fixed; background-position: bottom center; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>{{ $apc->hero_banner_title }}</h1>
                </div>
            </div>
        </div>
    </section>

    <section id="aboutPageBannerOne">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2>{{ $apc->about_banner_title }}</h2>
                    {!! $apc->about_banner_content !!}
                </div>
                <div class="col-md-6">
                    <img class="img-fluid mainImg" src="{{ Storage::url($apc->about_banner_image) }}">
                </div>
            </div>
        </div>
    </section>
    <section id="aboutPageBannerTwo">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img class="img-fluid mainImg" src="{{ Storage::url($apc->banner_one_image) }}">
                </div>
                <div class="col-md-6">
                    {!! $apc->banner_one_content !!}
                </div>
            </div>
        </div>
    </section>
    <section id="aboutPageBannerThree">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h3>
                        {{ $apc->banner_two_title }}
                    </h3>
                    {!! $apc->banner_two_content !!}
                </div>
                <div class="col-md-6">
                    <img class="img-fluid mainImg" src="{{ Storage::url($apc->banner_two_image) }}">
                </div>
            </div>
        </div>
    </section>
    @include('frontend.pages.partials.testimonialsBanner')
@endsection
