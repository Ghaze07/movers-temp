@extends('layouts/master')

@section('content')
    @include('sections.banner')
    @include('sections.delivery')
    
<order-now :farm-products="{{ json_encode( $farmProducts ) }}" :cart-items="{{ json_encode( $cartItems ) }}" :authenticated="{{ $authenticated }}" :session-items="{{ json_encode( $sessionItems ) }}" :regions="{{ json_encode( $regions ) }}"></order-now>

    @include('sections.about')
    @guest()
        @include('sections.signup')
    @endguest
    @include('sections.contacts')
    @include('sections.pangasius')
    @include('sections.showblogs')
@endsection


@section('comment')
    {{-- @include('sections.ordernow') --}}
    @include('sections.track')
@endsection