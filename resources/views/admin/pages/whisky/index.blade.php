@extends('layouts.admin')
@push('page-title')
    Admin Whisky
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
                    <h1>All Whisky Selection</h1>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.whisky.create') }}" class="blueBtn">
                            Add Whisky Item <i class="fas fa-plus"></i>
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
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Drink size</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($whisky as $whisky)
                            <tr>
                                <td>{{ $whisky->name }}</td>
                                <td>£{{ $whisky->price }}</td>
                                <td>{{ $whisky->drink_size }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="dropdown-toggle" role="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a href="{{ route('admin.whisky.show', $whisky->id) }}">View</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('admin.whisky.edit', $whisky->id) }}">Edit</a>
                                                </li>
                                                <li>
                                                    <form action="{{ route('admin.whisky.destroy', $whisky->id) }}"
                                                          method="POST">
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
    </section>
@endsection
