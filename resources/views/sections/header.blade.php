<!-- Header -->
<header>
    <nav class="navbar navbar-light" style="background-color: #fff;">
        <div class="container">
            <a href="{{ config('app.url') }}" class="navbar-brand">
                <img src="{{ asset('svg/logo.svg') }}" style="height: 70px; width: 158px;" />
            </a>

            <auth-menu :visitor='{{ Auth::guest() ? json_encode(['role' => "guest"]) : json_encode(Auth::user()) }}'></auth-menu>
        </div>
    </nav>
</header>