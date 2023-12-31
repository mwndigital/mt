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
                    <h1>Latest Restaurant Bookings</h1>
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

    {{--<form action="{{ route('admin.combine-names') }}" method="post">
        @csrf
        <button type="submit">Combine Names</button>
    </form>--}}

    <section class="pageActionsBanner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="btn-group">
                        <a href="{{ route('admin.restaurant-bookings.print-today-bookings') }}" target="_blank"
                           class="btn btn-primary">Print Today's Bookings</a>
                        <a href="{{ route('admin.restaurant-bookings.print-this-week-bookings') }}" target="_blank"
                           class="btn btn-primary">Print this weeks bookings </a>
                        <a href="{{ route('admin.restaurant-bookings.print-next-weeks-bookings') }}" class="btn btn-primary" target="_blank">Print Next Weeks bookings</a>
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
                            @include('admin.pages.restaurant.tabMenu')
                        </div>
                        <div class="tab-content" id="nav-tabContent">
                            <table class="table w-100 dateSortingTable">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Name</th>
                                    <th>Joining for</th>
                                    <th>No of guests</th>
                                    <th>Table</th>
                                    <th>Booking made</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($nextWeeksBookings as $booking)
                                    <tr>
                                        <td>{{ date('d/m/y', strtotime($booking->reservation_date)) }}</td>
                                        <td>{{ $booking->reservation_time }}</td>
                                        <td>{{ $booking->first_name }} {{ $booking->last_name }}</td>
                                        <td style="text-transform: uppercase;">{{ $booking->joining_for }}</td>

                                        <td>{{ $booking->no_of_guests }}</td>
                                        <td>
                                            @if(isset($booking->table_ids) && is_array(json_decode($booking->table_ids)))
                                                @foreach(json_decode($booking->table_ids) as $tableId)
                                                    Table {{ $tableId }}
                                                @endforeach
                                            @else
                                                Table {{ $booking->table_id }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($booking->created_at == NULL)
                                                IMPORTED
                                            @else
                                                {{ date('d/m/Y', strtotime($booking->created_at)) }}
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
