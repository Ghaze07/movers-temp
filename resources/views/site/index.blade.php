@extends('layouts/master')

@section('content')
    @include('sections.banner')
    @include('sections.delivery')
    @include('sections.about')
    @include('sections.signup')
    @include('sections.contacts')
    @include('sections.pangasius')
@endsection

@section('comment')
    @include('sections.ordernow')
    @include('sections.track')
@endsection