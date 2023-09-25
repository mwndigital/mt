@extends('layouts.customer')
@push('page-title')

@endpush
@push('page-scripts')

@endpush
@push('page-styles')

@endpush
@section('content')
    <section class="pageHero">
        <div class="container">
            <div class="row">
                <div class="col-md-9"><h1>Edit Details</h1></div>
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
                                <label for="">First name *</label>
                                <input type="text" name="first_name" id="first_name" value="{{ $profile->first_name }}" required>
                                @error('first_name')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Last name *</label>
                                <input type="text" name="last_name" id="last_name" value="{{ $profile->last_name }}" required>
                                @error('last_name')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Email Address *</label>
                                <input type="email" name="email" id="email" value="{{ $profile->email }}" required>
                                @error('email')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Phone Number</label>
                                <input type="tel" name="phone_number" id="phone_number" value="@if($profile->userDetails){{ $profile->userDetails->phone_number }}@endif">
                                @error('phone_number')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Address Line One</label>
                                <input type="text" name="address_line_one" id="address_line_one" value="@if($profile->userDetails){{ $profile->userDetails->address_line_one }}@endif">
                                @error('address_line_one')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Address Line Two</label>
                                <input type="text" name="address_line_two" id="address_line_two" value="@if($profile->userDetails){{ $profile->userDetails->address_line_two }}@endif">
                                @error('address_line_two')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
