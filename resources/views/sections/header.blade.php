<!-- Header -->
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a href="{{ config('app.url') }}" class="navbar-brand">
                <img src="{{ asset('svg/logo.svg') }}" />
            </a>
            <div class="text-right">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarToggleExternalContent">
                    <auth-menu :visitor='{{ Auth::guest() ? json_encode(['role' => "guest"]) : json_encode(Auth::user()) }}'></auth-menu>
                </div>
            </div>
        </div>
    </nav>
</header>