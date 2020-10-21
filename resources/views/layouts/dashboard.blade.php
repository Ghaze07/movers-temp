<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.head')
<body>
    <div id="app" class="wrapper">
        @include('sections.sidebar')

        <div id="content" class="w-100">
            <nav class="navbar navbar-expand">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                    </button>
                </div>

                <ul class="navbar-nav right">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/logout"
                               onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="/logout" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>
            <main>
                <div id="app">
                    <section id="dashboard">
                        <div class="container-fluid mt-2 mb-2">
                            @yield('content')
                        </div>
                    </section>
                </div>
            </main>
        </div>
    </div>

    <!-- Back to Top -->
    <a href="#0" class="cd-top js-cd-top">Top</a>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/site.js') }}" defer></script>
</body>
</html>