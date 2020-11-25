@php
    $requestPath = "/".request()->path();
@endphp
<nav id="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('welcome') }}"><img alt="Zaynab Fish Farm" src="{{asset('pix/logo.png')}}" id="logo" /></a>
    </div>

    <ul class="list-unstyled components">

        <li class="">
            <a href="#farmsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Farms</a>
            <ul class="collapse list-unstyled" id="farmsSubmenu">
                <li>
                    <a href="{{ route('farms') }}">Fish Farms</a>
                </li>
            </ul>
        </li>

        <li class="{{ ( $requestPath == route('users', [], false) ) ? 'active' : '' }}">
            <a href="{{ route('users') }}">Users</a>
        </li>

        <li class="{{ ( in_array($requestPath, [
                                        route('authors', [], false),
                                        route('blogs.list', [], false),
                                    ]) ) ? 'active' : '' }}">
            <a href="#blogsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Blogs</a>
            <ul class="collapse list-unstyled" id="blogsSubmenu">
                <li class="{{ ( $requestPath == route('authors', [], false) ) ? 'active' : '' }}">
                    <a href="{{ route('authors') }}">Author</a>
                </li>
                <li class="{{ ( $requestPath == route('blogs.list', [], false) ) ? 'active' : '' }}">
                    <a href="{{ route('blogs.list') }}">Blogs</a>
                </li>
            </ul>
        </li>

        <li class="">
            <a href="#productSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Product</a>
            <ul class="collapse list-unstyled" id="productSubmenu">
                <li>
                    <a href="{{ route('product.categories') }}">Categories</a>
                </li>
                <li>
                    <a href="{{ route('products') }}">Products</a>
                </li>
                <li>
                    <a href="{{ route('product.sources') }}">Product Sources</a>
                </li>
            </ul>
        </li>

        <li class="{{ ( in_array($requestPath, [
                                        route('countries.index', [], false),
                                        route('regions.index', [], false),
                                        route('cities.index', [], false),
                                        route('measuringUnits', [], false)
                                    ]) ) ? 'active' : '' }}">
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
                <li>
                    <a href="{{ route('measuringUnits') }}">Measuring Units</a>
                </li>
            </ul>
        </li>
        <li>
        <a href="{{ route('order.index') }}">Orders</a>
        </li>
    </ul>
</nav>