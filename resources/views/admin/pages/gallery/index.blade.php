@extends('layouts.admin')
@push('page-title')

@endpush
@push('page-scripts')

@endpush
@push('page-styles')

@endpush
@section('content')
    <section class="pageHero">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1>All Gallery</h1>
                </div>
                <div class="col-md-4 d-flex justify-content-end">
                    <a href="{{ route('admin.gallery.create') }}" class="blueBtn">
                        Add Gallery Item <i class="fas fa-plus"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="pageMain">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table class="table table-hovered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($galleryItem as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->category->name }}</td>
                                <td><img class="img-fluid" src="{{ Storage::url($item->image) }}"
                                         style="height: 75px; width: 75px;"></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="dropdown-toggle" role="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>

                                                <li>
                                                    <a href="{{ route('admin.gallery.edit', $item->id) }}">Edit</a>
                                                </li>
                                                <li>
                                                    <form action="{{ route('admin.gallery.destroy', $item->id) }}"
                                                          method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="confirm-delete-btn" type="submit">Delete</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
