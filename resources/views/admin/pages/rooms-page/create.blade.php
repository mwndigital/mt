@extends('layouts.admin')
@push('page-title')

@endpush
@push('page-scripts')

@endpush
@push('page-styles')

@endpush
@section('content')
    <section class="pageHero">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>
                        Rooms page content
                    </h1>
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
                <form action="{{ route('admin.rooms-page.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <label for="">Page Title</label>
                            <input type="text" name="page_title" id="page_title" value="{{ old('page_title') }}">
                            @error('page_title')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h4 class="pageSecTitle my-4">Hero Banner</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="">Title *</label>
                            <input type="text" name="hero_banner_title" id="hero_banner_title"
                                   value="{{ old('hero_banner_title') }}" required>
                            @error('hero_banner_title')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="">Background image *</label>
                            <input type="file" name="hero_banner_background_image" id="hero_banner_background_image"
                                   required>
                            @error('hero_banner_background_image')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h4 class="pageSecTitle my-4">Info Banner One</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="">Content *</label>
                            <textarea name="rooms_info_banner_content" id="rooms_info_banner_content" cols="30"
                                      rows="10" class="tinyEditor"
                                      required>{{ old('rooms_info_banner_content') }}</textarea>
                            @error('rooms_info_banner_content')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="darkGoldBtn">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
