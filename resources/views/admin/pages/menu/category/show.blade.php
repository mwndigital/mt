@extends('layouts.admin')
@push('page-title')
    Admin Menu Category {{ $category->name }}
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
                    <h1>Menu Category {{ $category->name }}</h1>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.menu-category.index') }}" class="blueBtn">
                            <i class="fa fa-chevron-left"></i> All Category Items
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pageActionsBanner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="btn-group">
                        <a href="{{ route('admin.menu-category.edit', $category->id) }}" class="editBtn">Edit</a>
                        <form action="{{ route('admin.menu-category.destroy', $category->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="deleteBtn confirm-delete-btn" type="submit">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pageMain">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td><strong>Name:</strong></td>
                            <td>{{ $category->name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Description:</strong></td>
                            <td>{!! $category->description !!}</td>
                        </tr>
                        <tr>
                            <td><strong>Image:</strong></td>
                            <td>
                                @if($category->image)
                                    <img style="display: block; height: 100px; margin: 0; width: auto;" class="img-fluid" src="{{ Storage::url($room->featured_image) }}">
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
