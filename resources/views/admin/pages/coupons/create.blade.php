@extends('layouts.admin')

@push('page-title')
    Admin Create Coupon
@endpush

@push('page-scripts')
@endpush

@push('page-styles')
@endpush

@section('content')
    <section class="pageHero">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1>Create Coupon</h1>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.coupons.index') }}" class="blueBtn">
                            <i class="fas fa-chevron-left"></i> Back to Coupons
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($errors->any())
        <div class="alert alert-danger">
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
                    <form action="{{ route('admin.coupons.store') }}" method="post">
                        @csrf
                        <label for="code">Code *</label>
                        <input type="text" name="code" id="code" value="{{ old('code') }}" required>
                        @error('code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <label for="type">Type *</label>
                        <select name="type" id="type" required>
                            <option value="">Please select</option>
                            <option value="fixed" {{ old('type') === 'fixed' ? 'selected' : '' }}>Fixed</option>
                            <option value="percentage" {{ old('type') === 'percentage' ? 'selected' : '' }}>Percentage</option>
                        </select>
                        @error('type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <label for="value">Value *</label>
                        <input type="number" name="value" id="value" value="{{ old('value') }}" required>
                        @error('value')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <label for="start_date">Start Date *</label>
                        <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" required>
                        @error('start_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <label for="end_date">End Date *</label>
                        <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" required>
                        @error('end_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <label for="status">Status *</label>
                        <select name="status" id="status" required>
                            <option value="1" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <button type="submit" class="darkGoldBtn">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
