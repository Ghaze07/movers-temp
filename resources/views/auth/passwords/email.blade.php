@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- Reset password using email --}}
            <div class="card mb-5 mt-5">
                <div class="card-header">{{ __('Reset Password with Email') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

                        {{-- Reset password using mobile number --}}
                        <div class="card mb-5 mt-5">
                            <div class="card-header">Reset Password with Mobile Number</div>
                            @if (session('mobile_number_error_status'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('mobile_number_error_status') }}
                                    </div>
                            @endif
            
                            @if ( session('mobilestatus') )
                                    <div class="alert alert-success" role="alert">
                                {{ session('mobilestatus')}}
                            </div>
                            @endif
                            <div class="card-body">
                                <form method="POST" action="{{ route('password.sms') }}">
                                    @csrf
            
                                    <div class="form-group row">
                                        <label for="mobile" class="col-md-4 col-form-label text-md-right">Mobile Number</label>
            
                                        <div class="col-md-6">
                                            <input type="number" name="mobile" class="form-control" placeholder="Enter Your Mobile Number" required>
                                        </div>
                                    </div>
            
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
            
        </div>
    </div>
</div>
@endsection
