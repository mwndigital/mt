@extends('layouts.customer')
@push('page-title')
    {{ auth()->user()->first_name }} {{ auth()->user()->last_name }} Dining Bookings
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
                    <h1>All my dining bookings</h1>
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
                                <th>Date</th>
                                <th>Time</th>
                                <th>Joining For</th>
                                <th>No of guests</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bookings as $booking)
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
        </div>
    </section>
@endsection
