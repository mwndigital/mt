@extends('layouts.admin')
@push('page-title')
    All Gallery Categories
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
                    <h1>All Gallery Categories</h1>
                </div>
                <div class="col-md-4 d-flex justify-content-end">
                    <a href="{{ route('admin.gallery-category.create') }}" class="blueBtn">
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
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($category as $cat)
                            <tr>
                                <td>{{ $cat->name }}</td>
                                <td><img class="img-fluid" src="{{ Storage::url($cat->featured_image) }}" style="height: 75px; width: 75px;"></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a href="">View</a>
                                                </li>
                                                <li>
                                                    <a href="">Edit</a>
                                                </li>
                                                <li>
                                                    <form action="" method="POST">
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
