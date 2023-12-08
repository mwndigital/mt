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
                        Contact Us Page Content
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
                <div class="col-12">
                    <form action="{{ route('admin.contact-page.update', ['contact_page' => $content->id]) }}"
                          method="post" enctype="multipart/form-data">
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
                                <hr>
                                <h2>Hero Banner</h2>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Title *</label>
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
                                <div class="col-12">
                                    <label for="">Sub title *</label>
                                    <textarea name="hero_sub_title" id="hero_sub_title" cols="30" rows="10"
                                              class="tinyEditor"
                                              required>{{ old('hero_sub_title', $content->hero_sub_title) }}</textarea>
                                    @error('hero_sub_title')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Background Image *</label>
                                <input type="file" name="hero_background_image" id="hero_background_image" required>
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
                                <hr>
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
                                          class="tinyEditor"
                                          required>{{ old('banner_one_content', $content->banner_one_content) }}</textarea>
                                @error('banner_one_content')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Images *</label>
                                <input type="file" name="banner_one_images[]" id="banner_one_images[]" required>
                                @error('banner_one_images')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                                <small>Please ensure images are no larger than 1500px wide.</small>
                            </div>
                            <div class="col-md-6">
                                <label for="">Current Images</label>
                                @if (!empty($content->banner_one_images))
                                    @foreach (json_decode($content->banner_one_images) as $imagePath)
                                        <img src="{{ Storage::url($imagePath) }}" alt="Image">
                                    @endforeach
                                @endif
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
                                <label for="">Current background image</label>
                                @if($content->seo_image)
                                    <img class="img-fluid" src="{{ Storage::url($content->seo_image) }}"
                                         style="display: block; height: 150px; margin-left: 0; width: auto;">
                                @else
                                    No Seo image set
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
