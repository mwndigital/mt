@extends('layouts.frontend')
@push('page-title')
    Thank you for your booking
@endpush
@push('page-styles')
<style>
    #message {
        margin-top: 300px;
    }
</style>
@endpush
@section('content')
    <section class="bookingThankYouPageMain">
        <div class="container">
            <div class="row">
                <div class="col-12" id="message">
                    <h1>Thank you for your booking</h1>
                    <p>
                        An email has been sent to the email address which you provided with full details of your booking.
                    </p>
                    <p>
                    <!-- Go Homepage -->
                    <a href="/" class="btn btn-dark">Go Homepage</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
