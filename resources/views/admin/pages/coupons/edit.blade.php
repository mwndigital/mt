@extends('layouts.admin')

@push('page-title')
    Admin Edit Coupon: {{ $coupon->code }}
@endpush

@section('content')
    <section class="pageHero">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1>Edit Coupon: {{ $coupon->code }}</h1>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.coupons.index') }}" class="blueBtn">
                            <i class="fas fa-chevron-left"></i> All Coupons
                        </a>
                    </div>
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
    <section class="pageMain">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-6">
                                <label for="code">Code *</label>
                                <input type="text" name="code" id="code" value="{{ $coupon->code }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="type">Type *</label>
                                <select name="type" id="type" required>
                                    <option value="fixed" {{ $coupon->type === 'fixed' ? 'selected' : '' }}>Fixed</option>
                                    <option value="percentage" {{ $coupon->type === 'percentage' ? 'selected' : '' }}>Percentage</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="value">Value *</label>
                                <input type="number" name="value" id="value" value="{{ $coupon->value }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="start_date">Start Date *</label>
                                <input type="date" name="start_date" id="start_date" value="{{ $coupon->start_date }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="end_date">End Date *</label>
                                <input type="date" name="end_date" id="end_date" value="{{ $coupon->end_date }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="status">Status *</label>
                                <select name="status" id="status" required>
                                    <option value="1" {{ $coupon->status === 'Active' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $coupon->status === 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="darkGoldBtn">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
