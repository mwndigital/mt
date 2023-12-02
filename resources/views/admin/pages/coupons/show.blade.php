@extends('layouts.admin')

@push('page-title')
    Admin View Coupon: {{ $coupon->code }}
@endpush

@section('content')
    <section class="pageHero">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-8">
                            <h1>{{ $coupon->code }}</h1>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('admin.coupons.index') }}" class="blueBtn">
                                    <i class="fa fa-chevron-left"></i> All Coupons
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pageMain">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table class="table showTable">
                        <tbody>
                            <tr>
                                <td><strong>Code:</strong></td>
                                <td>{{ $coupon->code }}</td>
                            </tr>
                            <tr>
                                <td><strong>Type:</strong></td>
                                <td>{{ ucfirst($coupon->type) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Value:</strong></td>
                                <td>{{ $coupon->value }}</td>
                            </tr>

                            <tr>
                                <td><strong>Start Date:</strong></td>
                                <td>{{ $coupon->start_date }}</td>
                            </tr>

                            <tr>
                                <td><strong>End Date:</strong></td>
                                <td>{{ $coupon->end_date }}</td>
                            </tr>

                            <tr>
                                <td><strong>Status:</strong></td>
                                <td>{{ $coupon->status }}</td>
                            </tr>



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
