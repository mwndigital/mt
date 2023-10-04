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
@section('content')
    <section id="roomsPageTop">
        <img src="{{ Storage::url($content->hero_banner_background_image) }}" alt="" class="mainBgImage">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h1>{{ $content->hero_banner_title }}</h1>

                        {!! $content->hero_content !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="roomsPageRoomsBanner">
        <div class="container">
            <div class="row">
                @foreach($rooms as $room)
                    <div class="col-lg-4 col-md-6">
                        <div class="roomItem card">
                            <div class="card-header">
                                 <div class="owl-carousel lodgePageImageSlider">
                                    <div class="item">
                                        <img class="img-fluid" src="{{ Storage::url($room->featured_image) }}">
                                    </div>
                                    @foreach($room->images as $image)
                                        <div class="item">
                                            <img class="img-fluid" src="{{ Storage::url($image->image) }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="card-body">
                                <h4>{{ $room->name }}</h4>
                                <div class="content">
                                    {!! $room->short_description !!}
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('select-room',$room->id)}}" class="blueBtn">Book Now</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
