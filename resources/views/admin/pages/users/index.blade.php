@extends('layouts.admin')
@push('page-title')
    Admin User management index
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
                            Add User <i class="fas fa-plus"></i>
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
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach ($user->roles as $role)
                                            {{ $role->name }},
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>

                                                    <li>
                                                        <a href="">Edit</a>
                                                    </li>
                                                    @role('super admin')
                                                        <li>
                                                            <form action="" method="POST">
                                                                @csrf
                                                                @method('delete')
                                                                <button class="confirm-delete-btn" type="submit">Delete</button>
                                                            </form>
                                                        </li>
                                                    @endrole
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @role('super admin')
                    <table class="table mt-5">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($superAdmins as $user)
                            <tr>
                                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach ($user->roles as $role)
                                        {{ $role->name }},
                                    @endforeach
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>

                                                <li>
                                                    <a href="">Edit</a>
                                                </li>
                                                @role('super admin')
                                                <li>
                                                    <form action="" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="confirm-delete-btn" type="submit">Delete</button>
                                                    </form>
                                                </li>
                                                @endrole
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @endrole
                </div>
            </div>
        </div>
    </section>
@endsection
