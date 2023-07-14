@extends('layouts.frontend')
@push('page-title')
    {{ $brc->page_title }}
@endpush
@push('page-description')
    {{ $brc->page_description }}
@endpush
@push('page-keywords')
    {{ $brc->page_keywords }}
@endpush
@push('page-image')
    {{ Storage::url($brc->page_image) }}
@endpush
@push('page-styles')

@endpush
@push('page-scripts')

@endpush
@section('content')
    <section id="barRestaurantPageTop" style='background: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.4)) ,url("{{ Storage::url($brc->hero_banner_background_image) }}"); background-attachment: fixed; background-position: bottom center; background-repeat: no-repeat; background-size: cover;'>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>{{ $brc->hero_banner_title }}</h1>
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
                    @if($brc->banner_one_title)
                        <h2>{{ $brc->banner_one_title }}</h2>
                    @endif
                    {!! $brc->banner_one_content !!}
                    <button type="button" class="darkGoldBtn" data-bs-toggle="modal" data-bs-target="#viewMenuModal">View Menu</button>
                    <img class="img-fluid secondryImage" src="{{ Storage::url($brc->banner_one_small_image) }}">
                </div>
                <div class="col-md-6">
                    <img class="img-fluid mainImage" src="{{ Storage::url($brc->banner_one_big_image) }}">
                </div>
            </div>
        </div>
    </section>
    <section id="barRestaurantImageBanner" style="background: url('{{ Storage::url($brc->separator_banner_image) }}'); background-attachment: fixed; background-position: bottom center; background-repeat: no-repeat; background-size: cover;"></section>

    <section id="barRestaurantPageWhiskysBanner">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>{{ $brc->banner_two_title }}</h2>
                    {!! $brc->banner_two_content !!}
                    <button type='button' class="blueBtn" data-bs-toggle="modal" data-bs-target="#viewWhiskyModal">View Whisky Selection</button>
                </div>
                <div class="col-md-6">
                    <img class="img-fluid mainImage" src="{{ Storage::url($brc->banner_two_image) }}">
                </div>
            </div>
        </div>
    </section>

    <section class="makeBookingBanner" style="background: linear-gradient(to bottom, rgba(0,0,0, 0.4), rgba(0,0,0,0.4)), url('{{ Storage::url($brc->book_stay_banner_background_image) }}'); background-attachment: fixed; background-position: bottom center; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>{{ $brc->book_stay_banner_title }}</h2>
                    {!! $brc->book_stay_banner_content !!}
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
