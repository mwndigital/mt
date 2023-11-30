@extends('layouts.admin')
@push('page-title')
    Admin Edit about page
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
                    <span class="badge text-bg-warning my-4">
                        Please ensure that images are no bigger than 1300px wide otherwise the system wont process them
                    </span>
                    <form action="{{ route('admin.about-us.update', ['about_u' => $content->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-12">
                                <label for="">Page Title *</label>
                                <input type="text" name="page_title" id="page_title" value="{{ old('page_title', $content->page_title) }}" required>
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
                            <div class="col-12">
                                <label for="">Background image</label>
                                <input type="file" name="hero_bg_image" id="hero_bg_image">
                                @error('hero_bg_image')
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
                            <div class="col-12">
                                <label for="">Image</label>
                                <input type="file" name="banner_one_image" id="banner_one_image">
                                @error('banner_one_image')
                                    <div class="text-danger">
                                        {{ $message  }}
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
                            <div class="col-12">
                                <label for="">Image</label>
                                <input type="file" name="banner_two_image" id="banner_two_image">
                                @error('banner_two_image')
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
                                <input type="text" name="banner_three_title" id="banner_three_title" value="{{ old('banner_three_title', $content->banner_three_title) }}">
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
                            <div class="col-12">
                                <h4 class="pageSecTitle my-4">Banner Four</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Title *</label>
                                <input type="text" name="banner_four_title" id="banner_four_title" value="{{ old('banner_four_title', $content->banner_four_title) }}" required>
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
                                <textarea name="banner_four_content" id="banner_four_content" cols="30" rows="10" class="tinyEditor" required>{{ old('banner_four_content', $content->banner_four_content) }}</textarea>
                                @error('banner_four_content')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Image</label>
                                <input type="file" name="banner_four_image" id="banner_four_image">
                                @error('banner_four_image')
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
                                <input type="text" name="banner_five_title" id="banner_five_title" value="{{ old('banner_five_title', $content->banner_five_title) }}" required>
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
                                <textarea name="banner_five_content" id="banner_five_content" cols="30" rows="10" class="tinyEditor" required>{{ old('banner_five_content', $content->banner_five_content) }}</textarea>
                                @error('banner_five_content')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Image</label>
                                <input type="file" name="banner_five_image" id="banner_five_image">
                                @error('banner_five_image')
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
                                <input type="text" name="banner_six_title" id="banner_six_title" value="{{ old('banner_six_title', $content->banner_six_title) }}" required>
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
                                <textarea name="banner_six_content" id="banner_six_content" cols="30" rows="10" class="tinyEditor" required>{{ old('banner_six_content', $content->banner_six_content) }}</textarea>
                                @error('banner_sic_content')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Image</label>
                                <input type="file" name="banner_six_image" id="banner_six_image">
                                @error('banner_six_image')
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
                                <input type="text" name="banner_seven_title" id="banner_seven_title" value="{{ old('banner_seven_title', $content->banner_seven_title) }}" required>
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
                                <textarea name="banner_seven_content" id="banner_seven_content" cols="30" rows="10" class="tinyEditor" required> {{ old('banner_seven_content', $content->banner_seven_content)  }}</textarea>
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
                                <input type="text" name="banner_eight_title" id="banner_eight_title" value="{{ old('banner_eight_title', $content->banner_eight_title) }}" required>
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
                                <textarea name="banner_eight_content" id="banner_eight_content" cols="30" rows="10" class="tinyEditor" required>{{ old('banner_eight_content', $content->banner_eight_content) }}</textarea>
                                @error('banner_eight_content')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Image</label>
                                <input type="file" name="banner_eight_image" id="banner_eight_image">
                                @error('banner_eight_image')
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
