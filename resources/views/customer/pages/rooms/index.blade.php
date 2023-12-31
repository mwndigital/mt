@extends('layouts.customer')
@push('page-title')
    {{ auth()->user()->first_name }} {{ auth()->user()->last_name }} Room Bookings
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
                    <h1>All my room bookings</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="pageMain">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if($bookings->isEmpty())
                        <h4 class="noBooking">You currently have no bookings</h4>
                    @else
                        <table class="table w-100">
                            <thead>
                            <tr>
                                <th>Booking Ref</th>
                                <th>Check-in Date</th>
                                <th>Arrival Time</th>
                                <th>Checkout Date</th>
                                <th>No of Adults</th>
                                <th>No of Children</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->booking_ref }}</td>
                                    <td>{{ date('d/m/Y', strtotime($booking->checkin_date)) }}</td>
                                    <td>{{ $booking->arrival_time }}</td>
                                    <td>{{ date('d/m/Y', strtotime($booking->checkout_date)) }}</td>
                                    <td>{{ $booking->no_of_adults }}</td>
                                    <td>{{ $booking->no_of_children }}</td>
                                    <td>
                                        {!! $booking->getStatus() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
