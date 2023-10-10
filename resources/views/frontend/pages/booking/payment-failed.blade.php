@extends('layouts.frontend')
@push('page-title')
    Payment Error - {{ config('app.name') }}
@endpush
@section('content')
    <section class="bookingPaymentErrorPageMain">
        <div class="container">
            <div class="row">
                <div class="col-12" id="message" style="margin-top: 300px;">
                    <h1>
                        Payment Error
                    </h1>
                    <p>
                        Sorry, there was an error processing your payment.  Please try again later.
                    </p>
                    <p>
                        Error message: {{ $error }}
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
