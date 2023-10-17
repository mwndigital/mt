@extends('layouts.customer')
@push('page-title')
    {{ $profile->first_name }} {{ $profile->last_name }} account
@endpush
@push('page-scripts')

@endpush
@push('page-styles')

@endpush
@section('content')
    <section class="pageHero">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>My Account</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="actionsBanner">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-end">
                    <div class="btn-group">
                        <a href="{{ route('customer.my-account.edit', $profile->id) }}" class="blueBtn">Update
                            Details</a>
                        <a href="{{ route('customer.my-account.change-password', $profile->id) }}" class="darkGoldBtn">Change
                            Password</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pageMain">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table class="table w-100">
                        <tbody>
                        <tr>
                            <td><strong>First name: </strong></td>
                            <td>{{ $profile->first_name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Last Name: </strong></td>
                            <td>{{ $profile->last_name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Email Address:</strong></td>
                            <td>{{ $profile->email }}</td>
                        </tr>
                        <tr>
                            <td><strong>Phone Number:</strong></td>
                            <td>
                                @if($profile->userDetails)
                                    {{ $profile->userDetails->phone_number }}
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Address Line One</strong></td>
                            <td>
                                @if($profile->userDetails)
                                    {{ $profile->userDetails->address_line_one }}
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Address Line Two</strong></td>
                            <td>
                                @if($profile->userDetails)
                                    {{ $profile->userDetails->address_line_two }}
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Town/City</strong></td>
                            <td>
                                @if($profile->userDetails)
                                    {{ $profile->userDetails->town_city }}
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Postcode</strong></td>
                            <td>
                                @if($profile->userDetails)
                                    {{ $profile->userDetails->postcode }}
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Country</strong></td>
                            <td>
                                @if($profile->userDetails)
                                    {{ $profile->userDetails->country }}
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Dietary Information: </strong></td>
                            <td>
                                @if($profile->userDetails)
                                    {{ $profile->userDetails->dietary_information }}
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
