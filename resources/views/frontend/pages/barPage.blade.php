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
    <section class="brPageHeroBanner">
        <img class="img-fluid mainBgImage" src="{{ asset('images/bar-page-hero-image.jpg') }}">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <h1>The Bar</h1>
                        <p>
                            Quisque ut dui malesuada, eleifend odio quis, efficitur nisl. Donec consequat blandit erat ac mollis. Vestibulum posuere ut nulla et efficitur. Praesent at sagittis justo.
                        </p>
                        <div class="btn-group">

                            <button type="button" class="darkGoldBtn" data-bs-toggle="modal" data-bs-target="#viewWineMenuModal">Wine List</button>
                            <button type="button" class="blueBtn" data-bs-toggle="modal" data-bs-target="#viewWhiskyMenuModal">Whisky Flights Menu</button>
                            <button type="button" class="darkGoldBtn" data-bs-toggle="modal" data-bs-target="#viewCocktailsMenuModal">Cocktails List</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="brBanner brBannerOne">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="secTitle">Discover our amazing range of Whiskys</h2>
                    <p>
                        The Mash Tun is home to a wide and varied selection of whiskies, both single malts and blends, predominately from Speyside but also incorporating distilleries from the rest of Scotland. Included in this selection is the exclusive Glenfarclas Family Cash Collection.
                    </p>
                    <p>
                        The Family Casks are a unique collection of 52 single cask whiskies, with one for each consecutive year from 1952 to 2003. The collection is unique as there is no other known collection of rare and old whiskies that covers 52 consecutive years from the same distillery.
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
                    <button type='button' class="blueBtn" data-bs-toggle="modal" data-bs-target="#viewWhiskyMenuModal">Whisky Menu</button>
                </div>
                <div class="col-md-6">
                    <img class="img-fluid featuredImage" src="{{ asset('images/whiskys.jpg') }}">
                </div>
            </div>
        </div>
    </section>

    <section class="brBanner brBannerOne">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img class="img-fluid featuredImage" src="{{ asset('images/whiskys.jpg') }}">
                </div>
                <div class="col-md-6">
                    <h2 class="secTitle">It's not just whisky, we do wine too</h2>
                    <p>
                        Nunc a hendrerit nisi, eu eleifend ligula. In quis mattis nisi. Donec aliquam tempor imperdiet. Ut sodales tincidunt tortor, vel commodo risus finibus vitae. Phasellus placerat leo id metus semper pharetra. Curabitur vehicula est eu erat lobortis, eget eleifend purus fringilla. Nullam feugiat tellus et efficitur vestibulum. Quisque quam nulla, imperdiet in feugiat vel, gravida vitae turpis. Quisque porttitor laoreet diam. Donec ut neque dignissim massa mollis imperdiet sed sit amet sapien. Vestibulum consequat ex cursus est maximus gravida. Nam id bibendum elit.
                    </p>
                    <button type='button' class="blueBtn" data-bs-toggle="modal" data-bs-target="#viewWineMenuModal">Wine Menu</button>
                </div>
            </div>
        </div>
    </section>

    <section class="brBanner brBannerOne">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="secTitle">Did someone say Cocktails</h2>
                    <p>
                        Nunc a hendrerit nisi, eu eleifend ligula. In quis mattis nisi. Donec aliquam tempor imperdiet. Ut sodales tincidunt tortor, vel commodo risus finibus vitae. Phasellus placerat leo id metus semper pharetra. Curabitur vehicula est eu erat lobortis, eget eleifend purus fringilla. Nullam feugiat tellus et efficitur vestibulum. Quisque quam nulla, imperdiet in feugiat vel, gravida vitae turpis. Quisque porttitor laoreet diam. Donec ut neque dignissim massa mollis imperdiet sed sit amet sapien. Vestibulum consequat ex cursus est maximus gravida. Nam id bibendum elit.
                    </p>
                    <button type='button' class="blueBtn" data-bs-toggle="modal" data-bs-target="#viewCocktailsMenuModal">Cocktails Menu</button>
                </div>
                <div class="col-md-6">
                    <img class="img-fluid featuredImage" src="{{ asset('images/whiskys.jpg') }}">
                </div>
            </div>
        </div>
    </section>

    <section class="makeBookingBanner" style="background: linear-gradient(to bottom, rgba(0,0,0, 0.4), rgba(0,0,0,0.4)), url('{{ Storage::url($brc->book_stay_banner_background_image) }}'); background-attachment: fixed; background-position: bottom center; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>{{ $brc->book_stay_banner_title }}</h2>
                    {{--{!! $brc->book_stay_banner_content !!}--}}
                    <p>
                        When you book a room with us, you will be promised a warm welcome.
                    </p>
                    <a href="" class="darkGoldBtn">
                        Book Now
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection
