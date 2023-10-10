@extends('layouts.admin')
@push('page-title')

@endpush
@push('page-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('add-image-button').addEventListener('click', function () {
                const imageInputs = document.getElementById('image-inputs');
                const newInput = document.createElement('input');
                newInput.type = 'file';
                newInput.name = 'banner_one_images[]';
                newInput.accept = 'image/*';
                imageInputs.appendChild(newInput);
            });
        });
    </script>
@endpush
@push('page-title')

@endpush
@section('content')
    <section class="pageHero">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Lodge page</h1>
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
    <section class="pageMain div container">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('admin.lodge-page.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <label for="">Page Title *</label>
                            <input type="text" name="page_title" id="page_title" value="{{ old('page_title') }}" required>
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
                            <input type="text" name="hero_title" id="hero_title" value="{{ old('hero_title') }}" required>
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
                            <textarea name="hero_content" id="hero_content" cols="30" rows="10" class="tinyEditor" required>{{ old('hero_content') }}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="">Background Image *</label>
                            <input type="file" name="hero_background_image" id="hero_background_image" required>
                            @error('hero_background_image')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
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
                            <input type="text" name="banner_one_title" id="banner_one_title" value="{{ old('banner_one_title') }}" required>
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
                            <textarea name="banner_one_content" id="banner_one_content" cols="30" rows="10" class="tinyEditor">{{ old('banner_one_content') }}</textarea>
                            @error('banner_one_content')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="">Slider Images</label>
                            @if (!empty($pageContent->banner_one_images))
                                @foreach ($pageContent->banner_one_images as $image)
                                    <img src="{{ asset('storage/' . $image) }}" alt="Image">
                                @endforeach
                            @endif
                            <div id="image-inputs">
                                <input type="file" name="banner_one_images[]" accept="image/*">
                            </div>
                            <button type="button" id="add-image-button" class="blueBtn">Add Image</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h2>Banner Two</h2>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="">Title *</label>
                            <input type="text" name="banner_two_title" id="banner_two_title" value="{{ old('banner_two_title') }}" required>
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
                            <textarea name="banner_two_content" id="banner_two_title" cols="30" rows="10" class="tinyEditor">{{ old('banner_two_content') }}</textarea>
                            @error('banner_two_content')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="">Image *</label>
                            <input type="file" name="banner_two_image" id="banner_two_image" required>
                            @error('banner_two_image')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h2>Banner Three</h2>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="">Title *</label>
                            <input type="text" name="banner_three_title" id="banner_three_title" value="{{ old('banner_three_title') }}" required>
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
                            <textarea name="banner_three_content" id="banner_three_title" cols="30" rows="10" class="tinyEditor">{{ old('banner_three_content') }}</textarea>
                            @error('banner_three_content')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="">Image *</label>
                            <input type="file" name="banner_three_image" id="banner_three_image" required>
                            @error('banner_three_image')
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
                            <input type="text" name="seo_title" id="seo_title" value="{{ old('seo_title') }}">
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
                            <textarea name="seo_description" id="seo_description" cols="30" rows="10">{{ old('seo_description') }}</textarea>
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
                            <textarea name="seo_keywords" id="seo_keywords" cols="30" rows="10">{{ old('seo_keywords') }}</textarea>
                            @error('seo_keywords')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="">SEO Image</label>
                            <input type="file" name="seo_image" id="seo_image">
                            @error('seo_image')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="darkGoldBtn">save</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </section>
@endsection
