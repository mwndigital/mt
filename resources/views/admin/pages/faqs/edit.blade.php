@extends('layouts.admin')
@push('page-title')
    Admin Edit FAQ
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
                    <h1>Edit {{ $faq->name }} FAQ</h1>
                </div>
                <div class="col-md-3 d-flex justify-content-end">
                    <a href="{{ route('admin.faq.index') }}" class="blueBtn"><i class="fas fa-chevron-left"></i> All
                        FAQs</a>
                </div>
            </div>
        </div>
    </section>
    <section class="pageMain">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.faq.update', $faq->id) }}" method="post">
                        @csrf
                        @method("put")
                        <div class="row">
                            <div class="col-12">
                                <label for="">Name *</label>
                                <input type="text" name="question" id="question"
                                       value="{{ old('question', $faq->question) }}" required>
                                @error('question')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                                <small>Please do not put ? in the question as its populated on the frontend</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Answer *</label>
                                <textarea name="answer" id="answer" cols="30" rows="10" class="tinyEditor"
                                          required>{{ old('answer', $faq->answer) }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Category *</label>
                                <select name="category_id" id="category_id" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                                @if($category->id == $faq->category_id) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="darkGoldBtn">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
