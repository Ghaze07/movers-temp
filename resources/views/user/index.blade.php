@extends('layouts.dashboard')

@section('content')
<div class="row align-items-end content">
    <div class="col-12 justify-content-around">
        <h2>Site Users:</h2>
        <users :user="{{ json_encode($users) }}"></users>
    </div>
</div>                
@endsection