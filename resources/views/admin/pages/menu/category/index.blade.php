@extends('layouts.admin')
@push('page-title')
    Admin Menu Category
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
                    <h1>Menu Category</h1>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.menu-category.create') }}" class="blueBtn">
                            Add Category <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pageMain">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table class="table table-responsive table-hovered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($category as $cat)
                            <tr>
                                <td>{{ $cat->name }}</td>
                                <td>
                                    @if($cat->description)
                                        {!! $cat->description !!}
                                    @else
                                        --
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="dropdown-toggle" role="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a href="{{ route('admin.menu-category.show', $cat->id) }}">View</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('admin.menu-category.edit', $cat->id) }}">Edit</a>
                                                </li>
                                                <li>
                                                    <form action="{{ route('admin.menu-category.destroy', $cat->id) }}"
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
