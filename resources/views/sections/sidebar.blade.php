@php
    $requestPath = "/".request()->path();
@endphp
<nav id="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('welcome') }}"><img alt="Zaynab Fish Farm" src="{{asset('pix/delivery-truck.png')}}" id="logo" /></a>
    </div>

    <ul class="list-unstyled components">

        <li class="{{ ( $requestPath == route('users', [], false) ) ? 'active' : '' }}">
            <a href="{{ route('users') }}">Users</a>
        </li>

        <li class="{{ ( $requestPath == route('bookings.index', [], false) ) ? 'active' : '' }}" style="border-top: solid #f9c909; ">
            <a href="{{ route('bookings.index') }}">Moves</a>
        </li>
        
        <li class="{{ ( $requestPath == route('services.index', [], false) ) ? 'active' : '' }}" style="border-top: solid #f9c909; ">
        <a href="{{ route('services.index') }}">Services</a>
        </li>

        <li class="{{ ( in_array($requestPath, [
            route('countries.index', [], false),
            route('regions.index', [], false),
            route('cities.index', [], false),
                                    ]) ) ? 'active' : '' }}" style="border-top: solid #f9c909; ">
            <a href="#settingsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Settings</a>
            <ul class="collapse list-unstyled" id="settingsSubmenu">
                <li>
                <a href="{{ route('countries.index') }}">Countries</a>
                </li>
                <li>
                <a href="{{ route('regions.index') }}">Regions</a>
                </li>
                <li>
                <a href="{{ route('cities.index') }}">Cities</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>