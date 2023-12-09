@extends('layouts.admin')

@push('page-title')
    Admin Coupons
@endpush

@section('content')
    <section class="pageHero">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1>Coupons</h1>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.coupons.create') }}" class="blueBtn">
                            Add Coupon <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pageMain">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table class="table table-hovered">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Type</th>
                                <th>Value</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Total Used</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($coupons as $coupon)
                                <tr>
                                    <td>{{ $coupon->code }}</td>
                                    <td>{{ ucfirst($coupon->type) }}</td>
                                    <td>{{ $coupon->value }}</td>
                                    <td>{{ $coupon->start_date }}</td>
                                    <td>{{ $coupon->end_date }}</td>
                                    <td>{{ $coupon->status }}</td>
                                    <td>{{ $coupon->bookings->count() }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="dropdown-toggle" role="button" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('admin.coupons.show', $coupon->id) }}">View</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('admin.coupons.edit', $coupon->id) }}">Edit</a>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('admin.coupons.destroy', $coupon->id) }}"
                                                              method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="confirm-delete-btn" type="submit">Delete</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
