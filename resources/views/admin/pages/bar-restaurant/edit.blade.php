@extends('layouts.admin')
@push('page-title')
    Admin Edit Bar & Restaurant Page content
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
                    <h1>Edit Bar & Restaurant Page Content</h1>
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
    <section class="pageMain mb-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.bar-restaurant.update', ['bar_restaurant' => $brc->id]) }}"
                          method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-12">
                                <label for="">Page Title *</label>
                                <input type="text" name="page_title" id="page_title"
                                       value="{{ old('page_title', $brc->page_title) }}" required>
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
                                       value="{{ old('hero_banner_title', $brc->hero_banner_title) }}" required>
                                @error('hero_banner_title')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Background Image *</label>
                                <input type="file" name="hero_banner_background_image"
                                       id="hero_banner_background_image">
                                @error('hero_banner_background_image')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Current background image</label>
                                @if($brc->hero_banner_background_image)
                                    <img class="img-fluid" src="{{ Storage::url($brc->hero_banner_background_image) }}"
                                         style="display: block; height: 150px; margin-left: 0; width: auto;">
                                @else
                                    No featured image currently set
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <h4 class="pageSecTitle my-4">Banner One</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Title * </label>
                                <input type="text" name="banner_one_titke" id="banner_one_title"
                                       value="{{ old('banner_one_title', $brc->banner_one_title) }}">
                                @error('banner_one_title')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Content *</label>
                                <textarea name="banner_one_content" id="banner_one_content" cols="30" rows="10"
                                          class="tinyEditor"
                                          required>{{ old('banner_one_content', $brc->banner_one_content) }}</textarea>
                                @error('banner_one_content')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Big Image *</label>
                                <input type="file" name="banner_one_big_image" id="banner_one_big_image">
                                @error('banner_one_big_image')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Current Big Image</label>
                                @if($brc->banner_one_big_image)
                                    <img class="img-fluid" src="{{ Storage::url($brc->banner_one_big_image) }}"
                                         style="display: block; height: 150px; margin-left: 0; width: auto;">
                                @else
                                    No featured image currently set
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Small Image *</label>
                                <input type="file" name="banner_one_small_image" id="banner_one_small_image">
                                @error('banner_one_small_image')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Current small image</label>
                                @if($brc->banner_one_small_image)
                                    <img class="img-fluid" src="{{ Storage::url($brc->banner_one_small_image) }}"
                                         style="display: block; height: 150px; margin-left: 0; width: auto;">
                                @else
                                    No featured image currently set
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <h4 class="pageSecTitle my-4">Image Separator Banner</h4>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Image *</label>
                                <input type="file" name="separator_banner_image" id="separator_banner_image">
                                @error('separator_banner_image')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Current separator image</label>
                                @if($brc->separator_banner_image)
                                    <img class="img-fluid" src="{{ Storage::url($brc->separator_banner_image) }}"
                                         style="display: block; height: 150px; margin-left: 0; width: auto;">
                                @else
                                    No featured image currently set
                                @endif
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-12">
                                <h4 class="pageSecTitle my-4">Banner Two</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Title *</label>
                                <input type="text" name="banner_two_title" id="banner_two_title"
                                       value="{{ old('banner_two_title', $brc->banner_two_title) }}" required>
                                @error('banner_two_title')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Content *</label>
                                <textarea name="banner_two_content" id="banner_two_content" cols="30" rows="10"
                                          class="tinyEditor"
                                          required>{{ old('banner_two_content', $brc->banner_two_content) }}</textarea>
                                @error('banner_two_content')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Image *</label>
                                <input type="file" name="banner_two_image" id="banner_two_image">
                                @error('banner_two_image')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Current Image</label>
                                @if($brc->banner_two_image)
                                    <img class="img-fluid" src="{{ Storage::url($brc->banner_two_image) }}"
                                         style="display: block; height: 150px; margin-left: 0; width: auto;">
                                @else
                                    No featured image currently set
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <h4 class="pageSecTitle my-4">Book Stay Banner</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Title *</label>
                                <input type="text" name="book_stay_banner_title" id="book_stay_banner_title"
                                       value="{{ old('book_stay_banner_title', $brc->book_stay_banner_title) }}"
                                       required>
                                @error('book_stay_banner_title')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Content *</label>
                                <textarea name="book_stay_banner_content" id="book_stay_banner_content" cols="30"
                                          rows="10" class="tinyEditor"
                                          required>{{ old('book_stay_banner_content', $brc->book_stay_banner_content) }}</textarea>
                                @error('book_stay_banner_content')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Background Image *</label>
                                <input type="file" name="book_stay_banner_background_image"
                                       id="book_stay_banner_background_image">
                                @error('book_stay_banner_background_image')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Current background image</label>
                                @if($brc->book_stay_banner_background_image)
                                    <img class="img-fluid"
                                         src="{{ Storage::url($brc->book_stay_banner_background_image) }}"
                                         style="display: block; height: 150px; margin-left: 0; width: auto;">
                                @else
                                    No featured image currently set
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
                                <label for="">Page Description</label>
                                <textarea name="page_description" id="page_description" cols="30"
                                          rows="10">{{ old('page_description', $brc->page_description) }}</textarea>
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
                                <textarea name="page_keywords" id="page_keywords" cols="30"
                                          rows="10">{{ old('page_keywords', $brc->page_keywords) }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Social Media image</label>
                                <small>This is the image you want to use on social media when posting a link to this
                                    page</small>
                                <br>
                                <input type="file" name="page_image" id="page_image">
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
