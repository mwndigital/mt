@extends('layouts.admin')
@push('page-title')
    Admin Edit Gallery Item
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
                    <h1>Create Gallery Item</h1>
                </div>
                <div class="col-md-4 d-flex justify-content-end">
                    <a href="{{ route('admin.gallery.index') }}" class="blueBtn">
                        <i class="fas fa-chevron-left"></i> All Gallery Items
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
                    <form action="{{ route('admin.gallery.update', $item->id) }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-12">
                                <label for="">Name *</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $item->name) }}"
                                       required>
                                @error('name')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Image *</label>
                                <input type="file" name="image" id="image">
                                @error('image')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Current Image</label>
                                <img class="img-fluid" style="display: block; height: 100px; margin: 0; width: 100px;"
                                     src="{{ Storage::url($item->image) }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Category *</label>
                                <select name="category_id" id="category_id" required>
                                    <option selected disabled>-- Choose a category --</option>
                                    @foreach($category as $cat)
                                        <option value="{{ $cat->id }}"
                                                @if($cat->id == $item->category_id) selected @endif>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
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
