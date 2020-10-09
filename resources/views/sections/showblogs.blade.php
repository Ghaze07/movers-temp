<section>
    <div class="container-fluid wrapper">
        <div class="container">
            <div class="row">
                <div class="card-deck">
                    @foreach($blogs as $key=>$blog)
                        <div class="card mt-3 mb-3 text-center border-dark {{ $blog->language == 'UR' ? 'rtl' : '' }}" style="border-color: #e0e0e0 !important;">
                            <img src="{{ asset('pix/backgrounds/bg_image.jpg') }}" class="card-img-top" width="100%" alt="...">
                            <div class="card-body">
                                <h5 class="card-title {{ ($blog->language == "UR") ? 'text-right' : 'text-left' }}">
                                    {{ $blog->title }}
                                </h5>
                                <h6 class="card-subtitle mb-2 text-muted {{ ($blog->language == "UR") ? 'text-right' : 'text-left' }}">
                                    {{ ($blog->language == "UR") ? $blog->author()->first()->name_ur : $blog->author()->first()->name_en }}
                                </h6>

                                <div class="pt-2 pb-2">
                                    <p class="card-text text-justify">
                                        {{ ($blog->language == "UR") ? Str::words(strip_tags($blog->content), 50) : Str::words(strip_tags($blog->content), 30) }}
                                    </p>
                                </div>
                            </div>
                            <div class="card-footer text-justify">
                                <a href="{{ route('blog', ['blog' => $blog->slug]) }}" class="btn btn-danger btn-block">
                                    @if($blog->language == "UR")
                                        مزید پڑھئے۔۔۔
                                    @else
                                        Read more...
                                    @endif
                                </a>
                            </div>
                        </div>
                        @if( $key%2 )
                            <div class="w-100 d-none d-sm-block d-lg-none"><!-- wrap every 2 on sm--></div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>