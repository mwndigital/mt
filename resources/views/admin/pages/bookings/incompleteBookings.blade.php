@extends('layouts.admin')
@push('page-title')
    Admin Todays Bookings
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
                    <h1>Todays Bookings</h1>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.bookings.create') }}" class="blueBtn">
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
                        <a href="{{ route('admin.book-a-room.print-today-booking') }}" target="_blank"
                           class="btn btn-primary">Print Today's Bookings</a>
                        <a href="{{ route('admin.book-a-room.print-this-weeks-booking') }}" target="_blank"
                           class="btn btn-primary">Print This Weeks Bookings</a>
                        <a href="{{ route('admin.book-a-room.print-next-weeks-bookings') }}" class="btn btn-primary" target="_blank">Print Next Weeks Bookings</a>
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
                            @include('admin.pages.bookings.tabsMenu')
                        </div>
                        <div class="tab-content" id="nav-tabContent">
                            <table class="table table-hovered">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Check-In</th>
                                    <th>Rooms</th>
                                    <th>Total</th>
                                    <th>Attempted</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($incomplete as $booking)
                                    <tr>
                                        <td>{{ $booking->first_name }} {{ $booking->last_name }}</td>
                                        <td>{{ date('d/m/Y', strtotime($booking->checkin_date)) }}</td>
                                        <td>
                                            @foreach ($booking->rooms as $room )
                                                {{ $room->name }}<br/>
                                            @endforeach
                                        </td>
                                        <td>{!! $booking->getStatus() !!}</td>
                                        <td>{{ date('d/m/Y', strtotime($booking->created_at)) }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="dropdown-toggle" role="button" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul>
                                                        <li>
                                                            <a href="{{ route('admin.bookings.show', $booking->id) }}">View</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('admin.bookings.edit', $booking->id) }}">Edit</a>
                                                        </li>
                                                        <li>
                                                            <form
                                                                action="{{ route('admin.book-a-room.mark-as-deposit', $booking->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="cancelBookingBtn">Mark
                                                                    As Deposit Paid
                                                                </button>
                                                            </form>
                                                        </li>
                                                        @if($booking->status != 'paid')
                                                        <li>
                                                            <form
                                                                action="{{ route('admin.book-a-room.mark-as-paid', $booking->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT') <!-- Add this hidden field to override the method -->
                                                                <button type="submit" class="cancelBookingBtn">Mark
                                                                    As Paid
                                                                </button>
                                                            </form>
                                                        </li>
                                                    @endif
                                                        <li>
                                                            <form
                                                                action="{{ route('admin.bookings.destroy', $booking->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <button class="confirm-delete-btn" type="submit">
                                                                    Delete
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
