@extends('layouts.main')
@section('content')
<style>
body { 
  background-image: url(../imgs/login/coast-bay-min.jpg); 
  background-size: cover;
  background-repeat: no-repeat; 
  background-position: center center; 
}
.login {
  height:  275px;
}
</style>
<div class="mb300"></div>
<div class="container">
   <div class="login" id="login">
      <form method="POST" action="{{ route('password.email') }}">
         @csrf
         <h1><span>GCD</span> Reset</h1>
         <input id="email" type="email" placeholder="Enter your email"  class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
         <button type="submit">Send reset link</button>
         <p class="text-center"><a class="login-a" href="{{route('login')}}"> Return to login</a></p>
      </form>
      @if (session('status'))
      <div class="alert alert-success" role="alert">
         {{ session('status') }}
      </div>
      @endif
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