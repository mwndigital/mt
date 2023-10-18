@extends('layouts.admin')
@push('page-title')
    Admin {{ $policyPage->name }}
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
                    <h1>{{ $policyPage->name }}</h1>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.policy-pages.index') }}" class="blueBtn"><i
                                class="fas fa-chevron-left"></i> Back to Rooms</a>
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
                        <a href="{{ route('admin.policy-pages.edit', $policyPage->id) }}" class="editBtn">Edit</a>
                        <form action="{{ route('admin.policy-pages.destroy', $policyPage->id) }}" method="POST">
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
                    <table class="table table-responsive w-100">
                        <tbody>
                        <tr>
                            <td><strong>Name</strong></td>
                            <td>{{ $policyPage->title }}</td>
                        </tr>
                        <tr>
                            <td><strong>Slug</strong></td>
                            <td>{{ $policyPage->slug }}</td>
                        </tr>
                        <tr>
                            <td><strong>Main content</strong></td>
                            <td>{!! $policyPage->main_content !!}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
