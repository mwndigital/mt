@extends('layouts.admin')
@push('page-title')
    Admin Create Room
@endpush
@push('page-scripts')
<script>
    $(document).ready(function() {
        $('#addImageButton').click(function() {
            $('#imageContainer').append('<input type="file" name="images[]" class="form-control mt-2" multiple>');
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
                    <h1>Create Room</h1>
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
                    <form action="{{ route('admin.rooms.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Room Name *</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Room Type *</label>
                                <select name="room_type" id="room_type" required>
                                    <option value="">Please make a selection</option>
                                    <option value="single">Single</option>
                                    <option value="double">Double</option>
                                    <option value="family">Family</option>
                                    <option value="twin">Twin</option>
                                    <option value="lodge">Lodge</option>
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
                                <input type="number" name="adult_cap" id="adult_cap" value="{{ old('adult_cap') }}" required>
                                @error('adult_cap')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Child Capacity *</label>
                                <input type="number" name="child_cap" id="child_cap" value="{{ old('child_cap') }}" required>
                                @error('child_cap')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Bathroom Type *</label>
                                <select name="bathroom_type" id="bathroom_type" required>
                                    <option value="">Please choose an option</option>
                                    <option value="full_ensuite">Full Ensuite</option>
                                    <option value="ensuite_shower">Ensuite Shower</option>
                                    <option value="ensuite_bath">Ensuite Bath</option>
                                    <option value="no_ensuite">No Ensuite</option>
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
                                <input type="number" name="price_per_night_double" id="price_per_night_double" step="any" value="" required>
                                @error('price_per_night_double')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Price per night single *</label>
                                <input type="number" name="price_per_night_single" id="price_per_night_single" value="" step="any" required>
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
                                <textarea name="description" id="description" cols="30" rows="10" class="tinyEditor">{{ old('description') }}</textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Short Description</label>
                                <textarea name="short_description" id="short_description" cols="30" rows="10" class="tinyEditor">{{ old('short_description') }}</textarea>
                                @error('short_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Featured Image *</label>
                                <input type="file" name="featured_image" id="featured_image">
                                @error('featured_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                          <!-- Image Upload Section -->
                          <div class="row mt-4">
                            <div class="col-12">
                                <h3>Upload Images</h3>
                            </div>
                            <div class="col-12" id="imageContainer">
                                <!-- Initial file input field for images -->
                                @if (old('images'))
                                    @foreach (old('images') as $image)
                                        <input type="file" name="images[]" class="form-control mt-2" multiple>
                                    @endforeach
                                @endif
                            </div>
                            <div class="col-12 mt-2">
                                <button type="button" class="btn btn-success" id="addImageButton">+ Add New Image</button>
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
