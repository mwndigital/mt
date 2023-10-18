@extends('layouts.admin')
@push('page-title')
    Admin Homepage content
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
                    <h1>Homepage Content</h1>
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
                    <h4 class="pageSecTitle">Hero Banner</h4>
                    <form action="{{ route('admin.homepage.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
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
                                <label for="">Content *</label>
                                <input type="text" name="hero_banner_content" id="hero_banner_content"
                                       value="{{ old('hero_banner_content') }}" required>
                                @error('hero_banner_content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Background Image *</label>
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
                                <h4 class="pageSecTitle my-4">Banner One</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Banner image *</label>
                                <input type="file" name="banner_one_image" id="banner_one_image">
                                @error('banner_one_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Title *</label>
                                <input type="text" name="banner_one_title" id="banner_one_title"
                                       value="{{ old('banner_one_title') }}" required>
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
                                <textarea name="banner_one_content" id="banner_one_content" cols="30" rows="10"
                                          class="tinyEditor">{{ old('banner_one_content') }}</textarea>
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
                                <input type="text" name="banner_one_button_link" id="banner_one_button_link"
                                       value="{{ old('banner_one_button_link') }}" required>
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
                                <input type="text" name="rooms_banner_sub_title" id="rooms_banner_sub_title"
                                       value="{{ old('rooms_banner_sub_title') }}" required>
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
                                <input type="text" name="rooms_banner_title" id="rooms_banner_title"
                                       value="{{ old('rooms_banner_title') }}" required>
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
                                <textarea name="rooms_banner_content" id="rooms_banner_content" cols="30" rows="10"
                                          class="tinyEditor">{{ old('rooms_banner_content') }}</textarea>
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
                                <input type="text" name="rooms_banner_button_link" id="rooms_banner_button_link"
                                       value="{{ old('rooms_banner_button_link') }}" required>
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
                                <input type="text" name="spend_night_banner_title" id="spend_night_banner_title"
                                       value="{{ old('spend_night_banner_title') }}" required>
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
                                <textarea name="spend_night_banner_content" id="spend_night_banner_content" cols="30"
                                          rows="10"
                                          class="tinyEditor">{{ old('spend_night_banner_content') }}</textarea>
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
                                <input type="text" name="spend_night_banner_button_link"
                                       id="spend_night_banner_button_link"
                                       value="{{ old('spend_night_banner_button_link') }}" required>
                                @error('spend_night_banner_button_link')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Background Image *</label>
                                <input type="file" name="spend_night_banner_background_image"
                                       id="spend_night_banner_background_image" required>
                                @error('spend_night_banner_background_image')
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
        </div>
    </section>
@endsection
