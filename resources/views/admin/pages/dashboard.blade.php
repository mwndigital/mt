@extends('layouts.admin')
@push('page-title')
    Admin Dashboard
@endpush
@push('page-scripts')

@endpush
@push('page-styles')

@endpush
@section('content')

    <form action="{{ route('admin.contact-form-submission-test-email') }}" method="post">
        @csrf
        <button type="submit">Send test contact form submission</button>
    </form>

@endsection
