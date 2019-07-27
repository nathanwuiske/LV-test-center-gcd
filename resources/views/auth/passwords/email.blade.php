@extends('layouts.main')

@section('content')
<div class="container">
   <div class="row">
      @guest
      <div class="heading mb250">
      </div>
      <div class="log-form">
         <div class="sec-title">
            <h2 style="color:white; font-size: 14px">Reset Password</h2>
         </div>
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
                    <input id="email" type="email" placeholder="Enter your email"  style="padding-left: 5px;" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong style="color:red;">{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4" style="text-align: center; width:100%;">
                    <button type="submit" class="btn btn-primary" >
                        {{ __('Send Password Reset Link') }}
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
   <div class="heading mb150">
    </div>
</div>

@endsection