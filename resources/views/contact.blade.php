@extends('layouts.main')
@section('content')
<style>body { background-image: url(/imgs/contact/phone-laptop.jpg); background-size: cover; background-repeat: no-repeat; background-position: center right; }</style>
<div class="mb80"></div>
<h2 class="text-center contact-header">CONTACT US</h2>
<p class="text-center contact-subtext"> Have any inquiries? Send us a message!</p>
<div class="container-form">
   <form method="post" action="{{ route('contact.store' )}}">
      {{csrf_field()}}
      <div class="contact-main">
         @auth
         <input type="text" placeholder="Your Name" class="input" name="name" value="{{Auth::user()->full_name}}">
         <input type="text" placeholder="Your Email Address" class="input" name="email" value="{{Auth::user()->email}}">
         @endauth
         @guest
         <input type="text" placeholder="Your Name" class="input" name="name" value="{{ old('name') }}">
         <input type="text" placeholder="Your Email Address" class="input" name="email" value="{{ old('email') }}">
         @endguest
      </div>
      <div class="subject">
         <input type="text" placeholder="Subject" class="input" name="subject" value="{{ old('subject') }}">
      </div>
      <div class="msg">
         <textarea  class="area" placeholder="Leave a Message" name="message"  >{{ old('message') }}</textarea>
      </div>
      <button class='btn main-save-button'>Send message</button>
   </form>
</div>
<h2 class="text-center contact-or contact-sep">OR</h2>
<p class="text-center contact-call">Give us a call on <a href="tel:+61425638428" class="contact-phone contact-call-on">0425 638 428</a></p>
<div class="container-message">
   @if (Session::has('success_message'))
   <p class="alert alert-success">Message successfully sent</p>
   @endif
   @if(count($errors))
   <ul class="alert alert-danger">
      @foreach($errors->all() as $error)
      <li class="login-error-message">{{$error}}</li>
      @endforeach
   </ul>
   @endif
</div>
<div class="mb70"></div>
@stop