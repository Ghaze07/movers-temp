<!-- Header -->
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a href="{{ url('/') }}" class="navbar-brand">
                <img src="{{ asset('svg/logo.svg') }}" />
            </a>
            <div class="text-right">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="true" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse show" id="navbarToggleExternalContent">
                    <auth-menu :visitor='{{ Auth::guest() ? json_encode(['role' => "guest"]) : json_encode([
                        'email' => Auth::user()->email,
                        'is_verified' => Auth::user()->is_verified,
                        'mobile' => Auth::user()->mobile,
                        'name' => Auth::user()->name,
                        'role' => Auth::user()->role
                    ]) }}'></auth-menu>
                </div>
            </div>
        </div>
    </nav>
</header>