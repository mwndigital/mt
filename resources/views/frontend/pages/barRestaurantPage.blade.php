@extends('layouts.frontend')
@push('page-title')
    The Rooms
@endpush
@section('content')
    <section id="barRestaurantPageTop" style='background: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.4)) ,url("{{ asset('images/restaurant-main.jpeg') }}"); background-attachment: fixed; background-position: bottom center; background-repeat: no-repeat; background-size: cover;'>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>The Bar & Restaurant</h1>
                    <div class="btn-group">
                        <button type="button" class="darkGoldBtn" data-bs-toggle="modal" data-bs-target="#viewMenuModal">View Menu</button>
                        <button type='button' class="blueBtn" data-bs-toggle="modal" data-bs-target="#viewWhiskyModal">View Whiskys</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="barRestaurantPageBannerOne">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p>
                        <strong>We have a limited number of tables available therefore booking in advanced is highly recommended.</strong>
                    </p>
                    <p>
                        At the Mash Tun we have a real passion for great food and Scottish malt whisky.  This is reflected in the locally sourced and well presented food offered by our friendly, helpful and knowledgeable staff.  Head chef Nick alongside sous chef Nina are passionate about Scottish contemporary cooking, and you will find The Mash Tun Menu a treasure trove of fantastic flavours.
                    </p>
                    <p>
                        Enjoy locally sourced food and Scottish whisky, and stay in one of our give whisky themed rooms situated above the bar area.  Comfortable and well appointed, each of our rooms are individual and named after local whisky distilleries.
                    </p>
                    <button type="button" class="darkGoldBtn" data-bs-toggle="modal" data-bs-target="#viewMenuModal">View Menu</button>
                    <img class="img-fluid secondryImage" src="{{ asset('images/brownie-with-creame.webp') }}">
                </div>
                <div class="col-md-6">
                    <img class="img-fluid mainImage" src="{{ asset('images/food-image-one.webp') }}">
                </div>
            </div>
        </div>
    </section>
    <section id="barRestaurantImageBanner" style="background: url('{{ asset('images/bar-restaurant-image-one.jpeg') }}'); background-attachment: fixed; background-position: bottom center; background-repeat: no-repeat; background-size: cover;"></section>

    <section id="barRestaurantPageWhiskysBanner">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>The Whiskies</h2>
                    <p>
                        The Mash Tun is home to a wide and varied selection of whiskies, both single malts and blends, predominately from Speyside but also incorporating distilleries from the rest of Scotland.  Included in this selection is the exclusive Glenfarclas Family Cash Collection.
                    </p>
                    <p>
                        The Family Casks are a unique collection of 52 single cask whiskies, with one for each consecutive year from 1952 to 2003.  The collection is unique as there is no other known collection of rare and old whiskies that covers 52 consecutive years from the same distillery.
                    </p>
                    <p>
                        The Mash Tun is home to the largest collection of the Glenfarclas Family Casks in the world that is on display and available to drink by the dram.
                    </p>
                    <p>
                        Our small team of enthusiastic staff are here to assist and guide you through the collection of whiskies we currently have at the famous Mash Tun Whisky Bar.
                    </p>
                    <p>
                        There is a wide range of whiskies available to suit all tastes and budgets with prices ranging from £3.50 to £1500 per 35ml dram.
                    </p>
                    <button type='button' class="blueBtn" data-bs-toggle="modal" data-bs-target="#viewWhiskyModal">View Whisky Selection</button>
                </div>
                <div class="col-md-6">
                    <img class="img-fluid mainImage" src="{{ asset('images/holding_glencairn_whiksy.webp') }}">
                </div>
            </div>
        </div>
    </section>

    <section class="makeBookingBanner" style="background: linear-gradient(to bottom, rgba(0,0,0, 0.4), rgba(0,0,0,0.4)), url(''); background-attachment: fixed; background-position: bottom center; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Book a stay today</h2>
                    <p>
                        When you book a room with us, you won't be charged until you check out.
                    </p>
                    <a href="" class="darkGoldBtn">
                        Book Now
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="viewMenuModal">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Our Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="menuItem">
                        <h5>Starters</h5>
                        <ul class="list-unstyled">
                            @foreach($menuStarters as $starter)
                                <li>
                                    {{ $starter->name }} - £{{ $starter->price }}
                                    <div class="content">
                                        {!! $started->description !!}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="menuItem">
                        <h5>Mains</h5>
                        <ul class="list-unstyled">
                            @foreach($menuMains as $main)
                                <li>
                                    {{ $main->name }} - £{{ $main->price }}
                                    <div class="content">
                                        {!! $main->description !!}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="menuItem">
                        <h5>Sides</h5>
                        <ul class="list-unstyled">
                            @foreach($menuSides as $side)
                                <li>
                                    {{ $side->name }} - £{{ $side->price }}
                                    <div class="content">
                                        {!! $side->description !!}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="menuItem">
                        <h5>Desserts</h5>
                        <ul class="list-unstyled">
                            @foreach($menuDesserts as $dessert)
                                <li>
                                    {{ $dessert->name }} - £{{ $dessert->price }}
                                    <div class="content">
                                        {!! $dessert->description !!}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="viewWhiskyModal">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Our Whisky Selection</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="whiskyModalInner">
                        <ul class="list-unstyled">
                            @foreach($whiskies as $whisky)
                                <li>
                                    {{ $whisky->name }} - £{{ $whisky->price }}
                                    <div class="content">
                                        {!! $whisky->description !!}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
