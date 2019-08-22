@extends('layouts.main')
@section('content')
<style>
body { 
  background-image: url(../imgs/login/coast-bay-min.jpg); 
  background-size: cover;  
  background-repeat: no-repeat; 
  background-position: center center; 
}
</style>

<div style="margin-bottom: 300px"></div>
<div class="container">
   <div class="login" id="login">
      <form method="POST" action="{{ route('login') }}">
         @csrf
         <h1><span>GCD</span> Login</h1>
         <input type="email" id="email-login" class="{{ $errors->has('email-login') ? ' is-invalid' : '' }}" name="email" placeholder="Enter your email" required autofocus> 
         <input type="password" id="password-login" class="{{ $errors->has('password-login') ? ' is-invalid' : '' }}" name="password" placeholder="Enter your password" required>
         <label class="rememberlabel"> Remember me </label>
         <input class="rememberinput" style="background-color:transparent;" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
         <button type="submit">Login</button>
         <p class="text-center" style="color:white;"> <br>New User? <br> <a class="login-a cursor-pointer" onclick="changeTab(event, 'register')">Create an account</a> </p>
         <p class="text-center "><a class="login-a" href="password/reset"> I forgot my password</a></p>
      </form>
      @if(count($errors))
      <ul class="alert alert-danger">
         @foreach($errors->all() as $error)
         <li class="login-error-message">{{$error}}</li>
         @endforeach
      </ul>
      @endif
   </div>
   <div class="login" id="register" style="display:none">
      <form method="POST" action="{{ route('register') }}">
         @csrf
         <h1><span>GCD</span> Register</h1>
         <input id="full_name" placeholder="Enter your name"  type="text" class="{{ $errors->has('full_name') ? ' is-invalid' : '' }}" name="full_name" value="{{ old('full_name') }}" required>
         <input id="email" placeholder="Enter your email" type="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
         <input id="password" placeholder="Enter your password" type="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
         <input id="password-confirm" placeholder="Confirm your password" type="password" name="password_confirmation" required>
         <button type="submit">Register</button>
         <p class="text-center" style="color:white;"> Already have an account? <br> <a class="login-a"  onclick="changeTab(event, 'login')">Login here</a> </p>
      </form>
   </div>
</div>
<div style="margin-bottom: 300px"></div>
<script>
function changeTab(evt, name) {
    var i;
    var x = document.getElementsByClassName("login");
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
    }
    document.getElementById(name).style.display = "block";
}
</script>
         
@endsection