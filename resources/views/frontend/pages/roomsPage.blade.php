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
@push('page-scripts')
    <script>
            $(document).ready(function () {
            $('.owl-carousel').owlCarousel({
                loop: false,
                margin: 0,
                nav: true,
                dots: true,
                autoplay: false,
                // Right and left arrow with icon
                navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
                responsive: {
                    0: {
                        items: 1
                    }
                }
            });
        });
    </script>
@endpush
@push('page-styles')
    <style>
        .owl-nav {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
            padding: 0 15px;
            color: #fff;
            font-size: 1.2rem;
            background: transparent;
        }

        .owl-dots {
            position: absolute;
            bottom: 0px;
            width: 100%;
            display: flex;
            justify-content: center;
            transform: translateY(-50%);
        }
    </style>

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
            <div class="row g-5">
                @foreach($rooms as $room)
                    <div class="col-lg-6 col-md-6">
                        <div class="roomItem card">
                            <a href="{{ route('select-room',$room->id)}}"><h4 class="d-flex justify-content-center">{{ $room->name }}</h4></a>
                            <div class="owl-carousel owl-theme">
                                <div class="item">
                                    <img class="img-fluid" src="{{ Storage::url($room->featured_image) }}" >
                                </div>
                                @foreach($room->images as $image)
                                    <div class="item justify-content-center">
                                        <img class="img-fluid" src="{{ Storage::url($image->image) }}" >
                                    </div>
                                @endforeach
                            </div>
                            <div class="card-body">
                                <div class="content">
                                    {!! $room->short_description !!}
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('select-room',$room->id)}}" class="blueBtn">Book Now <i class="fas fa-bolt"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
