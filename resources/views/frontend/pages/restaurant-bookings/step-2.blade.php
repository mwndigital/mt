@extends('layouts.frontend')
@push('page-title')
    Book a table - step 2
@endpush
@push('page-styles')

@endpush
@push('page-scripts')

@endpush
@section('content')
    <section class="bookingPageTop" style="background: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('{{ asset('images/rooms/Room_Aberlour.webp') }}'); background-attachment: fixed; background-position: bottom center; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Book a table with us</h1>
                </div>
            </div>
        </div>
    </section>
    @if($errors->any())
        <div class="flex flex-row alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('booking_conflict'))
        <div class="alert alert-danger" role="alert">
            The selected dates are already booked. Please choose different dates.
        </div>
    @endif
    <section class="bookingPageMain">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="formWrap">
                        <div class="stepBanner">
                            <div class="innerWrap"><span>Step 2</span></div>
                        </div>
                        <form action="" method="post">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ route('book-a-table-index') }}" class="">
                                        <i class="fas fa-chevron-left"></i> Back
                                    </a>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <button type="submit" class="darkGoldBtn">Next Step <i class="fas fa-chevron-right"></i></button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
