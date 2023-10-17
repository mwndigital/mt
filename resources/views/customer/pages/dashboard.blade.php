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
                <div class="col-12">
                    <h1>Welcome, {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="pageMain" style="background-color: #F8FAFC; padding: 0;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 ps-0">
                    <div class="dashboardItem">
                        <h2>Your Restaurant Bookings</h2>
                        @if($restaurantBookings->isEmpty())
                            <h4 class="noBooking">You currently have no bookings</h4>
                        @else
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Joining for</th>
                                    <th>No of guests</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($restaurantBookings as $booking)
                                    <tr>
                                        <td>{{ date('d/m/Y', strtotime($booking->reservation_date)) }}</td>
                                        <td>{{ $booking->reservation_time }}</td>
                                        <td>{{ $booking->joining_for }}</td>
                                        <td>{{ $booking->no_of_guests }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
                <div class="col-md-6 pe-0">
                    <div class="dashboardItem">
                        <h2>Your Hotel Bookings</h2>
                        @if($hotelBookings->isEmpty())
                            <h4 class="noBooking">You currently have no bookings</h4>
                        @else
                            <table class="table table-hovered">
                                <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Check-In</th>
                                    <th>Check-Out</th>
                                    <th>Rooms</th>
                                    <th>Name</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($hotelBookings as $booking)
                                    <tr>
                                        <td>{!! $booking->getStatus() !!}</td>
                                        <td>{{ date('d/m/Y', strtotime($booking->checkin_date)) }}</td>
                                        <td>{{ date('d/m/Y', strtotime($booking->checkout_date)) }}</td>
                                        <td>
                                            @foreach ($booking->rooms as $room )
                                                {{ $room->name }}<br/>
                                            @endforeach
                                        </td>
                                        <td>{{ $booking->first_name }} {{ $booking->last_name }}</td>
                                        <td>{{ $booking->total }}</td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
