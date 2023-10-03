@extends('layouts.frontend')
@push('page-title')
    Lodge
    {{--{{ $brc->page_title }}--}}
@endpush
@push('page-description')
    {{--{{ $brc->page_description }}--}}
@endpush
@push('page-keywords')
    {{--{{ $brc->page_keywords }}--}}
@endpush
@push('page-image')
    {{--{{ Storage::url($brc->page_image) }}--}}
@endpush
@push('page-styles')

@endpush
@push('page-scripts')

@endpush
@section('content')
    <section class="lodgePageHero">
        <img class="img-fluid mainBgImage" src="{{ asset('images/lodge/_DSC1555.jpg') }}">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <h1>Stalla Dhu Lodge</h1>
                        <p>
                            Our 4 bedroom lodge with a luxury log cabin feel offers sumptuous relaxing options with sun deck, views of river to leathery embrace of gathering room. It is rented as a single rental and can accommodate 2-8 persons.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="lodgeBanner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <h2 class="secTitle">
                        Indulge in a little piece of heaven...
                    </h2>
                    <p>
                        The Stalla Dhu Lodge at the Mash Tun presents an inspiring getaway in the heart of Speyside with four luxury bedrooms, four bathrooms and a private first floor terrace, it can accommodate 2 to 8 persons.
                    </p>
                    <p>
                        You would be forgiven if you felt you were in The Rocky Mountains as it’s cozy, warm wood finishes meander thru the property with room names like Outlook and Hideout enhancing the welcome you will no doubt feel.
                    </p>
                    <a class="darkGoldBtn mb-2" href="{{ route('book-a-room-index',['type'=>'lodge']) }}">Book Now</a>

                </div>
                <div class="col-lg-6">
                    <div class="owl-carousel lodgePageImageSlider">
                        <div class="item">
                            <img class="img-fluid" src="{{ asset('images/lodge/_DSC1547.jpg') }}">
                        </div>
                        <div class="item">
                            <img class="img-fluid" src="{{ asset('images/lodge/lodge_lounge.jpg') }}">
                        </div>
                        <div class="item">
                            <img class="img-fluid" src="{{ asset('images/lodge/_DSC1542.jpg') }}">
                        </div>
                        <div class="item">
                            <img class="img-fluid" src="{{ asset('images/lodge/_DSC1557.jpg') }}">
                        </div>
                        <div class="item">
                            <img class="img-fluid" src="{{ asset('images/lodge/_DSC1521.jpg') }}">
                        </div>
                        <div class="item">
                            <img class="img-fluid" src="{{ asset('images/lodge/_DSC1529.jpg') }}">
                        </div>
                        <div class="item">
                            <img class="img-fluid" src="{{ asset('images/lodge/_DSC1534.jpg') }}">
                        </div>
                        <div class="item">
                            <img class="img-fluid" src="{{ asset('images/lodge/_DSC1555.jpg') }}">
                        </div>
                        <div class="item">
                            <img class="img-fluid" src="{{ asset('images/lodge/lodge-image-3.png') }}">
                        </div>
                        <div class="item"><img src="{{ asset('images/lodge/IMG_7067.jpeg') }}" alt="" class="img-fluid"></div>
                        <div class="item"><img src="{{ asset('images/lodge/IMG_7105.jpeg') }}" alt="" class="img-fluid"></div>
                        <div class="item"><img src="{{ asset('images/lodge/IMG_7103.jpeg') }}" alt="" class="img-fluid"></div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="lodgeBanner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <img class="img-fluid featuredImage" src="{{ asset('images/lodge/group-photo.png') }}">
                </div>
                <div class="col-lg-6">
                    <h2 class="secTitle">
                        Relax after a day of adventure...
                    </h2>
                    <p>
                        Slipper bath tubs enhance some of the rooms for that real prairie feeling.
                    </p>
                    <p>
                        The Gathering Room with its rich leather furniture ,fireplace and dining tables will be your relaxing space after a day of Speyside adventure... private dining can all be arranged as can inspiring whisky tastings .
                    </p>

                </div>
            </div>
        </div>
    </section>
    <section class="lodgeBanner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h3 class="secTitle">
                        Take a visit to our nurturing wood burning sauna....
                    </h3>
                    <p>
                        We invite you to experience all we have to offer from a relaxing drink and dine deck with a river view... or nurturing a wood burning sauna under the trees... we are at your service.
                    </p>
                    <p>
                        Stalla Dhu Lodge has a reserved parking spot and full use of the wood burning Sauna.
                    </p>
                    <p>
                        Plan soon for an adventure within an adventure...
                    </p>

                </div>
                <div class="col-lg-6">
                    <img class="img-fluid featuredImage" src="{{ asset('images/lodge/IMG_7103.jpeg') }}">
                </div>
            </div>
        </div>
    </section>
@endsection
