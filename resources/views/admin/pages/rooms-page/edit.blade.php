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
                <form action="{{ route('admin.rooms-page.update', ['rooms_page' => $rpc->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-12">
                            <label for="">Page Title</label>
                            <input type="text" name="page_title" id="page_title" value="{{ old('page_title', $rpc->page_title) }}">
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
                            <input type="text" name="hero_banner_title" id="hero_banner_title" value="{{ old('hero_banner_title', $rpc->hero_banner_title) }}" required>
                            @error('hero_banner_title')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Background image *</label>
                            <input type="file" name="hero_banner_background_image" id="hero_banner_background_image">
                            @error('hero_banner_background_image')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="">Current image</label>
                            @if($rpc->hero_banner_background_image)
                                <img class="img-fluid" src="{{ Storage::url($rpc->hero_banner_background_image) }}" style="display: block; height: 150px; margin-left: 0; width: auto;">
                            @else
                                No background image currently set
                            @endif
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
                            <textarea name="rooms_info_banner_content" id="rooms_info_banner_content" cols="30" rows="10" class="tinyEditor" required>{{ old('rooms_info_banner_content', $rpc->rooms_info_banner_content) }}</textarea>
                            @error('rooms_info_banner_content')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h4 class="pageSecTitle my-4">SEO</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="">Page Description</label>
                            <textarea name="page_description" id="page_description" cols="30" rows="10">{{ old('page_description', $rpc->page_description) }}</textarea>
                            @error('page_description')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="">Page Keywords</label>
                            <small>Please use comma's to separate keywords/phrases</small>
                            <textarea name="page_keywords" id="page_keywords" cols="30" rows="10">{{ old('page_keywords', $rpc->page_keywords) }}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Social Media image</label>
                            <small>This is the image you want to use on social media when posting a link to this page</small>
                            <br>
                            <input type="file" name="page_image" id="page_image">
                        </div>
                        <div class="col-md-6">
                            <label for="">Current page image</label>
                            @if($rpc->page_image)
                                <img class="img-fluid" src="{{ Storage::url($rpc->page_image) }}" style="display: block; height: 150px; margin-left: 0; width: auto;">
                            @else
                                No page image currently set
                            @endif
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
    </section>
@endsection
