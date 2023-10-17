@extends('layouts.frontend')
@push('page-title')
    {{ $policyPage->title }}
@endpush
@push('page-description')
    {{ Str::limit($policyPage->main_content, 280, "...") }}
@endpush
@section('content')
    <style>
        header {
            background: rgba(0, 44, 80, .75);
            backdrop-filter: blur(8px);
            border-bottom-left-radius: 40px;
            border-bottom-right-radius: 40px;
            border-bottom: 2px solid #BEA058;
            -webkit-box-shadow: 2px 15px 20px -8px rgba(0, 0, 0, 0.5);
            -moz-box-shadow: 2px 15px 20px -8px rgba(0, 0, 0, 0.5);
            box-shadow: 2px 15px 20px -8px rgba(0, 0, 0, 0.5);
        }
    </style>
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
