@extends('layouts.admin')
@push('page-title')
    Admin Dashboard
@endpush
@push('page-scripts')

@endpush
@push('page-styles')

@endpush
@section('content')

    {{--<form action="{{ route('admin.contact-form-submission-test-email') }}" method="post">
        @csrf
        <button type="submit">Send test contact form submission</button>
    </form>--}}

    <section class="pageMain" id="adminDashboard">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="whiteBoxItem">
                        <h2>Restaurant Bookings</h2>
                        <div class="tab-panels-wrap">
                            <div class="list-group" id="list-tab" role="tablist">
                                <a class="list-group-item list-group-item-action active" data-bs-toggle="list"
                                   href="#restaurant-list-today" role="tab">Todays Bookings</a>
                                <a class="list-group-item list-group-item-action" data-bs-toggle="list"
                                   href="#restaurant-list-this-week" role="tab">This Weeks Bookings</a>
                            </div>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="restaurant-list-today" role="tabpanel">
                                    <table class="table w-100">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Time</th>
                                            <th>Joining for</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($restaurantToday as $today)
                                            <tr>
                                                <td>{{ $today->first_name }} {{ $today->last_name }}</td>
                                                <td>{{ $today->reservation_time }}</td>
                                                <td>{{ $today->joining_for }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="dropdown-toggle" role="button"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul>
                                                                <li>
                                                                    <a href="{{ route('admin.restaurant-bookings.show', $today->id) }}">
                                                                        View
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{ route('admin.restaurant-bookings.edit', $today->id) }}">Edit</a>
                                                                </li>
                                                                <li>
                                                                    <form
                                                                        action="{{ route('admin.restaurant-bookings.cancel-booking', $today->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PUT') <!-- Add this hidden field to override the method -->
                                                                        <button type="submit" class="cancelBookingBtn">
                                                                            Cancel Booking
                                                                        </button>
                                                                    </form>

                                                                </li>
                                                                <li>
                                                                    <form
                                                                        action="{{ route('admin.restaurant-bookings.destroy', $today->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button class="confirm-delete-btn"
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
                                <div class="tab-pane fade" id="restaurant-list-this-week" role="tabpanel">
                                    <table class="table w-100">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Time</th>
                                            <th>Joining for</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($restaurantThisWeek as $today)
                                            <tr>
                                                <td>{{ $today->first_name }} {{ $today->last_name }}</td>
                                                <td>{{ $today->reservation_time }}</td>
                                                <td style="text-transform: uppercase;">{{ $today->joining_for }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="dropdown-toggle" role="button"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul>
                                                                <li>
                                                                    <a href="{{ route('admin.restaurant-bookings.show', $today->id) }}">
                                                                        View
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{ route('admin.restaurant-bookings.edit', $today->id) }}">Edit</a>
                                                                </li>
                                                                <li>
                                                                    <form
                                                                        action="{{ route('admin.restaurant-bookings.cancel-booking', $today->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PUT') <!-- Add this hidden field to override the method -->
                                                                        <button type="submit" class="cancelBookingBtn">
                                                                            Cancel Booking
                                                                        </button>
                                                                    </form>

                                                                </li>
                                                                <li>
                                                                    <form
                                                                        action="{{ route('admin.restaurant-bookings.destroy', $today->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button class="confirm-delete-btn"
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
                <div class="col-12">
                    <div class="whiteBoxItem">
                        <h2>Room Bookings</h2>
                        <div class="tab-panels-wrap">
                            <div class="list-group" id="list-tab" role="tablist">
                                <a class="list-group-item list-group-item-action active" data-bs-toggle="list"
                                   href="#room-list-today" role="tab">Todays Bookings</a>
                                <a class="list-group-item list-group-item-action" data-bs-toggle="list"
                                   href="#room-list-this-week" role="tab">This Weeks Bookings</a>
                            </div>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="room-list-today" role="tabpanel">
                                    <table class="table w-100">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Checkin Date & Checkout Date</th>
                                            <th>Arrival Time</th>
                                            <th>Room(s)</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($roomToday as $today)
                                            <tr>
                                                <td>{{ $today->first_name }} {{ $today->last_name }}</td>
                                                <td>{{ date('d/m/Y', strtotime($today->checkin_date)) }}
                                                    - {{ date('d/m/Y', strtotime($today->checkout_date)) }}</td>
                                                <td>{{ $today->arrival_time }}</td>
                                                <td style="text-align: right;">
                                                    @foreach ($today->rooms as $room )
                                                        {{ $room->name }}<br/>
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="room-list-this-week" role="tabpanel">
                                    <table class="table w-100">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Checkin Date & Checkout Date</th>
                                            <th>Arrival Time</th>
                                            <th>Room(s)</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($roomThisWeek as $today)
                                            <tr>
                                                <td>{{ $today->first_name }} {{ $today->last_name }}</td>
                                                <td>{{ date('d/m/Y', strtotime($today->checkin_date)) }}
                                                    - {{ date('d/m/Y', strtotime($today->checkout_date)) }}</td>
                                                <td>{{ $today->arrival_time }}</td>
                                                <td style="text-align: right;">
                                                    @foreach ($today->rooms as $room )
                                                        {{ $room->name }}<br/>
                                                    @endforeach
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
            </div>
        </div>
    </section>

@endsection
