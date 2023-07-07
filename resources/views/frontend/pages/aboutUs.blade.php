@extends('layouts.frontend')
@push('page-title')
    About Us
@endpush
@section('content')

    <section id="aboutUsPageTop" style="background: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('{{ asset('images/holding_glencairn_whiksy.webp') }}'); background-attachment: fixed; background-position: bottom center; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>About Us</h1>
                </div>
            </div>
        </div>
    </section>

    <section id="aboutPageBannerOne">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2>About The Mash Tun</h2>
                    <p>
                        Formerly known as "The Station Bar" the building was originally constructed in 1896 by James Campbell, a sea captain, who instructed a marine architect to design the building in the shape of a small ship.
                    </p>
                    <p>
                        A pledge contained in the title deeds, made in 1963 by the owner at the time states that since Dr Beeching closed the railway in Aberlour then a name change was appropriate - but that if ever a train should pull up at the station again then the pub will revert to "The Station Bar".
                    </p>
                    <p>
                        The current name comes from the whisky and brewing industry and is the large vessel or vat in which the malted barley is mixed with water and yeast.
                    </p>
                    <p>
                        Commonly these vessels are anywhere up to eight metres in diameter and up to six metres deep. In practice there are large stirrers that are mechanically driven inside a mash tun.

                    </p>
                </div>
                <div class="col-md-6">
                    <img class="img-fluid mainImg" src="{{ asset('images/outside-image.jpg') }}">
                </div>
            </div>
        </div>
    </section>
    <section id="aboutPageBannerTwo">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img class="img-fluid mainImg" src="{{ asset('images/dogs-image.webp') }}">
                </div>
                <div class="col-md-6">
                    <h2>
                        Dogs
                    </h2>
                    <p>
                        Here at The Mash Tun we are dog friendly, we welcome dogs in our grounds, Bar and Restaurant but not in our rooms.
                    </p>
                    <br> <br>
                    <h3>
                        Disabled access
                    </h3>
                    <p>
                        All of our rooms are accessed via stairs, therefore unsuitable for wheelchair access or people with mobility issues.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section id="aboutPageBannerThree">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h3>
                        The local Area
                    </h3>
                    <p>
                        We can advise guests on how to book fishing on the River Spey or shooting on nearby estates.
                    </p>
                    <p>
                        Storage for rods, cycles etc is available.  The Speyside Way, a popular walking and cycling route is only a few moments away.
                    </p>
                </div>
                <div class="col-md-6">
                    <img class="img-fluid mainImg" src="{{ asset('images/waterfalls-picture.webp') }}">
                </div>
            </div>
        </div>
    </section>
    @include('frontend.pages.partials.testimonialsBanner')
@endsection
