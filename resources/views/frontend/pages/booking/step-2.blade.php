@extends('layouts.frontend')
@push('page-title')
    Book a room - Step 2 | Aberlour Moray Scotland
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
                            <div></div>

                        </div>
                        <form method="post" action="">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Number of adults</label>
                                    <input type="number" name="no_of_adults" id="no_of_adults">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Number of children</label>
                                    <input type="number" name="no_of_children" id="no_of_children">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Number of Infants</label>
                                    <input type="number" name="no_of_infants" id="no_of_infants">
                                </div>
                            </div>

                            <div class="row align-items-center mt-4">
                                <div class="col-md-6">
                                    <a href="{{ route('book-a-room-index') }}" class="backBtn"><i class='fas fa-chevron-left'></i> Back</a>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    {{--<button type="submit">Next <i class="fas fa-chevron-right"></i></button>--}}
                                    <a href="{{ route('book-a-room-step-3') }}" class="nextBtn">Next <i class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
