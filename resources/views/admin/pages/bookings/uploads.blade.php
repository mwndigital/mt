@extends('layouts.admin')
@push('page-title')
    Admin Room Upload
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
                    <h1>
                        Upload CSV File
                    </h1>
                </div>
                <div class="col-md-4 d-flex justify-content-end">
                    <a href="{{ route('admin.bookings.index') }}" class="blueBtn">
                        <i class="fas fa-chevron-left"></i> All Room Bookings
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="pageMain">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.book-a-room.csv-store') }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label for="">CSV File</label>
                                <input type="file" name="csv_file" id="csv_file">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="darkGoldBtn">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
