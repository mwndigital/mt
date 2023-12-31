@extends('layouts.admin')
@push('page-title')
    Admin Create about page
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
                    <h1>Create About Us Page</h1>
                </div>
            </div>
        </div>
    </section>
    @if($errors->any())
        <div class="errors">
            <div class="row">
                <div class="col-12">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
    <section class="pageMain">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.about-us.store') }}" method="post" enctype="multipart/form-data">
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
                                <h4 class="pageSecTitle my-4">Hero Banner</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Title *</label>
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
                                <label for="">Content *</label>
                                <textarea name="hero_content" id="hero_content" cols="30" rows="10" class="tinyEditor" required>{{ old('hero_content') }}</textarea>
                                @error('hero_content')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
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
                                <textarea name="banner_one_content" id="banner_one_content" cols="30" rows="10" class="tinyEditor" required>{{ old('banner_one_content') }}</textarea>
                                @error('banner_one_content')
                                    <div class="text-danger">
                                        {{ $message }}
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
                                <textarea name="banner_two_content" id="banner_two_content" cols="30" rows="10" class="tinyEditor" required>{{ old('banner_two_content') }}</textarea>
                                @error('banner_two_content')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h4 class="pageSecTitle my-4">Banner Three</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Title *</label>
                                <input type="text" name="banner_three_title" id="banner_three_title" value="{{ old('banner_three_title') }}">
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
                                <textarea name="banner_three_content" id="banner_three_content" cols="30" rows="10" class="tinyEditor" required>{{ old('banner_three_content') }}</textarea>
                                @error('banner_three_content')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h4 class="pageSecTitle my-4">Banner Four</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Title *</label>
                                <input type="text" name="banner_four_title" id="banner_four_title" value="{{ old('banner_four_title') }}" required>
                                @error('banner_four_title')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Content *</label>
                                <textarea name="banner_four_content" id="banner_four_content" cols="30" rows="10" class="tinyEditor" required>{{ old('banner_four_content') }}</textarea>
                                @error('banner_four_content')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h4 class="pageSecTitle my-4">Banner Five</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Title *</label>
                                <input type="text" name="banner_five_title" id="banner_five_title" value="{{ old('banner_five_title') }}" required>
                                @error('banner_five_title')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Content *</label>
                                <textarea name="banner_five_content" id="banner_five_content" cols="30" rows="10" class="tinyEditor" required>{{ old('banner_five_content') }}</textarea>
                                @error('banner_five_content')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <h4 class="pageSecTitle my-4">Banner Six</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Title * </label>
                                <input type="text" name="banner_six_title" id="banner_six_title" value="{{ old('banner_six_title') }}" required>
                                @error('banner_six_title')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Content *</label>
                                <textarea name="banner_six_content" id="banner_six_content" cols="30" rows="10" class="tinyEditor" required>{{ old('banner_six_content') }}</textarea>
                                @error('banner_sic_content')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h4 class="pageSecTitle my-4">Banner Seven</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Title *</label>
                                <input type="text" name="banner_seven_title" id="banner_seven_title" value="{{ old('banner_seven_title') }}" required>
                                @error('banner_seven_title')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Content *</label>
                                <textarea name="banner_seven_content" id="banner_seven_content" cols="30" rows="10" class="tinyEditor" required> {{ old('banner_seven_content')  }}</textarea>
                                @error('banner_seven_content')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h4 class="pageSecTitle my-4">Banner Eight</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Title *</label>
                                <input type="text" name="banner_eight_title" id="banner_eight_title" value="{{ old('banner_eight_title') }}" required>
                                @error('banner_eight_title')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Content *</label>
                                <textarea name="banner_eight_content" id="banner_eight_content" cols="30" rows="10" class="tinyEditor" required>{{ old('banner_eight_content') }}</textarea>
                                @error('banner_eight_content')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
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
