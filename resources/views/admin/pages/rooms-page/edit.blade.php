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
                <form action="{{ route('admin.rooms-page.update', ['rooms_page' => $content->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-12">
                            <label for="">Page Title</label>
                            <input type="text" name="page_title" id="page_title" value="{{ old('page_title', $content->page_title) }}">
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
                            <input type="text" name="hero_banner_title" id="hero_banner_title" value="{{ old('hero_banner_title', $content->hero_banner_title) }}" required>
                            @error('hero_banner_title')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="">Content *</label>
                            <textarea name="hero_content" id="hero_content" cols="30" rows="10" class="tinyEditor" required> {{ old('hero_content', $content->hero_content) }}</textarea>
                            @error('hero_content')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
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
                            @if($content->hero_banner_background_image)
                                <img class="img-fluid" src="{{ Storage::url($content->hero_banner_background_image) }}" style="display: block; height: 150px; margin-left: 0; width: auto;">
                            @else
                                No background image currently set
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h4 class="pageSecTitle my-4">SEO</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="">SEO Title</label>
                            <input type="text" name="seo_title" id="seo_title" value="{{ old('seo_title') }}">
                            @error('seo_title')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">SEO Description</label>
                            <textarea name="seo_description" id="seo_description" cols="30" rows="10">{{ old('seo_description') }}</textarea>
                            @error('seo_description')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="">SEO Keywords</label>
                            <textarea name="seo_keywords" id="seo_keywords" cols="30" rows="10">{{ old('seo_keywords') }}</textarea>
                            @error('seo_keywords')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">SEO Image</label>
                            <input type="file" name="seo_image" id="seo_image">
                            @error('seo_image')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="">Current SEO Image</label>
                            @if($content->seo_image)
                                <img class="img-fluid" src="{{ Storage::url($content->seo_image) }}" style="display: block; height: 150px; margin-left: 0; width: auto;">
                            @else
                                No SEO Image is set
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
