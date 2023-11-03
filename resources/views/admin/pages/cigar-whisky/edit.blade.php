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
                    <h1>Cigar & Whisky shop page content</h1>
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
                    <form action="{{ route('admin.cigar-whisky-page.update', ['cigar_whisky_page' => $content->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-12">
                                <label for="">Page Title *</label>
                                <input type="text" name="page_title" id="page_title" value="{{ old('page_title', $content->page_title) }}"
                                       required>
                                @error('page_title')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <hr>
                                <h2>Hero Banner</h2>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Title *</label>
                                <input type="text" name="hero_title" id="hero_title" value="{{ old('hero_title', $content->hero_title) }}" required>
                                @error('hero_title')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Content *</label>
                                <textarea name="hero_content" id="hero_content" cols="30" rows="10" class="tinyEditor" required>{{ old('hero_content', $content->hero_content) }}</textarea>
                                @error('hero_content')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Background Image *</label>
                                <input type="file" name="hero_bg_image" id="hero_bg_image">
                                @error('hero_bg_image')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Current Image</label>
                                @if($content->hero_bg_image)
                                    <img class="img-fluid" src="{{ Storage::url($content->hero_bg_image) }}"
                                         style="display: block; height: 150px; margin-left: 0; width: auto;">
                                @else
                                    No background image currently set
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <hr>
                                <h2>Banner One</h2>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Title *</label>
                                <input type="text" name="banner_one_title" id="banner_one_title" value="{{ old('banner_one_title', $content->banner_one_title) }}" required>
                                @error('banner_one_title')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Content *</label>
                                <textarea name="banner_one_content" id="banner_one_content" cols="30" rows="10" class="tinyEditor" required>{{ old('banner_one_content', $content->banner_one_content) }}</textarea>
                                @error('banner_one_content')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Image *</label>
                                <input type="file" name="banner_one_image" id="banner_one_image" value="{{ old('banner_one_image') }}">
                                @error('banner_one_image')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-6">
                                    <label for="">Current Image</label>
                                    @if($content->banner_one_image)
                                        <img class="img-fluid" src="{{ Storage::url($content->banner_one_image) }}"
                                             style="display: block; height: 150px; margin-left: 0; width: auto;">
                                    @else
                                        No banner image currently set
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <hr>
                                <h2>Banner Two</h2>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Title *</label>
                                <input type="text" name="banner_two_title" id="banner_two_title" value="{{ old('banner_two_title', $content->banner_two_title) }}" required>
                                @error('banner_two_title')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Content *</label>
                                <textarea name="banner_two_content" id="banner_two_content" cols="30" rows="10" class="tinyEditor" required>{{ old('banner_two_content', $content->banner_two_content) }}</textarea>
                                @error('banner_two_content')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Image *</label>
                                <input type="file" name="banner_two_image" id="banner_two_image" value="{{ old('banner_two_image') }}">
                                @error('banner_two_image')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-6">
                                    <label for="">Current Image</label>
                                    @if($content->banner_two_image)
                                        <img class="img-fluid" src="{{ Storage::url($content->banner_two_image) }}"
                                             style="display: block; height: 150px; margin-left: 0; width: auto;">
                                    @else
                                        No banner image currently set
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <hr>
                                <h2>Banner three</h2>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Title *</label>
                                <input type="text" name="banner_three_title" id="banner_three_title" value="{{ old('banner_three_title', $content->banner_three_title) }}" required>
                                @error('banner_three_title')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Content *</label>
                                <textarea name="banner_three_content" id="banner_three_content" cols="30" rows="10" class="tinyEditor" required>{{ old('banner_three_content', $content->banner_three_content) }}</textarea>
                                @error('banner_three_content')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Image *</label>
                                <input type="file" name="banner_three_image" id="banner_three_image" value="{{ old('banner_three_image') }}">
                                @error('banner_three_image')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-6">
                                    <label for="">Current Image</label>
                                    @if($content->banner_three_image)
                                        <img class="img-fluid" src="{{ Storage::url($content->banner_three_image) }}"
                                             style="display: block; height: 150px; margin-left: 0; width: auto;">
                                    @else
                                        No banner image currently set
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-12">
                                <hr>
                                <h2>SEO</h2>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">SEO Title</label>
                                <input type="text" name="seo_title" id="seo_title" value="{{ old('seo_title', $content->seo_title) }}">
                                @error('seo_title')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">SEO Description</label>
                                <textarea name="seo_description" id="seo_description" cols="30"
                                          rows="10">{{ old('seo_description', $content->seo_description) }}</textarea>
                                @error('seo_description')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">SEO Keywords</label>
                                <textarea name="seo_keywords" id="seo_keywords" cols="30"
                                          rows="10">{{ old('seo_keywords', $content->seo_keywords) }}</textarea>
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
                                <label for="">Current Image</label>
                                @if($content->seo_image)
                                    <img class="img-fluid" src="{{ Storage::url($content->seo_image) }}"
                                         style="display: block; height: 150px; margin-left: 0; width: auto;">
                                @else
                                    No banner image currently set
                                @endif
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
        </div>
    </section>
@endsection
