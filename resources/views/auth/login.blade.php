@extends('layouts.main')
@section('content')
<div class="container">
   <div class="row" >
      @guest
      <div class="mb350"></div>
      <!--log form -->
      <div class="log-form" >
         <div class="sec-title">
            <h2>Login to your account</h2>
         </div>
         <form method="POST" action="{{ route('login') }}">
            @csrf
            <label>Email Address</label>
            <input id="email" type="email" placeholder="Enter your email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>     
            <label>Password  </label>
            <input id="password" type="password" placeholder="Enter your account password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
            <label for="remember">Remember Me</label>
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
            <br>
            <button type="submit" class="btn">
            {{ __('Login') }}
            </button>
            <a class="forgot" href="password/reset">Forgot your password?</a>
            @if(count($errors))
            <ul class="alert alert-danger">
               @foreach($errors->all() as $error)
               <li class="login-error-message">{{$error}}</li>
               @endforeach
            </ul>
            @endif
         </form>
      </div>
      <!--end log form -->
      @else
      <script>window.location = "/home";</script>
      <div class="card">
         <div class="card-header">Login error</div>
         <div class="card-body">
            <p>You tried to access the login page, but you are already logged in.</p>
            <a href="{{ route('home') }}" class="btn btn-success">Return to home</a>
         </div>
      </div>
      @endguest
   </div>
</div>
@endsection