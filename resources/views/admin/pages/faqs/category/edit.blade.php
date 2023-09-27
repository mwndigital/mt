@extends('layouts.admin')
@push('page-title')
    Admin Edit {{ $category->name }} FAQ Category
@endpush
@push('page-scripts')

@endpush
@push('page-styles')

@endpush
@section('content')
    <section class="pageHero">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <h1>Edit {{ $category->name }}FAQ Category</h1>
                </div>
                <div class="col-md-3 d-flex justify-content-end">
                    <a href="{{ route('admin.faq-category.index') }}" class="blueBtn"><i class="fas fa-chevron-left"></i> All Categories</a>
                </div>
            </div>
        </div>
    </section>
    <section class="pageMain">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.faq-category.update', $category->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Name *</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required>
                                @error('name')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Order</label>
                                <input type="number" name="order" id="order" value="{{ $category->order }}" required>
                                @error('order')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="darkGoldBtn">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
