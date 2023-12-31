@extends('layouts.admin')
@push('page-title')
    Dining Page Content
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
                    <h1>Dining Page Content</h1>
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
                    <form action="{{ route('admin.dining-page.update', $content->id) }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-12">
                                <label for="">Page Title *</label>
                                <input type="text" name="page_title" id="page_title"
                                       value="{{ old('page_title', $content->page_title) }}" required>
                                @error('page_title')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h2>Hero</h2>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Hero Title *</label>
                                <input type="text" name="hero_title" id="hero_title"
                                       value="{{ old('hero_title', $content->hero_title) }}" required>
                                @error('hero_title')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Hero Content *</label>
                                <textarea name="hero_content" id="hero_content" cols="30" rows="10"
                                          class="tinyEditor">{{ old('hero_content', $content->hero_content) }}</textarea>
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
                                @error('hero_background_image')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                                <small>Please ensure images are no larger than 1500px wide.</small>

                            </div>
                            <div class="col-md-6">
                                <label for="">Current background image</label>
                                @if($content->hero_background_image)
                                    <img class="img-fluid" src="{{ Storage::url($content->hero_background_image) }}"
                                         style="display: block; height: 150px; margin-left: 0; width: auto;">
                                @else
                                    No background image currently set
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h2>Banner One</h2>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Title *</label>
                                <input type="text" name="banner_one_title" id="banner_one_title"
                                       value="{{ old('banner_one_title', $content->banner_one_title) }}" required>
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
                                <textarea name="banner_one_content" id="banner_one_content" cols="30" rows="10"
                                          class="tinyEditor">{{ old('banner_one_content', $content->banner_one_content) }}</textarea>
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
                                <input type="file" name="banner_one_image" id="banner_one_image">
                                @error('banner_one_image')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                                <small>Please ensure images are no larger than 1500px wide.</small>
                            </div>
                            <div class="col-md-6">
                                <label for="">Current image</label>
                                @if($content->banner_one_image)
                                    <img class="img-fluid" src="{{ Storage::url($content->banner_one_image) }}"
                                         style="display: block; height: 150px; margin-left: 0; width: auto;">
                                @else
                                    No image currently set
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Carousel/slider images</label>
                                <input type="file" name="images[]" id="images[]" multiple>
                                <small>Please ensure images are no larger than 1500px wide.</small>
                            </div>
                            <div class="col-md-6">
                                <label for="">Current carousel images</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <hr>
                                <h2>Book Banner</h2>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Title *</label>
                                <input type="text" name="book_banner_title" id="book_banner_title"
                                       value="{{ old('book_banner_title', $content->book_banner_title) }}" required>
                                @error('book_banner_title')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Content *</label>
                                <textarea name="book_banner_content" id="book_banner_content" cols="30" rows="10"
                                          class="tinyEditor"
                                          required>{{ old('book_banner_content', $content->book_banner_content) }}</textarea>
                                @error('book_banner_content')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-dm-6">
                                <label for="">Image *</label>
                                <input type="file" name="book_banner_background_image"
                                       id="book_banner_background_image">
                                @error('book_banner_background_image')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                                <small>Please ensure images are no larger than 1500px wide.</small>
                            </div>
                            <div class="col-md-6">
                                <label for="">Current image</label>
                                @if($content->book_banner_background_image)
                                    <img class="img-fluid"
                                         src="{{ Storage::url($content->book_banner_background_image) }}"
                                         style="display: block; height: 150px; margin-left: 0; width: auto;">
                                @else
                                    No image currently set
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Button Content *</label>
                                <input type="text" name="book_banner_button_content" id="book_banner_button_content"
                                       value="{{ old('book_banner_button_content', $content->book_banner_button_content) }}">
                                @error('book_banner_button_content')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Button Link *</label>
                                <input type="text" name="book_banner_button_link" id="book_banner_button_link"
                                       value="{{ old('book_banner_button_link', $content->book_banner_button_link) }}"
                                       required>
                                @error('book_banner_button_link')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
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
                                <input type="text" name="seo_title" id="seo_title"
                                       value="{{ old('seo_title', $content->seo_title) }}">
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
                                <small>Please ensure images are no larger than 1500px wide.</small>
                            </div>
                            <div class="col-md-6">
                                <label for="">Current image</label>
                                @if($content->seo_image)
                                    <img class="img-fluid" src="{{ Storage::url($content->seo_image) }}"
                                         style="display: block; height: 150px; margin-left: 0; width: auto;">
                                @else
                                    No image currently set
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
        </div>
    </section>

@endsection
