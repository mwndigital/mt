@extends('layouts.admin')
@push('page-title')
    Admin Restaurant Tables
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
                    <h1>Restaurant Tables</h1>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.restaurant-tables.create') }}" class="blueBtn">
                            Add Table <i class="fas fa-plus"></i>
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
                    <table class="table table-hovered">
                        <thead>
                            <th>Table Name</th>
                            <th>No of seats</th>
                            <th>Availability</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @foreach($tables as $table)
                                <tr>
                                    <td>{{ $table->name }}</td>
                                    <td>{{ $table->no_of_seats }}</td>
                                    <td>{{ $table->status }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('admin.restaurant-tables.edit', $table->id) }}">Edit</a>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('admin.restaurant-tables.destroy', $table->id) }}" method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="confirm-delete-btn" type='submit'>Delete</button>
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
