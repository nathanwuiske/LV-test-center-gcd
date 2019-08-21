@extends('layouts.main')
@section('content')
<div class="container">
   <div class="row">
      @guest
      <div class="mb350"></div>
      <!--register form -->
      <div class="log-form">
         <div class="sec-title">
            <h2>Register new user</h2>
         </div>
         <form method="POST" action="{{ route('register') }}">
            @csrf
            <input id="full_name" placeholder="Name"  type="text" class="{{ $errors->has('full_name') ? ' is-invalid' : '' }}" name="full_name" value="{{ old('full_name') }}" required autofocus>
            <input id="email" placeholder="Email" type="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
            <input id="password" placeholder="Password" type="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
            <input id="password-confirm" placeholder="Confirm Password" type="password" name="password_confirmation" required>
            <div class="form-group row mb-0">
               <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn">
                  {{ __('Register') }}
                  </button>
               </div>
            </div>
            @if(count($errors))
            <ul class="alert alert-danger">
               @foreach($errors->all() as $error)
               <li class="login-error-message">{{$error}}</li>
               @endforeach
            </ul>
            @endif
         </form>
      </div>
      <!--end register form -->
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