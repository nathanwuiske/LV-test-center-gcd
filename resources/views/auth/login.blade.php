@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row justify-content-center">
        <div class="col-md-8">
        @guest
        <div class="heading">
            <h1>GCD-Admin</h1>
        </div>
            <div class="card">
                <div class="card-header">Login</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <p class='control'>
                                <input id="email" type="email" placeholder="Enter your email" class="email form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                <span class='input-icon'></span>
                                </p>
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
                                <p class='control'>
                                <input id="password" type="password" placeholder="Enter your account password" class="pass form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                <span class='input-icon-pass'></span>
                                 </p>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @else
        <script>window.location = "/home";</script>
        <div class="card">
                <div class="card-header">Login error</div>
                <div class="card-body">
                    <p>You tried to access the login page, but you are already logged in.</p>
                    <a href="{{ route('home') }}" class="btn btn-success">Return to dashboard</a>
                </div>
            </div>
        @endguest
        </div>
    </div>
</div>
@endsection
