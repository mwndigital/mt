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

<script>
    $(document).ready(function(){
        // Add event listener for delete buttons
        $('.delete-image').click(function() {
            var imageId = $(this).data('image');
            $('#image_id').val(imageId);
            if (confirm('Are you sure you want to delete this image?')) {
                const response = $.ajax({
                    url: '{{ route('admin.remove-image') }}',
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: imageId
                    },
                    success: function(data) {
                        if (data.success) {
                            $('#image-card-' + imageId).remove();
                            alert('Image deleted successfully');
                        } else {
                            alert('There was an error deleting the image');
                        }

                    }
                });

            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#addImageButton').click(function() {
            $('#upload-btn').removeClass('d-none');
            var newInput = '<div class="input-group mb-3">';
            newInput += '<input type="file" name="images[]" class="form-control">';
            newInput += '<div class="input-group-append">';
            newInput += '<input type="button" class="btn btn-danger remove-image" value="Remove">';
            newInput += '</div></div>';
            $('#imageContainer').append(newInput);
        });

        $(document).on('click', '.remove-image', function() {
            $(this).closest('.input-group').remove();
        });

        $(document).on('click', '#uploadImageButton', function() {
            var totalImages = $('input[name^="images"]').length;
            var uploadedCount = 0;

            $('input[name^="images"]').each(function(index, element) {
                var formData = new FormData();
                formData.append('image', element.files[0]);
                formData.append('id', '{{ $room->id }}');
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    url: '{{ route('admin.upload-image') }}',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    xhr: function() {
                        var xhr = new XMLHttpRequest();

                        // Listen to the progress event
                        xhr.upload.addEventListener('progress', function(event) {
                            if (event.lengthComputable) {
                                var percentComplete = (event.loaded / event.total) * 100;
                                console.log('Upload Progress: ' + percentComplete + '%');
                            }
                        }, false);

                        return xhr;
                    },
                    success: function(response) {
                        uploadedCount++;

                        if (response.success) {
                            console.log('Image uploaded successfully: ' + response.image);

                            // Check if all images are uploaded
                            if (uploadedCount === totalImages) {
                                alert('All images uploaded successfully');
                                // remove input fields
                                $('input[name^="images"]').remove();
                                $('#upload-btn').addClass('d-none');
                                // remove `remove` buttons
                                $('.remove-image').remove();
                                // Add to gallery
                            }
                        } else {
                            alert('Error uploading image.');
                        }
                    }
                });
            });
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
                                    <option value="single" @if($room->room_type == 'single') selected @endif>Single</option>
                                    <option value="double" @if($room->room_type == 'double') selected @endif>Double</option>
                                    <option value="family" @if($room->room_type == 'family') selected @endif>Family</option>
                                    <option value="twin" @if($room->room_type == 'twin') selected @endif>Twin</option>
                                    <option value="lodge" @if($room->room_type == 'lodge') selected @endif>Lodge</option>
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

            <div class="row mt-4">
                <div class="col-12">
                    <h2 class="gallerySectionTitle">Image Gallery</h2>
                    <div class="row">
                        @foreach($room->images as $image)
                            <div class="col-4 mt-2" id="image-card-{{ $image->id }}">
                                <div class="card">
                                    <img src="{{ Storage::url($image->image) }}" class="card-img-top" alt="Image">
                                    <div class="card-body">
                                        <a href="{{ Storage::url($image->image) }}" target="_blank" class="btn btn-primary btn-sm">View</a>
                                        <button type="button" class="btn btn-danger btn-sm delete-image" data-image="{{ $image->id }}">Delete</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <form id="deleteForm">
                        @csrf
                        <input type="hidden" name="image_id" id="image_id">
                    </form>
                </div>
            </div>

             <!-- Image Upload Section -->
             <div class="row mt-4">
                <div class="col-12">
                    <h3>Upload New Images</h3>
                </div>
                <div class="col-12" id="imageContainer">
                    <!-- Initial file input field for images -->
                    @if (old('images'))
                        @foreach (old('images') as $image)
                            <input type="file" name="images[]" class="form-control mt-2">
                        @endforeach
                    @endif
                </div>

                <div class="col-12 mt-2">
                    <button type="button" class="btn btn-success" id="addImageButton">+ Add New Image</button>
                </div>

                <div class="col-12 mt-2 d-none" id="upload-btn">
                    <button type="button" class="btn btn-primary" id="uploadImageButton">Upload Images</button>
                </div>
            </div>
        </div>
    </section>
@endsection
