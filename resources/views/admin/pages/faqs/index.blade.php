@extends('layouts.admin')
@push('page-title')
    Admin All FAQs
@endpush
@push('page-scripts')

@endpush
@push('page-styles')

@endpush
@section('content')
    <section class="pageHero">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <h1>All FAQ</h1>
                </div>
                <div class="col-md-3 d-flex justify-content-end">
                    <a href="{{ route('admin.faq.create') }}" class="blueBtn">Add new faq <i class="fas fa-plus"></i></a>
                </div>
            </div>
        </div>
    </section>
    <section class="pageMain">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($faqs as $faq)
                                <tr>
                                    <td>{{ $faq->question }}</td>
                                    <td>{{ $faq->category->name }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('admin.faq.edit', $faq->id) }}">Edit</a>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('admin.faq.destroy', $faq->id) }}" method="post">
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
