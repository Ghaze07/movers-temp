@extends('layouts/master')

@section('content')
    @include('sections.banner')
    @include('sections.delivery')
    @include('sections.ordernow')
    @include('sections.about')
    @guest()
        @include('sections.signup')
    @endguest
    @include('sections.contacts')
    @include('sections.contact_us')
@endsection


@section('comment')
    @include('sections.track')
@endsection