@extends('layouts.admin')
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
                    <h1>Search Results</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="pageMain">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Date</th>
                        </tr>
                        </tbody>
                        <tbody>
                            @foreach($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->first_name }}</td>
                                    <td>{{ $booking->last_name }}</td>
                                    <td>{{ $booking->email_address }}</td>
                                    <td>{{ date('d/m/Y', strtotime($booking->checkin_date)) }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                            {{--@foreach($restaurantBooking as $booking)
                                <tr>
                                    <td>{{ $booking->first_name }}</td>
                                    <td>{{ $booking->last_name }}</td>
                                    <td>{{ $booking->email_address }}</td>
                                    <td>{{ date('d/m/Y', strtotime($booking->reservation_date)) }}</td>
                                    <td></td>
                                </tr>
                            @endforeach--}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
