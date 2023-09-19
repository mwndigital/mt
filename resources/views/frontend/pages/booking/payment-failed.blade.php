@extends('layouts.frontend')
@push('page-title')
    Payment Error - {{ config('app.name') }}
@endpush
@section('content')
    <section class="bookingPaymentErrorPageMain">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>
                        Payment Error
                    </h1>
                    <p>
                        Sorry, there was an error processing your payment.  Please try again later.
                    </p>
                    <p>
                        Error message: {{ $error }}
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
