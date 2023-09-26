@extends('layouts.customer')
@push('page-title')
    {{ $profile->first_name }} {{ $profile->last_name }} update password
@endpush
@push('page-scripts')

@endpush
@push('page-styles')

@endpush
@section('content')
    <section class="pageHero">
        <div class="container">
            <div class="row">
                <div class="col-md-9"><h1>Update your password</h1></div>
                <div class="col-md-3 d-flex justify-content-end">
                    <a href="{{ route('customer.my-account', $profile->id) }}" class="blueBtn">
                        <i class="fas fa-chevron-left"></i> Back to my account
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="pageMain">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('customer.my-account.update', $profile->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Password *</label>
                                <input type="password" name="password" id="password" required>
                                @error('password')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Confirm Password</label>
                                <input type="password" name="confirmation_password" id="confirmation_password" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="darkGoldBtn">Update information</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
