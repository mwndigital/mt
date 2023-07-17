@extends('layouts.frontend')
@push('page-title')
    {{ $policyPage->title }}
@endpush
@push('page-description')
    {{ Str::limit($policyPage->main_content, 280, "...") }}
@endpush
@section('content')
    <section class="policyPageTop">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>{{ $policyPage->title }}</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="policyPageMain">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    {!! $policyPage->main_content !!}
                </div>
            </div>
        </div>
    </section>
@endsection
