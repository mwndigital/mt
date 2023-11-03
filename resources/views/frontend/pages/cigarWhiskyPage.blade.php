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
    {{ Storage::url($content->seo_iamge) }}
@endpush
@section('content')
    <section class="cigarWhiskyPageTop">
        <img class="img-fluid" src="{{ asset('images/whisky-cigar/cigar-whisky-door.jpg') }}">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1>
                            {{ $content->hero_title }}
                        </h1>
                        {!! $content->hero_content !!}
                        <div class="btn-group">
                            <button type="button" class="darkGoldBtn" data-bs-toggle="modal"
                                    data-bs-target="#viewCigarMenuModal">Cigar Menu
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cigarWhiskyBanner">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3>{{ $content->banner_one_title }}</h3>
                    {!! $content->banner_one_content !!}
                </div>
                <div class="col-md-6">
                    <img class="img-fluid" src="{{ asset('images/whisky-cigar/whisky-shelf.jpg') }}">
                </div>
            </div>
        </div>
    </section>



    <section class="cigarWhiskyBanner">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img class="img-fluid" src="{{ asset('images/whisky-cigar/sun-loungers.jpg') }}">
                </div>
                <div class="col-md-6">
                    <h2>{{ $content->banner_two_title }}</h2>
                    {!! $content->banner_two_content !!}
                </div>
            </div>
        </div>
    </section>

    <section class="cigarWhiskyBanner">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>{{ $content->banner_three_title }}</h2>
                    {!! $content->banner_three_content !!}
                </div>
                <div class="col-md-6">
                    <img class="img-fluid" src="{{ asset('images/whisky-cigar/cigar-pavilion.png') }}">
                </div>
            </div>
        </div>
    </section>
@endsection
