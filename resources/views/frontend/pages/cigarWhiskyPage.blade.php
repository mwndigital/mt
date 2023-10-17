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

@endsection
