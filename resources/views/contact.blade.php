@extends('layouts.main')
@section('content')
<div style="margin-bottom: 80px"></div>
<!-- Content -->
<div class="container">
   <div class="padding-top-md" >
      <div class="row">
         <div class="col-sm-12 border-bottom-sm">
            <h3 class="text-center">Contact Us</h3>
         </div>
      </div>
   </div>
   <div class="panel-body">
      <div class="row">
         <div class="col-xs-12 col-sm-4"></div>
         <div class="col-xs-12 col-sm-4 col-md-5">
            @if (Session::has('success_message'))
            <p class="alert alert-success">Message successfully sent</p>
            @endif
            <form method="post" action="{{ route('contact.store' )}}">
               {{csrf_field()}}
               <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control" placeholder="Name" name="name" value="{{ old('name') }}">
               </div>
               <div class="input-group padding-top-sm">
                  <span class="input-group-addon"><i class="fas fa-envelope"></i></span>
                  <input type="text" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
               </div>
               <div class="input-group padding-top-sm">
                  <span class="input-group-addon"><i class="fas fa-question"></i></span>
                  <input type="text" class="form-control" placeholder="Subject" name="subject" value="{{ old('subject') }}">
               </div>
               <div class="input-group padding-top-sm">
                  <textarea rows="10" cols="60"  placeholder="Message" name="message"  >{{ old('message') }}</textarea>
               </div>
               <div class="text-center">
                  <button class="btn btn-lg btn-primary"><i class="fa fa-close"></i>Submit</button>
               </div>
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
   </div>
</div>
<div style="margin-bottom: 70px"></div>
@stop