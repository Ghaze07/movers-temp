@extends('layouts/master')

@section('title', $blog->title)
@section('description', Str::words(strip_tags($blog->content), 20))

@section('content')
    <section id="banner-pages">
        <div class="container-fluid wrapper">
            <div class="container">
                <div class="banner-blog">
                    &nbsp;
                </div>
            </div>
        </div>
    </section>

    <section id="blogs" class="pb-3 pt-3">
        <div class="container-fluid wrapper">
            <div class="container {{ $blog->language == 'UR' ? 'rtl' : '' }}">
                <div>
                    <img src="{{ asset('pix/authors/'.$author->photo) }}" class="rounded-circle card-img-top img-thumbnail" style="width: 100px !important" />
                    <span class="text-danger font-weight-bold d-block">{{ ($blog->language == "UR") ? $author->name_ur : $author->name_en }}</span>
                    <span class="small">{{ ($blog->language == "UR") ? $author->title_ur : $author->title_en }}</span>
                </div>

                <h2 class="mt-3 mb-3">{{ $blog->title }}</h2>
                <div>
                    {!! $blog->content !!}
                </div>
            </div>
        </div>
    </section>

    @include('sections.showblogs')
@endsection