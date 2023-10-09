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
                    <h1>Restaurant Bookings</h1>
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

    <section class="pageMain">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tab-panels-wrap">
                        <div class="list-group" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="list-home-list" data-bs-toggle="list" href="#list-today" role="tab">Todays Bookings</a>
                            <a class="list-group-item list-group-item-action" id="list-profile-list" data-bs-toggle="list" href="#list-this-week" role="tab">This Weeks Bookings</a>
                            <a class="list-group-item list-group-item-action" id="list-messages-list" data-bs-toggle="list" href="#list-messages" role="tab" aria-controls="list-messages">All Bookings</a>
                        </div>

                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="list-today" role="tabpanel">
                                <table class="table w-100">
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
                                        @foreach($todaysBookings as $booking)
                                            <tr>
                                                <td>{{ $booking->first_name }} {{ $booking->last_name }}</td>
                                                <td>{{ $booking->joining_for }}</td>
                                                <td>{{ date('l', strtotime($booking->reservation_date)) }} {{ date('d/m/y', strtotime($booking->reservation_date)) }}</td>
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
                                                        <button class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul>

                                                                <li>
                                                                    <a href="{{ route('admin.restaurant-bookings.edit', $booking->id) }}">Edit</a>
                                                                </li>
                                                                <li>
                                                                    <form action="{{ route('admin.restaurant-bookings.cancel-booking', $booking->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <button type="submit" class="cancelBookingBtn">Cancel Booking</button>
                                                                    </form>

                                                                </li>
                                                                <li>
                                                                    <form action="{{ route('admin.restaurant-bookings.cancel-booking', $booking->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('PUT') <!-- Add this hidden field to override the method -->
                                                                        <button type="submit" class="cancelBookingBtn">Cancel Booking</button>
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
                            <div class="tab-pane fade" id="list-this-week" role="tabpanel">
                                <table class="table  w-100">
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
                                    @foreach($thisWeeksBookings as $booking)
                                        <tr>
                                            <td>{{ $booking->first_name }} {{ $booking->last_name }}</td>
                                            <td>{{ $booking->joining_for }}</td>
                                            <td>{{ date('l', strtotime($booking->reservation_date)) }} {{ date('d/m/y', strtotime($booking->reservation_date)) }}</td>
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
                                                    <button class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul>

                                                            <li>
                                                                <a href="{{ route('admin.restaurant-bookings.edit', $booking->id) }}">Edit</a>
                                                            </li>
                                                            <li>
                                                                <form action="{{ route('admin.restaurant-bookings.cancel-booking', $booking->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('PUT') <!-- Add this hidden field to override the method -->
                                                                    <button type="submit" class="cancelBookingBtn">Cancel Booking</button>
                                                                </form>

                                                            </li>
                                                            <li>
                                                                <form action="" method="POST">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button class="confirm-delete-btn" type="submit">Delete</button>
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
                            <div class="tab-pane fade" id="list-messages" role="tabpanel">
                                <table class="table w-100">
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
                                            <td>{{ $booking->joining_for }}</td>
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
                                                    <button class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul>

                                                            <li>
                                                                <a href="{{ route('admin.restaurant-bookings.edit', $booking->id) }}">Edit</a>
                                                            </li>
                                                            <li>
                                                                <form action="{{ route('admin.restaurant-bookings.cancel-booking', $booking->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('PUT') <!-- Add this hidden field to override the method -->
                                                                    <button type="submit" class="cancelBookingBtn">Cancel Booking</button>
                                                                </form>

                                                            </li>
                                                            <li>
                                                                <form action="" method="POST">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button class="confirm-delete-btn" type="submit">Delete</button>
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

                    <table class="table table-hovered">

                    </table>
                </div>
            </div>
        </div>
    </section>

@endsection
