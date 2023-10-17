@extends('layouts.frontend')
@push('page-title')
    Gallery
@endpush
@push('page-description')

@endpush
@push('page-keywords')

@endpush
@push('page-image')

@endpush
@section('content')
    <section class="galleryPageTop">
        {{--<img class="img-fluid mainBgImage" src="{{ Storage::url($hpcontent->hero_banner_background_image) }}" alt="Mash Tun outside image">--}}
        <img class="img-fluid mainBgImage" src="{{ asset('images/rooms-hero-image-new.png') }}">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <h1>Gallery</h1>
                        <p>
                            Take a look around The Mash Tun and the beautiful River Spey and Aberlour.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="galleryPageMain">
        <div class="container">
            <div class="row">
                @foreach($galleryCat as $cat)
                    <div class="col-lg-4 col-md-6">
                        <div class="galleryItemWrap">
                            <div class="card galleryItem">
                                <div class="card-header">
                                    <a data-lightbox="{{ $cat->name }}" href="{{ Storage::url($cat->featured_image) }}">
                                        <img class="img-fluid" src="{{ Storage::url($cat->featured_image) }}"
                                             alt="{{ $cat->name }}">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <h4>{{ $cat->name }}</h4>
                                </div>
                                <div class="imageWrapper">
                                    @foreach($galleryItem as $item)
                                        @if($item->category_id == $cat->id)
                                            <a href="{{ Storage::url($item->image) }}" data-lightbox="{{ $cat->name }}"
                                               data-title="{{ $item->name }}">
                                                <img src="{{ Storage::url($item->image) }}" alt="{{ $item->name }}">
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection
