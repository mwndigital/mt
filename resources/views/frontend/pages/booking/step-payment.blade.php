@extends('layouts.frontend')
@push('page-title')
    Book a room - Step 4 Payment | Aberlour Moray Scotland
@endpush
@push('page-scripts')

@endpush
@push('page-styles')
    <style>
        .bookingPageMain .formWrap .stepBanner .innerWrap span {
            width: 80%;
        }
    </style>
@endpush
@section('content')
    <section class="bookingPageTop" style="background: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('{{ asset('images/rooms/Room_Aberlour.webp') }}'); background-attachment: fixed; background-position: bottom center; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Book a stay with us</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="bookingPageMain">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="formWrap">
                        <div class="stepBanner">
                            <div class="innerWrap">
                                <span>Step 4</span>
                            </div>
                        </div>
                        <form method="post" action="">
                            @csrf

                            <h4>Booking overview</h4>





                            <div class="row align-items-center mt-4">
                                <div class="col-md-6">
                                    <a href="{{ route('book-a-room-step-2') }}" class="backBtn"><i class='fas fa-chevron-left'></i> Back</a>
                                </div>
                                <div class="col-md-6">
                                    {{--<button type="submit">Next <i class="fas fa-chevron-right"></i></button>--}}
                                    <a href="{{ route('book-a-room-payment-step') }}" class="nextBtn">Continue To Payment <i class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
