@extends('layouts.admin')
@push('page-title')
    Admin Create Restaurant Blocked Date
@endpush
@section('content')
    <section class="pageHero">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1>Create Blocked Date</h1>
                </div>
                <div class="col-md-4 d-flex justify-content-end">
                    <a href="{{ route('admin.restaurant-blocked-dates.index') }}" class="blueBtn">
                        <i class="fas fa-chevron-left"></i> All Blocked Dates
                    </a>
                </div>
            </div>
        </div>
    </section>

    @if($errors->any())
        <div class="flex flex-row alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="pageMain">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.restaurant-blocked-dates.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label for="">Date *</label>
                                <input type="date" name="date" id="date" value="{{ old('date') }}" required>
                                @error('date')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="darkGoldBtn">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
