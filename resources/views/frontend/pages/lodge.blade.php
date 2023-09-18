@extends('layouts.frontend')
@push('page-title')
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
                        <h1>Our Lodge</h1>
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
                <div class="col-md-6">
                    <h2 class="secTitle">
                        Indulge in a little piece of heaven
                    </h2>
                    <p>
                        Nunc a hendrerit nisi, eu eleifend ligula. In quis mattis nisi. Donec aliquam tempor imperdiet. Ut sodales tincidunt tortor, vel commodo risus finibus vitae. Phasellus placerat leo id metus semper pharetra. Curabitur vehicula est eu erat lobortis, eget eleifend purus fringilla. Nullam feugiat tellus et efficitur vestibulum. Quisque quam nulla, imperdiet in feugiat vel, gravida vitae turpis. Quisque porttitor laoreet diam. Donec ut neque dignissim massa mollis imperdiet sed sit amet sapien. Vestibulum consequat ex cursus est maximus gravida. Nam id bibendum elit.
                    </p>

                </div>
                <div class="col-md-6">
                    <img class="img-fluid featuredImage" src="{{ asset('images/lodge/_DSC1547.jpg') }}">
                </div>
            </div>
        </div>
    </section>

    <section class="lodgeBanner">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img class="img-fluid featuredImage" src="{{ asset('images/lodge/_DSC1511.jpg') }}">
                </div>
                <div class="col-md-6">
                    <h2 class="secTitle">
                        Indulge in a little piece of heaven
                    </h2>
                    <p>
                        Nunc a hendrerit nisi, eu eleifend ligula. In quis mattis nisi. Donec aliquam tempor imperdiet. Ut sodales tincidunt tortor, vel commodo risus finibus vitae. Phasellus placerat leo id metus semper pharetra. Curabitur vehicula est eu erat lobortis, eget eleifend purus fringilla. Nullam feugiat tellus et efficitur vestibulum. Quisque quam nulla, imperdiet in feugiat vel, gravida vitae turpis. Quisque porttitor laoreet diam. Donec ut neque dignissim massa mollis imperdiet sed sit amet sapien. Vestibulum consequat ex cursus est maximus gravida. Nam id bibendum elit.
                    </p>

                </div>
            </div>
        </div>
    </section>
    <section class="lodgeBanner">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="secTitle">
                        The nature of outside, whilst being inside
                    </h3>
                    <p>
                        Nunc a hendrerit nisi, eu eleifend ligula. In quis mattis nisi. Donec aliquam tempor imperdiet. Ut sodales tincidunt tortor, vel commodo risus finibus vitae. Phasellus placerat leo id metus semper pharetra. Curabitur vehicula est eu erat lobortis, eget eleifend purus fringilla. Nullam feugiat tellus et efficitur vestibulum. Quisque quam nulla, imperdiet in feugiat vel, gravida vitae turpis. Quisque porttitor laoreet diam. Donec ut neque dignissim massa mollis imperdiet sed sit amet sapien. Vestibulum consequat ex cursus est maximus gravida. Nam id bibendum elit.
                    </p>

                </div>
                <div class="col-md-6">
                    <img class="img-fluid featuredImage" src="{{ asset('images/lodge/lodge-image-3.png') }}">
                </div>
            </div>
        </div>
    </section>
@endsection
