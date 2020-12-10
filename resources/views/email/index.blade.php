@extends('layouts.settings')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Change Email Address</div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if ( session('status') )
                <div class="alert alert-success" role="alert">
                    {{ session('status')}}
                </div>
                @endif

                <div class="card-body">
                  <form action="{{ route('change.email') }}" method="POST" id="emailform">
                    @csrf
                        <div class="modal-body">
                            
                            <div class="form-group">
                                <label for="email">Email</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                    </div>
                                    <input type="email" name="email" class="form-control" id="email" value="{{$user->email}}" placeholder="Enter Email">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" id="updateButton" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
