@extends('layouts.admin')
@push('page-title')
    Admin Edit {{ $room->name }}
@endpush
@push('page-scripts')
    <script>
        $(document).ready(function(){
            tinymce.init({
                selector: '#description',
                plugins: 'code table lists',
                toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
                setup: function (editor) {
                    editor.on('init', function () {
                        var storedValue = {!! json_encode($room->description) !!};
                        editor.setContent(storedValue);
                    });
                }
            });
            tinymce.init({
                selector: '#short_description',
                plugins: 'code table lists',
                toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
                setup: function (editor) {
                    editor.on('init', function () {
                        var storedValue = {!! json_encode($room->short_description) !!};
                        editor.setContent(storedValue);
                    });
                }
            });
        });
    </script>
@endpush
@push('page-styles')

@endpush
@section('content')
    <section class="pageHero">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1>Edit {{ $room->name }}</h1>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.rooms.index') }}" class="blueBtn"><i class="fas fa-chevron-left"></i> Back to Rooms</a>
                    </div>
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
                    <form action="{{ route('admin.rooms.update', $room->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Room Name *</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $room->name) }}" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Room Type *</label>
                                <select name="room_type" id="room_type" required>
                                    <option value="single" @if($room->type == 'single') selected @endif>Single</option>
                                    <option value="double" @if($room->type == 'double') selected @endif>Double</option>
                                    <option value="family" @if($room->type == 'family') selected @endif>Family</option>
                                </select>
                                @error('room_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Adult Capacity *</label>
                                <input type="number" name="adult_cap" id="adult_cap" value="{{ old('adult_cap', $room->adult_cap) }}" required>
                                @error('adult_cap')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Child Capacity *</label>
                                <input type="number" name="child_cap" id="child_cap" value="{{ old('child_cap', $room->child_cap) }}" required>
                                @error('child_cap')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Bathroom Type *</label>
                                <select name="bathroom_type" id="bathroom_type" required>
                                    <option value="full_ensuite" @if($room->bathroom_type == 'full_ensuite') selected @endif>Full Ensuite</option>
                                    <option value="ensuite_shower" @if($room->bathroom_type == 'ensuite_shower') selected @endif>Ensuite Shower</option>
                                    <option value="ensuite_bath" @if($room->bathroom_type == 'ensuite_bath') selected @endif>Ensuite Bath</option>
                                    <option value="no_ensuite" @if($room->bathroom_type == 'no_ensuite') selected @endif>No Ensuite</option>
                                </select>
                                @error('bathroom_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Price per night double *</label>
                                <input type="number" name="price_per_night_double" id="price_per_night_double" step="any" value="{{ $room->price_per_night_double }}" required>
                                @error('price_per_night_double')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Price per night single *</label>
                                <input type="number" name="price_per_night_single" id="price_per_night_single" value="{{ $room->price_per_night_single }}" step="any" required>
                                @error('price_per_night_single')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Description *</label>
                                <textarea name="description" id="description" cols="30" rows="10" class="" required>{{ old('description', $room->description) }}</textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Short Description</label>
                                <textarea name="short_description" id="short_description" cols="30" rows="10" class="" readonly required>{{ old('short_description', $room->short_description) }}</textarea>
                                @error('short_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Current Image:</label>
                                <img style="display: block; height: 100px; margin: 0; width: auto;" class="img-fluid" src="{{ Storage::url($room->featured_image) }}">
                            </div>
                            <div class="col-md-6">
                                <label for="">Featured Image *</label>
                                <input type="file" name="featured_image" id="featured_image">
                                @error('featured_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="darkGoldBtn">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
