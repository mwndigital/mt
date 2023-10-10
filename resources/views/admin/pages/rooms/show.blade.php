@extends('layouts.admin')
@push('page-title')
    Admin View {{ $room->name }}
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
                    <div class="row">
                        <div class="col-md-8">
                            <h1>{{ $room->name }}</h1>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('admin.rooms.index') }}" class="blueBtn">
                                    <i class="fa fa-chevron-left"></i> All Rooms
                                </a>
                            </div>
                        </div>
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
                        <a href="{{ route('admin.rooms.edit', $room->id) }}" class="editBtn">Edit</a>
                        <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST">
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
                    <table class="table showTable">
                        <tbody>
                            <tr>
                                <td><strong>Room Name:</strong></td>
                                <td>{{ $room->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Type of Room:</strong></td>
                                <td>{{ $room->room_type }}</td>
                            </tr>
                            <tr>
                                <td><strong>Bathroom Type:</strong></td>
                                <td>{{ str_replace('_', ' ', $room->bathroom_type) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Adult Capacity:</strong></td>
                                <td>{{ $room->adult_cap }}</td>
                            </tr>
                            <tr>
                                <td><strong>Child Capacity</strong></td>
                                <td>{{ $room->child_cap }}</td>
                            </tr>
                            <tr>
                                <td><strong>Description:</strong></td>
                                <td>{!! $room->description !!}</td>
                            </tr>
                            <tr>
                                <td><strong>Short Description:</strong></td>
                                <td>{!! $room->short_description !!}</td>
                            </tr>
                            <tr>
                                <td><strong>Price Per Night:</strong></td>
                                <td>£{{ $room->price_per_night }}</td>
                            </tr>
                            <tr>
                                <td><strong>Featured Image:</strong></td>
                                <td>
                                    <img style="display: block; height: 100px; margin: 0; width: auto;" class="img-fluid" src="{{ Storage::url($room->featured_image) }}">
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Slug:</strong></td>
                                <td>{{ config('app.url') }}/{{ $room->slug }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
