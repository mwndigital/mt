@extends('layouts.admin')
@push('page-title')
    Admin All Restaurant Blocked Dates
@endpush
@push('page-scripts')

@endpush
@push('page-styles')

@endpush
@section('content')
    <section class="pageHero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1>All Restaurant Blocked Dates</h1>
                </div>
                <div class="col-md-4 d-flex justify-content-end">
                    <a href="{{ route('admin.restaurant-blocked-dates.create') }}" class="blueBtn">
                        Add blocked date <i class="fas fa-plus"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="pageMain">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table class="table w-100">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($blockedDates as $date)
                                <tr>
                                    <td>{{ date('d/m/Y', strtotime($date->date)) }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="dropdown-toggle" role="button" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <form
                                                            action="{{ route('admin.restaurant-blocked-dates.destroy', $date->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="deleteBtn"
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
