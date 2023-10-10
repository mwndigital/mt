@extends('layouts.frontend')
@push('page-title')
    {{ $content->seo_title }}
@endpush
@push('page-description')
    {{ $content->seo_description }}
@endpush
@push('page-keywords')
    {{ $content->seo_keywords }}
@endpush
@push('page-image')
    {{ $content->seo_image }}
@endpush
@section('content')
    <section class="faqsPageTop">
        <img class="img-fluid mainBgImage" src="{{ asset('images/lodge/_DSC1555.jpg') }}">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1>{{ $content->main_title }}</h1>
                        {!! $content->sub_title !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="faqsPageMain">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    @foreach($categories as $category)
                        <div class="categoryItem">
                            <h4 class="mainCIItemTitle">{{ $category->name }}</h4>
                            <div class="accordion" id="{{ str_replace(' ', '_', $category->name) }}">
                                @foreach($category->faq as $faq)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#{{ str_replace(' ', '', $faq->question) }}" aria-expanded="false" aria-controls="collapseOne">
                                                {{ $faq->question }}
                                            </button>
                                        </h2>
                                        <div id="{{ str_replace(' ', '', $faq->question) }}" class="accordion-collapse collapse" data-bs-parent="#{{ str_replace(' ', '_', $category->name) }}">
                                            <div class="accordion-body">
                                                {!! $faq->answer !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
