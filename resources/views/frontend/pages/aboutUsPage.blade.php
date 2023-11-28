@extends('layouts.frontend')
@push('page-title')
    About Us
@endpush
@section('content')
    <section id="aboutPageTopNew">
        <img class="img-fluid " src="{{ asset('images/outside-image-2.jpg') }}">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <h1>About Us</h1>
                        <p>
                            Discover the Enchantment of The Mash Tun, Aberlour's Premier Whisky Bar & Riverside Inn.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="aboutPageMainBannerOne">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>Immerse yourself in the heart of Speyside.</h2>
                    <p>
                        Aberlour, Scotland - The Mash Tun, Aberlour's iconic riverside inn and whisky bar, invites you to immerse yourself in the heart of Speyside, Scotland's Whisky Country.  Under the experienced stewardship of C.Gars Ltd, owned by Ron Morrison and Mitchell orchant since 2022, this historic establishment has been transformed into a beacon of Scottish hospitality, marrying tradition with contemporary luxury.
                    </p>

                </div>
                <div class="col-md-6">
                    <img class="img-fluid mainImg" src="{{ asset('images/homepage-image-one.png') }}">
                </div>
            </div>
        </div>
    </section>

    <section id="aboutPageMainBannerTwo">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img class="img-fluid mainImg" src="{{ asset('images/outside-image-2.jpg') }}">
                </div>
                <div class="col-md-6">
                    <h2>A historic Gem with Modern Elegance</h2>
                    <p>
                        The Mash Tun, originally constructed in 1896 and known for its unique maritime-inspired architecture, has been meticulously refurbished.  This revamp honors its storied past while providing guests with modern comfort and sophistication.  The inn's charming whisky-themed rooms, each named after local distilleries, offer spectacular views of the River Spey and the lush Speyside landscape.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="aboutPageMainBannerThree">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <h3>Culinary Delights with a Local Twist</h3>
                    <p>
                        The Mash Tun's dining experience is a celebration of Scotland's rich culinary heritage.  Our Menu, crafted by skilled chefs, features the finest local produce, ranging from casual bar bits to exquisite meals in the intimate Stall Dhu Lodge,  Dining al fresco on the deck overlooking the river offers a truly memorable experience.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="aboutPageMainBannerFour">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3>A Whisky Lover's Paradise</h3>
                    <p>
                        As a centerpiece of the renowned Speyside whisky region, The Mash Tun boasts an unparalleled selection of fine whiskies, including the exclusive Glenfarclas Family Collection.  Our knowledgeable staff are on hand to guide guests through a journey of whisky discovery, making every visit a unique adventure.
                    </p>
                </div>
                <div class="col-md-6">
                    <img class='img-fluid mainImg' src="{{ asset('images/homepage-bar-image.png') }}">
                </div>
            </div>
        </div>
    </section>
    <section id="aboutPageMainBannerFive">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img class="img-fluid mainImg" src="{{ asset('images/whisky-cigar/cigars.jpg') }}">
                </div>
                <div class="col-md-6">
                    <h3>The Whisky and Cigar Shop</h3>
                    <p>
                        Adding to the allure, The Mash Tun features a specialised whisky and cigar shop, offering a curated selection of premium whiskies and fine cigars.  This unique shop provides aficionados and novices alike an opportunity to explore and purchase some of the finest products Scotland and the world have to offer.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section id="aboutPageMainBannerSix">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h4>The Pavilion - A Venue of Elegance</h4>
                    <p>
                        The Pavilion at The Mash Tun, a newly introduced featured, serves as an exquisite venue for private events and gatherings.  Overlooking the serene River Spey, The Pavilion offers an elegant space, perfect for weddings, corporate events, or special celebrations, all set against the breathtaking backdrop of the Speyside landscape.
                    </p>
                </div>
                <div class="col-md-6">
                    <img class="img-fluid mainImg" src="{{ asset('images/whisky-cigar/cigar-pavilion.png') }}">
                </div>
            </div>
        </div>
    </section>

    <section id="aboutPageMainBannerSeven">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <h4>Exploring Speyside's Wonders</h4>
                    <p>
                        Located within the easy reach of famous distilleries, the Aberlour Distillery, and the Walkers Shortbread bakery, The Mash Tun is the perfect base for exploring all that Speyside has to offer.  Outdoor enthusiasts will find abundant activities, from fly fishing on the River Spey to hiking the Speyside way.  The area is also rich in history and culture, with numerous castles and heritage sites to explore.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="aboutPageMainBannerEight">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img class="img-fluid mainImg" src="{{ asset('images/mitchell-and-karyn-outside-mash-tun.png') }}">
                </div>
                <div class="col-md-6">
                    <h4>A call to travel editors and enthusiasts</h4>
                    <p>
                        We invite travel editors and enthusiasts to experience the magic of The Mash Tun.  Whether you're seeing a relaxing getaway, an adventure in the great outdoors, or a deep dive into Scotland's whisky culture, The Mash Tun offers an experience that embodies the spirit of Speyside.
                    </p>
                </div>
            </div>
        </div>
    </section>

@endsection
