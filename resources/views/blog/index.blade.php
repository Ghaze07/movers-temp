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
                <h2>Read Articles:</h2>
                @foreach($blogs as $blog)
                    <div class="card mt-3 mb-3 {{ $blog->language == 'UR' ? 'rtl' : '' }}">
                        <div class="card-header">
                            {{ $blog->title }}
                        </div>
                        <div class="card-body">
                            <div class="pt-2 pb-2">
                                {{ Str::words(strip_tags($blog->content), 50) }}
                            </div>
                            <a href="{{ route('blog', ['blog' => $blog->slug]) }}" class="btn btn-primary">
                                @if($blog->language == "UR")
                                    مزید پڑھئے۔۔۔
                                @else
                                    Continue Reading...
                                @endif
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection