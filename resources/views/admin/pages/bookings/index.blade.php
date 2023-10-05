@extends('layouts.admin')
@push('page-title')
    Admin All Bookings
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
                    <h1>All Bookings</h1>
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

    <section class="pageMain" style="background-color: #fff;padding:0px !important;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table class="table table-hovered">
                        <thead>
                            <tr>
                                <th>Check-In</th>
                                <th>Check-Out</th>
                                <th>Name</th>
                                {{-- <th>Room</th> --}}
                                <th>Status</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                                <tr>
                                    <td>{{ date('d/m/Y', strtotime($booking->checkin_date)) }}</td>
                                    <td>{{ date('d/m/Y', strtotime($booking->checkout_date)) }}</td>
                                    <td>{{ $booking->first_name }} {{ $booking->last_name }}</td>
                                    {{-- <td>{{ $booking->room->name }}</td> --}}
                                    <td>{!! $booking->getStatus() !!}</td>
                                    <td>
                                        <span>£{{ $booking->total }}</span> <small class="badge text-bg-secondary">£{{$booking->getCapturedAmount()}} Paid</small></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                                                        <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="post">
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
                    {{ $bookings->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
