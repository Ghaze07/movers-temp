<!-- Header -->
<header>
    <nav class="navbar navbar-light" style="background-color: #fff;">
        <div class="container">
            <a href="{{ config('app.url') }}" class="navbar-brand">
                <img src="{{ asset('svg/logo.svg') }}" style="height: 70px; width: 158px;" />
            </a>

            <div class="expand navbar-expand" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blogs') }}" style="color: #E6001F;">
                            <i class="fas fa-bullhorn"></i><span class="pl-2">Blog</span>
                        </a>
                    </li>
                    <li class="nav-item"><span class="nav-link">|</span></li>
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Sign In</a>
                        </li>
                        <li class="nav-item"><span class="nav-link">|</span></li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Sign Up</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest

                </ul>
            </div>
        </div>
    </nav>
</header>