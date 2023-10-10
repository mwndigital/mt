@extends('layouts.admin')
@push('page-title')
    Admin Edit Homepage content
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
                    <h1>Edit Homepage Content</h1>
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
                    <form action="{{ route('admin.homepage.update', ['homepage' => $hpcontent->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12">
                                <label for="">Page Title</label>
                                <input type="text" name="page_title" id="page_title" value="{{ old('page_title', $hpcontent->page_title) }}">
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
                                <input type="text" name="hero_banner_title" id="hero_banner_title" value="{{ old('hero_banner_title', $hpcontent->hero_banner_title) }}" required>
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
                                <input type="text" name="hero_banner_content" id="hero_banner_content" value="{{ old('hero_banner_content', $hpcontent->hero_banner_content) }}" required>
                                @error('hero_banner_content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Background Image *</label>
                                <input type="file" name="hero_banner_background_image" id="hero_banner_background_image">
                                @error('hero_banner_background_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Current background image</label>
                                @if($hpcontent->hero_banner_background_image)
                                    <img class="img-fluid" src="{{ Storage::url($hpcontent->hero_banner_background_image) }}" style="display: block; height: 150px; margin-left: 0; width: auto;">
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
                            <div class="col-md-6">
                                <label for="">Banner image *</label>
                                <input type="file" name="banner_one_image" id="banner_one_image">
                                @error('banner_one_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Current image</label>
                                @if($hpcontent->banner_one_image)
                                    <img class="img-fluid" src="{{ Storage::url($hpcontent->banner_one_image) }}" style="display: block; height: 150px; margin-left: 0; width: auto;">
                                @else
                                    No featured image currently set
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Title *</label>
                                <input type="text" name="banner_one_title" id="banner_one_title" value="{{ old('banner_one_title', $hpcontent->banner_one_title) }}" >
                                @error('banner_one_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Content *</label>
                                <textarea name="banner_one_content" id="banner_one_content" cols="30" rows="10" class="tinyEditor">{{ old('banner_one_content', $hpcontent->banner_one_content) }}</textarea>
                                @error('banner_one_content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Button link *</label>
                                <input type="text" name="banner_one_button_link" id="banner_one_button_link" value="{{ old('banner_one_button_link', $hpcontent->banner_one_button_link) }}" required>
                                @error('banner_one_button_link')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h4 class="pageSecTitle my-4">Rooms Banner</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Sub-title *</label>
                                <input type="text" name="rooms_banner_sub_title" id="rooms_banner_sub_title" value="{{ old('rooms_banner_sub_title', $hpcontent->rooms_banner_sub_title) }}" required>
                                @error('rooms_banner_sub_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Title *</label>
                                <input type="text" name="rooms_banner_title" id="rooms_banner_title" value="{{ old('rooms_banner_title', $hpcontent->rooms_banner_title) }}" required>
                                @error('rooms_banner_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Content *</label>
                                <textarea name="rooms_banner_content" id="rooms_banner_content" cols="30" rows="10" class="tinyEditor">{{ old('rooms_banner_content', $hpcontent->rooms_banner_content) }}</textarea>
                                @error('rooms_banner_content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Button Link *</label>
                                <input type="text" name="rooms_banner_button_link" id="rooms_banner_button_link" value="{{ old('rooms_banner_button_link', $hpcontent->rooms_banner_button_link) }}" required>
                                @error('rooms_banner_button_link')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h4 class="pageSecTitle my-4">Spend the night banner</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Title *</label>
                                <input type="text" name="spend_night_banner_title" id="spend_night_banner_title" value="{{ old('spend_night_banner_title', $hpcontent->spend_night_banner_title) }}" required>
                                @error('spend_night_banner_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Content *</label>
                                <textarea name="spend_night_banner_content" id="spend_night_banner_content" cols="30" rows="10" class="tinyEditor">{{ old('spend_night_banner_content', $hpcontent->spend_night_banner_content) }}</textarea>
                                @error('spend_night_banner_content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Button link *</label>
                                <input type="text" name="spend_night_banner_button_link" id="spend_night_banner_button_link" value="{{ old('spend_night_banner_button_link', $hpcontent->spend_night_banner_button_link) }}" required>
                                @error('spend_night_banner_button_link')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Background Image *</label>
                                <input type="file" name="spend_night_banner_background_image" id="spend_night_banner_background_image">
                                @error('spend_night_banner_background_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Current background image</label>
                                @if($hpcontent->spend_night_banner_background_image)
                                    <img class="img-fluid" src="{{ Storage::url($hpcontent->spend_night_banner_background_image) }}" style="display: block; height: 150px; margin-left: 0; width: auto;">
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
                                <textarea name="page_description" id="page_description" cols="30" rows="10">{{ old('page_description', $hpcontent->page_description) }}</textarea>
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
                                <textarea name="page_keywords" id="page_keywords" cols="30" rows="10">{{ old('page_keywords', $hpcontent->page_keywords) }}</textarea>
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
                                @if($hpcontent->page_image)
                                    <img class="img-fluid" src="{{ Storage::url($hpcontent->page_image) }}" style="display: block; height: 150px; margin-left: 0; width: auto;">
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
        </div>
    </section>
@endsection
