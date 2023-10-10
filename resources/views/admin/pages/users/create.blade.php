@extends('layouts.admin')
@push('page-title')
    Admin User management Create
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
                    <h1>Create user</h1>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.users.index') }}" class="blueBtn">
                            <i class="fas fa-chevron-left"></i>Add User
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pageMain div container">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('admin.users.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">First Name *</label>
                            <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required>
                            @error('first_name')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="">Last Name *</label>
                            <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required>
                            @error('last_name')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="">Email *</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Password *</label>
                            <input type="password" name="password" id="password"  required>
                        </div>
                        <div class="col-md-6">
                            <label for="">Password Confirmation *</label>
                            <input type="password" name="confirmation_password" id="confirmation_password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <small>Please ensure the password you input is 6 alpha numerical characters or longer</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="">Role *</label>
                            <select name="role" id="role" required>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-12 d-flex justify-content-end">
                            <button class="darkGoldBtn" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection
