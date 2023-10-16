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

<!-- Owl carousel-->
$(document).ready(function () {
    $('.owl-carousel').owlCarousel({
        loop: false,
        margin: 0,
        nav: true,
        dots: false,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
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
}

.owl-prev,
.owl-next {
    background-color: #fff; /* Adjust the background color as needed */
    border: none;
    font-size: 24px;
    cursor: pointer;
}

.owl-prev {
    order: 1;
}

.owl-next {
    order: 2;
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
            <div class="row">
                @foreach($rooms as $room)
                    <div class="col-lg-4 col-md-6">
                        <div class="roomItem card">
                                 <div class="owl-carousel owl-theme">
                                    <div class="item">
                                        <img class="img-fluid" src="{{ Storage::url($room->featured_image) }}" style="height: 238px;">
                                    </div>
                                    @foreach($room->images as $image)
                                        <div class="item">
                                            <img class="img-fluid" src="{{ Storage::url($image->image) }}" style="height: 238px;">
                                        </div>
                                    @endforeach
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
