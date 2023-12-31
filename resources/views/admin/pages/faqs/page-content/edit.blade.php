@extends('layouts.admin')
@push('page-title')
    Edit FAQs Page
@endpush

@section('content')
    <section class="pageHero">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Edit FAQ Page Content</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="pageMain">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.faqs-page.update', ['faqs_page' => 1]) }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-12">
                                <label for="">Main Title *</label>
                                <input type="text" name="main_title" id="main_title"
                                       value="{{ old('main_title', $content->main_title) }}" required>
                                @error('main_title')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Sub Title *</label>
                                <textarea name="sub_title" id="sub_title" cols="30" rows="10" class="tinyEditor"
                                          required>{{ old('sub_title', $content->sub_title) }}</textarea>
                                @error('sub_title')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
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
                            <div class="col-md-6">
                                <label for="">SEO Description</label>
                                <textarea name="seo_description" id="seo_description" cols="30"
                                          rows="10">{{ old('seo_description', $content->seo_description) }}</textarea>
                                @error('seo_description')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
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
                                <label for="">Current SEO Image</label>
                                @if($content->seo_image)
                                    <img class="img-fluid" src="{{ Storage::url($content->seo_image) }}"
                                         style="display: block; height: 150px; margin-left: 0; width: auto;">
                                @else
                                    No SEO image has been set
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <button class="darkGoldBtn" type="submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
