@extends('layouts.frontend')
@push('page-title')
    Cigar and Whisky Shop
@endpush
@push('page-description')
    {{--{{ $rpc->page_description }}--}}
@endpush
@push('page-keywords')
    {{--{{ $rpc->page_keywords }}--}}
@endpush
@push('page-image')
    {{--{{ Storage::url($rpc->page_image) }}--}}
@endpush
@section('content')
    <section class="cigarWhiskyPageTop">
        <img class="img-fluid" src="{{ asset('images/whisky-cigar/cigar-whisky-door.jpg') }}">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1>
                            Our Cigar & Whisky Shop
                        </h1>
                        <p>
                            Not only can you join us for our delicious food, a stay in one of our beautiful rooms or our lodge but you can also purchase a range of amazing whisky's and cigars from our fully stocked shop.
                        </p>
                        <div class="btn-group">
                            <button type="button" class="darkGoldBtn" data-bs-toggle="modal"
                                    data-bs-target="#viewCigarMenuModal">Cigar Menu
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cigarWhiskyBanner">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3>Retail Store</h3>
                    <p>
                        The small retail whisky and cigar shop boast an inviting ambiance, centered around a prominent 3-door humidor showcashing an array of cigars.  This humidor houses a carefully curated selected of both Cuban and new world cigars, ranging from £8 to £90, providing aficionados with a diverse choice of flavours and profiles.
                    </p>
                    <p>
                        Adorning the walls are shelves displaying an extensive assortment of whiskies, capturing the essence of different regions and styles.  The shop invites patrons to explore this rich spectrum of whiskies, catering to both seasoned enthusiasts and those new to the world of whisky.  Overall, the space exudes an air of sophistication, beckoning enthusiasts to immerse themselves in the pleasure of premium cigars and whiskies.
                    </p>
                </div>
                <div class="col-md-6">
                    <img class="img-fluid" src="{{ asset('images/whisky-cigar/whisky-shelf.jpg') }}">
                </div>
            </div>
        </div>
    </section>



    <section class="cigarWhiskyBanner">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img class="img-fluid" src="{{ asset('images/whisky-cigar/sun-loungers.jpg') }}">
                </div>
                <div class="col-md-6">
                    <h2>Cigar Terrace</h2>
                    <p>
                        The outdoor cigar terrace for Lodge guests is a sophisticated enclave, tastefully furnished with cushioned seating and featuring two sun-loungers for optimal relaxation.  The plush seats are positioned strategically, offering a comfortable space for guests to indulge in their cigars while surrounded by the beauty of nature.  The sun-loungers provide a spot to bask in the sun or stargaze, creating a refined and tranquil atmosphere that complements the pleasure of enjoying a fine cigar in the great outdoors.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="cigarWhiskyBanner">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>Cigar Pavilion</h2>
                    <p>
                        The cigar pavilion is a cozy, enclosed structure with cushioned seats, providing a comfortable and inviting space for cigar enthusiasts.  It's equipped with soft lighting, ensuring a relaxed ambiance, and a heater to maintain a comfortable temperature, allowing enjoyment even in the highland winter.  The pavilion offers a retreat-like atmosphere, perfect for savoring cigars and engaging in conversations with fellow aficionados.
                    </p>
                </div>
                <div class="col-md-6">
                    <img class="img-fluid" src="{{ asset('images/whisky-cigar/cigar-pavilion.png') }}">
                </div>
            </div>
        </div>
    </section>
@endsection
