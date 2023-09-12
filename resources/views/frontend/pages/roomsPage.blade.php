@extends('layouts.frontend')
@push('page-title')
    {{ $rpc->page_title }}
@endpush
@push('page-description')
    {{ $rpc->page_description }}
@endpush
@push('page-keywords')
    {{ $rpc->page_keywords }}
@endpush
@push('page-image')
    {{ Storage::url($rpc->page_image) }}
@endpush
@section('content')
    <section id="roomsPageTop">
        <img src="{{ Storage::url($rpc->hero_banner_background_image) }}" alt="" class="mainBgImage">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1>{{ $rpc->hero_banner_title }}</h1>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="roomsPageInfoBanner">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    {!! $rpc->rooms_info_banner_content !!}
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
                                <img class="img-fluid" src="{{ Storage::url($room->featured_image) }}">
                            </div>
                            <div class="card-body">
                                <h4>{{ $room->name }}</h4>
                                <div class="content">
                                    {!! $room->short_description !!}
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="" class="blueBtn">Book Now</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
