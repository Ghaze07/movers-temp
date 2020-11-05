<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.head')
<body>
    @php
        $hasHeader = isset($hasHeader) ? $hasHeader : true;
        $hasFooter = isset($hasFooter) ? $hasFooter : true;
    @endphp
    <div id="app">
        @if( $hasHeader )
            @include('sections.header')
        @endif

        <main>
            <div id="app">
                @yield('content')
                @yield('comment')
            </div>
        </main>

        @if( $hasFooter )
            @include('sections.footer')
        @endif
    </div>

    <!-- Back to Top -->
    <a href="#0" class="cd-top js-cd-top">Top</a>

    <!-- Scripts -->
    @if( app()->getLocale() == 'en')
        <script src="{{ asset('js/app.js') }}" defer></script>
    @else
        <script src="{{ asset('js/app-rtl.js') }}" defer></script>
    @endif
    <script src="{{ asset('js/site.js') }}" defer></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-176826469-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-176826469-3');
    </script>
</body>
</html>
