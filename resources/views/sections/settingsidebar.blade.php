@php
    $requestPath = "/".request()->path();
@endphp
<nav id="sidebar" style="background-color: #212529 !important;">
    <div class="sidebar-header">
        <a href="{{ route('welcome') }}"><img alt="Zaynab Fish Farm" src="{{asset('pix/logo.png')}}" id="logo" /></a>
    </div>

    <ul class="list-unstyled components">

        
        <li class="{{ ( $requestPath == route('change-password', [], false) ) ? 'active' : '' }}">
            <a href="{{ route('change-password') }}">Change Password</a>
        </li>

        <li class="{{ ( $requestPath == route('address.index', [], false) ) ? 'active' : '' }}" style="border-top: solid red; border-bottom: solid red; " >
            <a href="{{ route('address.index') }}">Change Delivery Address</a>
        </li>

        <li class="{{ ( $requestPath == route('change-mobile', [], false) ) ? 'active' : '' }}">
            <a href="{{ route('change-mobile') }}">Change Mobile Number</a>
        </li>

        <li class="{{ ( $requestPath == route('change-email', [], false) ) ? 'active' : '' }}" style="border-top: solid red; ">
            <a href="{{ route('change-email') }}">Change Email</a>
        </li>

    </ul>
</nav>
