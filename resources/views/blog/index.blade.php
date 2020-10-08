@extends('layouts/master')

@section('title', "Zaynab Fish Farm Blog Series")
@section('description', 'Check our inspiring and educational blog articles about fish farming and awareness written by fisheries experts.')

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
            <div class="container">
                @foreach ($blogs as $blog)
                    <div class="card mb-3 {{ $blog->language == 'UR' ? 'rtl' : '' }}">
                        <div class="card-body">
                            <p class="h3">{{ $blog->title }}</p>
                            <p class="card-text">
                            <div class="pt-2 pb-2">
                                {{ Str::words(strip_tags($blog->content), 100) }}
                            </div>
                            </p>
                            <span class="text-black font-weight-bold d-block">{{ ($blog->language == "UR") ? $blog->author()->first()->name_ur : $blog->author()->first()->name_en }}</span>
                            @php
                                $temp = explode(' ',$blog->created_at);
                            @endphp
                            <p class="card-text"><small class="text-muted">Last updated: {{ $temp[0] }}</small></p>
                            <a href="{{ route('blog', ['blog' => $blog->slug]) }}" class="btn btn-outline-success btn-sm" style="color: black">
                                @if($blog->language == "UR")
                                    مزید پڑھئے۔۔۔
                                @else
                                    Read more...
                                @endif
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection