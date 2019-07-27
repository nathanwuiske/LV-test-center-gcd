@extends('layouts.main')
@section('content')
<div class="container">
   <div class="row">
      @guest
      <div class="heading mb650">
      </div>
      <div class="log-form">
         <div class="sec-title">
            <h2 style="color:white; font-size: 14px">Reset Password</h2>
         </div>
      
         <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input id="email" style="padding-left: 8px;" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" style="padding-left: 8px;" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm"  style="padding-left: 8px;" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4" >
                    <button type="submit" class="btn btn-primary">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </div>
        </form>
      </div>
      <!--end log form -->
      @else
      <script>window.location = "/home";</script>
      <div class="card">
         <div class="card-header">Reset error</div>
         <div class="card-body">
            <p>You tried to access the reset page, but you are logged in.</p>
            <a href="{{ route('home') }}" class="btn btn-success">Return to home</a>
         </div>
      </div>
      @endguest
   </div>
</div>
@endsection