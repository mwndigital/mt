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
                            <th>Date/Day</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Reservation Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </tbody>
                        <tbody>
                       {{-- @foreach($bookings as $booking)
                            <tr>
                                <td>{{ $booking->first_name }}</td>
                                <td>{{ $booking->last_name }}</td>
                                <td>{{ $booking->email_address }}</td>
                                <td>{{ date('d/m/Y', strtotime($booking->checkin_date)) }}</td>
                                <td></td>
                            </tr>
                        @endforeach--}}
                        @foreach($restaurantBooking as $booking)
                            <tr>
                                <td>{{ date('d/m/Y l', strtotime($booking->reservation_date)) }}</td>
                                <td>{{ $booking->first_name }}</td>
                                <td>{{ $booking->last_name }}</td>
                                <td>{{ $booking->email }}</td>
                                <td></td>
                                <td>{{ $booking->status }}</td>
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
    </section>
@endsection
