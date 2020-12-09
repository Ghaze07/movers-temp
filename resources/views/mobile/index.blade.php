@extends('layouts.settings')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Change Mobile Number</div>

                <div class="card-body">
                  <form action="{{ route('change.mobile') }}" method="POST" id="mobileform">
                    @csrf
                        <div class="modal-body">
                            
                            <div class="form-group">
                                <label for="number">Mobile Number</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">+92</span>
                                    </div>
                                    <input type="tel" pattern="[0-9]{9}[0-9]{1}" name="mobile" class="form-control" id="mobile" placeholder="{{$user->mobile}}">
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
