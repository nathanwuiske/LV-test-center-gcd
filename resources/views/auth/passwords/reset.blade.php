@extends('layouts.main')
@section('content')
<style>
body { 
  background-image: url(/imgs/coast-bay-min.jpg);
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center center; 
}
.login {
  position: relative;
  margin: 0 auto;
  margin-top: 100px;
  left: 15%;
  width: 28%;
  height:  350px;
  -webkit-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}

</style>
<div class="mb300"></div>
<div class="container">
   <div class="login" id="login">
      <form method="POST" action="{{ route('password.update') }}">
         @csrf
         <input type="hidden" name="token" value="{{ $token }}">
         <h1><span>GCD</span> Reset</h1>
         <input id="email" placeholder="Enter your email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>
         <input id="password"  placeholder="Enter your new password" style="padding-left: 8px;" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
         <input id="password-confirm" placeholder="Confirm your new password" style="padding-left: 8px;" type="password" class="form-control" name="password_confirmation" required>
         <button type="submit">{{ __('Reset Password') }}</button>
      </form>
      @if(count($errors))
      <ul class="alert alert-danger">
         @foreach($errors->all() as $error)
         <li class="login-error-message">{{$error}}</li>
         @endforeach
      </ul>
      @endif
   </div>
</div>
<div class="mb300"></div>
@endsection