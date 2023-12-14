@extends('layouts.admin')
@push('page-title')
    Admin {{ $menu->name }} Menu Item
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
                    <h1>{{ $menu->name }}</h1>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.menu.index') }}" class="blueBtn">
                            <i class="fa fa-chevron-left"></i> All Menu Items
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
                        <a href="{{ route('admin.menu.edit', $menu->id) }}" class="editBtn">Edit</a>
                        <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST">
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
                            <td>
                                <strong>Name:</strong>
                            </td>
                            <td>{{ $menu->name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Description:</strong></td>
                            <td>{!! $menu->description !!}</td>
                        </tr>
                        <tr>
                            <td><strong>Order:</strong></td>
                            <td>{{ $menu->order }}</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
