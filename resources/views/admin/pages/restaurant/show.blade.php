@extends('layouts.admin')
@push('page-title')
    Admin Edit Restaurant booking
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
                    <h1>Edit Restaurant booking</h1>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.restaurant-bookings.index') }}" class="blueBtn">
                            <i class="fas fa-chevron-left"></i> All Bookings
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
                        <a href="{{ route('admin.restaurant-bookings.edit', $booking->id) }}" class="editBtn">Edit</a>
                        <form action="{{ route('admin.restaurant-bookings.cancel-booking', $booking->id) }}" method="POST">
                            @csrf
                            @method('PUT') <!-- Add this hidden field to override the method -->
                            <button type="submit" class="cancelBookingBtn">Cancel Booking</button>
                        </form>
                        <form action="{{ route('admin.restaurant-bookings.destroy', $booking->id) }}" method="POST">
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
                    <table class="table w-100">
                        <tbody>
                            <tr>
                                <td><strong>Name</strong></td>
                                <td>{{ $booking->first_name }} {{ $booking->last_name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email address</strong></td>
                                <td>@if($booking->email){{ $booking->email }}@else -- @endif</td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td>
                                    @if($booking->status == 'confirmed')
                                        <div class="text-success">confirmed</div>
                                    @elseif($booking->status == 'cancelled')
                                        <div class="text-danger">Cancelled</div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Reservation Date & Time</strong></td>
                                <td>{{ date('d/m/Y', strtotime($booking->reservation_date)) }} - {{ $booking->reservation_time }}</td>
                            </tr>
                            <tr>
                                <td><strong>Reservation End Time</strong></td>
                                <td>{{ $booking->reservation_end_time }}</td>
                            </tr>
                            <tr>
                                <td><strong>Joining For</strong></td>
                                <td style="text-transform: uppercase;">{{ $booking->joining_for }}</td>
                            </tr>
                            <tr>
                                <td><strong>No of guests</strong></td>
                                <td>{{ $booking->no_of_guests }}</td>
                            </tr>
                            <tr>
                                <td><strong>Table</strong></td>
                                <td>
                                    @if (!empty($tableIds))
                                        Tables
                                        @foreach ($tableIds as $key => $tableId)
                                            {{ $tableId }}
                                            @if ($key < count($tableIds) - 1)
                                                ,
                                            @endif
                                        @endforeach
                                    @else
                                        table {{ $booking->table_id }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Additional Information</strong></td>
                                <td>{{ $booking->additonal_information }}</td>
                            </tr>
                            <tr>
                                <td><strong>Dietary Information</strong></td>
                                <td>{{ $booking->dietary_info }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
