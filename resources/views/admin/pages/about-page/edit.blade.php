@extends('layouts.admin')
@push('page-title')
    Admin Edit About Us Page
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
                    <h1>Edit About Us Page</h1>
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
                    <form action="{{ route('admin.about-us.update', ['about_u' => $apc->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-12">
                                <label for="">Page Title *</label>
                                <input type="text" name="page_title" id="page_title" value="{{ old('page_title', $apc->page_title) }}" required>
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
                                <input type="text" name="hero_banner_title" id="hero_banner_title" value="{{ old('hero_banner_title', $apc->hero_banner_title) }}" required>
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
                                <input type="file" name="hero_banner_background_image" id="hero_banner_background_image">
                                @error('hero_banner_background_image')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Current background image:</label>
                                @if($apc->hero_banner_background_image)
                                    <img class="img-fluid" src="{{ Storage::url($apc->hero_banner_background_image) }}" style="display: block; height: 150px; margin-left: 0; width: auto;">
                                @else
                                    No featured image currently set
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <h4 class="pageSecTitle my-4">About Banner</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Title *</label>
                                <input type="text" name="about_banner_title" id="about_banner_title" value="{{ old('about_banner_title', $apc->about_banner_title) }}" required>
                                @error('about_banner_title')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Content *</label>
                                <textarea name="about_banner_content" id="about_banner_content" cols="30" rows="10" class="tinyEditor" required>{{ old('about_banner_content', $apc->about_banner_content) }}</textarea>
                                @error('about_banner_content')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Image *</label>
                                <input type="file" name="about_banner_image" id="about_banner_image">
                                @error('about_banner_image')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Current image</label>
                                @if($apc->about_banner_image)
                                    <img class="img-fluid" src="{{ Storage::url($apc->about_banner_image) }}" style="display: block; height: 150px; margin-left: 0; width: auto;">
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
                                <label for="">Image *</label>
                                <input type="file" name="banner_one_image" id="banner_one_image">
                                @error('banner_one_image')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                @if($apc->banner_one_image)
                                    <img class="img-fluid" src="{{ Storage::url($apc->banner_one_image) }}" style="display: block; height: 150px; margin-left: 0; width: auto;">
                                @else
                                    No featured image currently set
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Content *</label>
                                <textarea name="banner_one_content" id="banner_one_content" cols="30" rows="10" class="tinyEditor" required>{{ old('banner_one_content', $apc->banner_one_content) }}</textarea>
                                @error('banner_one_content')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
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
                                <input type="text" name="banner_two_title" id="banner_two_title" value="{{ old('banner_two_title', $apc->banner_two_title) }}" required>
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
                                <textarea name="banner_two_content" id="banner_two_content" cols="30" rows="10" class="tinyEditor" required>{{ old('banner_two_content', $apc->banner_two_content) }}</textarea>
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
                                <input type="file" name="banner_two_image" id="banner_two_image" >
                                @error('banner_two_image')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Current Image</label>
                                @if($apc->banner_two_image)
                                    <img class="img-fluid" src="{{ Storage::url($apc->banner_two_image) }}" style="display: block; height: 150px; margin-left: 0; width: auto;">
                                @else
                                    No featured image currently set
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
