@extends('layouts.admin')
@push('page-title')
    Admin - show Booking {{ $booking->booking_ref }}
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
                    <h1>
                        {{ $booking->first_name }} {{ $booking->last_name }}'s booking
                    </h1>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.bookings.index') }}" class="blueBtn">
                            <i class="fas fa-chevron-left"></i> Back to Bookings
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pageActionsBanner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="btn-group">
                        <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="editBtn">Edit</a>
                        <form action="" method="POST">
                            @csrf
                            @method('delete')
                            <button class="deleteBtn confirm-delete-btn" type="submit">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pageMain">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table class="table table-responsive w-100">
                        <tbody>
                            <tr>
                                <td><strong>Booking Ref:</strong></td>
                                <td>{{ $booking->booking_ref }}</td>
                            </tr>
                            <tr>
                                <td><strong>Room Booked:</strong></td>
                                <td>{{ $booking->room->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Checkin Date:</strong></td>
                                <td>{{ $booking->checkin_date }}</td>
                            </tr>
                            <tr>
                                <td><strong>Checkout Date:</strong></td>
                                <td>{{ $booking->checkout_date }}</td>
                            </tr>
                            <tr>
                                <td><strong>Arrival Time:</strong></td>
                                <td>{{ $booking->arrival_time }}</td>
                            </tr>
                            <tr>
                                <td><strong>Name:</strong></td>
                                <td style="text-transform: capitalize;">{{ $booking->user_title }} {{ $booking->first_name }} {{ $booking->last_name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Number of adults:</strong></td>
                                <td>{{ $booking->no_of_adults }}</td>
                            </tr>
                            <tr>
                                <td><strong>Number of children:</strong></td>
                                <td>{{ $booking->no_of_children }}</td>
                            </tr>
                            <tr>
                                <td><strong>Address:</strong></td>
                                <td>
                                    {{ $booking->address_line_one }} <br>
                                    @if($booking->address_line_two)
                                        {{ $booking->address_line_two }} <br>
                                    @endif
                                    {{ $booking->city }} <br>
                                    {{ $booking->postcode }} <br>
                                    {{ $booking->country }}
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td>{{ $booking->email_address }}</td>
                            </tr>
                            <tr>
                                <td><strong>Phone number:</strong></td>
                                <td>{{ $booking->phone_number }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
