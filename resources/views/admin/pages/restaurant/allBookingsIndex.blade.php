@extends('layouts.admin')
@push('page-title')
    Admin Restaurant Booking
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
                    <h1>All Restaurant Bookings</h1>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.restaurant-bookings.create') }}" class="blueBtn">
                            Add Booking <i class="fas fa-plus"></i>
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
                        <a href="{{ route('admin.restaurant-bookings.print-today-bookings') }}" target="_blank"
                           class="btn btn-primary">Print Today's Bookings</a>
                        <a href="{{ route('admin.restaurant-bookings.print-this-week-bookings') }}" target="_blank"
                           class="btn btn-primary">Print this weeks bookings </a>
                        {{--<a href="{{ route('admin.restaurant-bookings.print-all-bookings') }}" target="_blank" class="btn btn-primary">All Bookings</a>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pageMain">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tab-panels-wrap">
                        <div class="list-group" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action" id="list-home-list"
                               href="{{ route('admin.restaurant-bookings.index') }}">Todays Bookings</a>
                            <a class="list-group-item list-group-item-action" id="list-profile-list"
                               data-bs-toggle="list" href="{{ route('admin.restaurant-bookings.this-weeks-bookings') }}"
                               role="tab">This Weeks Bookings</a>
                            <a class="list-group-item list-group-item-action active" id="list-messages-list"
                               href="{{ route('admin.restaurant-bookings.all-bookings') }}" role="tab"
                               aria-controls="list-messages">All Bookings</a>
                        </div>

                        <div class="tab-content" id="nav-tabContent">

                            <table class="table dataTablesTable">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Joining for</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>No of guests</th>
                                    <th>Table</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($allBookings as $booking)
                                    <tr>
                                        <td>{{ $booking->first_name }} {{ $booking->last_name }}</td>
                                        <td style="text-transform: uppercase;">{{ $booking->joining_for }}</td>
                                        <td>{{ date('l', strtotime($booking->reservation_date)) }} {{ date('d/m/Y', strtotime($booking->reservation_date)) }}</td>
                                        <td>{{ $booking->reservation_time }}</td>
                                        <td>{{ $booking->no_of_guests }}</td>
                                        <td>
                                            @if($booking->table_ids && $booking->table_id == 1)
                                                @foreach(json_decode($booking->table_ids) as $tableId)
                                                    Table {{ $tableId }}
                                                @endforeach
                                            @else
                                                Table {{ $booking->table_id }}
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="dropdown-toggle" role="button" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul>
                                                        <li>
                                                            <a href="{{ route('admin.restaurant-bookings.show', $booking->id) }}">
                                                                View
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('admin.restaurant-bookings.edit', $booking->id) }}">Edit</a>
                                                        </li>
                                                        <li>
                                                            <form
                                                                action="{{ route('admin.restaurant-bookings.cancel-booking', $booking->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT') <!-- Add this hidden field to override the method -->
                                                                <button type="submit" class="cancelBookingBtn">Cancel
                                                                    Booking
                                                                </button>
                                                            </form>

                                                        </li>
                                                        <li>
                                                            <form
                                                                action="{{ route('admin.restaurant-bookings.destroy', $booking->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="deleteBtn confirm-delete-btn"
                                                                        type="submit">Delete
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
