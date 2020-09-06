<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Zaynab Fish Farm - Hassan Abdal. The organic farm fresh Pangasius fish producer in Pakistan.">
    <meta name="author" content="Asaheeb Est, Riyadh">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@buypangasiusfish">
    <meta name="twitter:creator" content="@buypangasiusfish">
    <meta name="twitter:title" content="Zaynab Fish Farm">
    <meta name="twitter:description" content="Zaynab Fish Farm - Hassan Abdal. The organic farm fresh Pangasius fish producer in Pakistan.">
    <meta name="twitter:image" content="{{ asset('pix/logo_full.png') }}">

    <!-- Facebook -->
    <meta property="og:url" content="http://zaynabfishfarm.com">
    <meta property="og:site_name" content="Zaynab Fish Farm">
    <meta property="og:title" content="Zaynab Fish Farm">
    <meta property="og:description" content="Zaynab Fish Farm - Hassan Abdal. The organic farm fresh Pangasius fish producer in Pakistan.">
    <meta property="og:type" content="website">
    <meta property="og:image" itemprop="image" content="{{ asset('pix/logo_full.png') }}">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="500">
    <meta property="og:image:height" content="500">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-32x32.png') }}">
    <link rel="manifest" href="{{ asset('favicons/manifest.json') }}">
    <link rel="mask-icon" href="{{ asset('favicons/favicon.svg') }}" color="#328af1">
    <link rel="shortcut icon" href="{{ asset('favicons/favicon-96x96.png') }}">
    <meta name="msapplication-config" content="{{ asset('favicons/browserconfig.xml') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Zaynab Fish Farm') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <script defer src="https://use.fontawesome.com/releases/v5.7.1/js/all.js" integrity="sha384-eVEQC9zshBn0rFj4+TU78eNA19HMNigMviK/PU/FFjLXqa/GKPgX58rvt5Z8PLs7" crossorigin="anonymous"></script>

    <!-- Styles -->
    @if( app()->getLocale() == 'en')
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @else
        <link href="{{ asset('css/app-rtl.css') }}" rel="stylesheet">
    @endif

</head>
<body>
    @if(isset($hasHeader) && $hasHeader)
        @include('sections.header')
    @endif

    <main>
        <div id="app">
            @yield('content')
        </div>
    </main>

    @if(isset($hasFooter) && $hasFooter)
        @include('sections.footer')
    @endif

    <!-- Back to Top -->
    <a href="#0" class="cd-top js-cd-top">Top</a>

    <!-- Scripts -->
    @if( app()->getLocale() == 'en')
        <script src="{{ asset('js/app.js') }}" defer></script>
    @else
        <script src="{{ asset('js/app-rtl.js') }}" defer></script>
    @endif
    <script src="{{ asset('js/site.js') }}" defer></script>
</body>
</html>
