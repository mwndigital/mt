@extends('layouts.frontend')
@push('page-title')
    Cigar and Whisky Shop
@endpush
@push('page-description')
    {{--{{ $rpc->page_description }}--}}
@endpush
@push('page-keywords')
    {{--{{ $rpc->page_keywords }}--}}
@endpush
@push('page-image')
    {{--{{ Storage::url($rpc->page_image) }}--}}
@endpush
@section('content')
    <section class="cigarWhiskyPageTop">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1>

                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
