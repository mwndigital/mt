@extends('layouts.admin')
@push('page-title')
    Admin {{ $whisky->name }} Whisky Item
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
                    <h1>{{ $whisky->name }}</h1>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.whisky.index') }}" class="blueBtn">
                            <i class="fa fa-chevron-left"></i> All Whisky Items
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
                        <a href="{{ route('admin.whisky.edit', $whisky->id) }}" class="editBtn">Edit</a>
                        <form action="{{ route('admin.whisky.destroy', $whisky->id) }}" method="POST">
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
                            <td>{{ $whisky->name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Description:</strong></td>
                            <td>{!! $whisky->description !!}</td>
                        </tr>
                        <tr>
                            <td><strong>Price:</strong></td>
                            <td>£{{ $whisky->price }}</td>
                        </tr>
                        <tr>
                            <td><strong>Drink Size:</strong></td>
                            <td>{{ $whisky->drink_size }}</td>
                        </tr>
                        <tr>
                            <td><strong>Image:</strong></td>
                            <td>
                                @if($whisky->image)
                                    <img style="display: block; height: 100px; margin: 0; width: auto;"
                                         class="img-fluid" src="{{ Storage::url($whisky->image) }}">
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
