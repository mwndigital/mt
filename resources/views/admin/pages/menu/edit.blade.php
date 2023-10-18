@extends('layouts.admin')
@push('page-title')
    Admin Edit {{ $menu->name }} Menu Item
@endpush
@push('page-scripts')

@endpush
@push('page-styles')
    <script>
        $(document).ready(function () {
            tinymce.init({
                selector: '#description',
                plugins: 'code table lists',
                toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
                setup: function (editor) {
                    editor.on('init', function () {
                        var storedValue = {!! json_encode($menu->description) !!};
                        editor.setContent(storedValue);
                    });
                }
            });
        });
    </script>
@endpush
@section('content')
    <section class="pageHero">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1>Edit {{ $menu->name }}</h1>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.menu-category.index') }}" class="blueBtn">
                            <i class="fa fa-chevron-left"></i> All Menu Items
                        </a>
                    </div>
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
                    <form action="{{ route('admin.menu.update', $menu->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-12">
                                <label for="">Name *</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $menu->name) }}"
                                       required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Description *</label>
                                <textarea name="description" id="description" cols="30" rows="10" class=""
                                          required>{{ old('description') }}</textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Price *</label>
                                <input type="number" name="price" id="pruce" step="any"
                                       value="{{ old('price', $menu->price) }}" required>
                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Category *</label>
                                <select name="category" id="category" required>
                                    @foreach($category as $cat)
                                        <option value="{{ $cat->name }}"
                                                @if($cat->name == $menu->category) selected @endif>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Image</label>
                                <input type="file" name="image" id="image">
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Current Image</label>
                                @if($menu->image)
                                    <img style="display: block; height: 100px; margin: 0; width: auto;"
                                         class="img-fluid" src="{{ Storage::url($menu->image) }}">
                                @else
                                    <small>Currently no image set</small>
                                @endif
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="darkGoldBtn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
