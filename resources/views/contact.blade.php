@extends('layouts.main')
@section('content')
<style>body { background-image: url(/imgs/contact/phone-laptop.jpg); background-size: cover; background-repeat: no-repeat; background-position: center right; }</style>
<div class="mb80"></div>
<h2 class="text-center contact-header">CONTACT US</h2>
<p class="text-center contact-subtext">Need assistance? Send us a message!</p>
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
<div class="container-form">
   <form method="post" action="{{ route('contact.store' )}}">
      {{csrf_field()}}
      <div class="contact-main">
         <input type="text" placeholder="Your Name" class="input" name="name" value="{{ old('name') }}">
         <input type="text" placeholder="Your Email Address" class="input" name="email" value="{{ old('email') }}">
      </div>
   <span id="advertise_warning" style="display:none;color:#e8786b;">Have an enquiry about Advertising? We recommend reading through <a href="{{route('advertise')}}" style="color:#15A8CD; font-size:15px;"> Advertise With Us</a> before submitting an enquiry</span>
      <div class="contact-main">
            <select id="enquiry_type" name="enquiry_type" class="select-enquiry" onchange="getResponse()">
                  <option selected="true" disabled>Select enquiry type</option>
                  <option value="Advertising" {{ old('enquiry_type') == "Advertising" ? 'selected' : '' }}>Advertising</option>
                  <option value="General" {{ old('enquiry_type') == "General" ? 'selected' : '' }}>General</option>
                  <option value="Coucher" {{ old('enquiry_type') == "Coucher" ? 'selected' : '' }}>Voucher</option>
            </select>
            <input type="text" placeholder="Your Phone Number" class="input" name="phone_number" value="{{ old('phone_number') }}">
      </div>
      <div class="msg">
         <textarea  class="area" placeholder="Leave a Message" name="message"  >{{ old('message') }}</textarea>
      </div>
      <div class="captcha">
      {!! NoCaptcha::renderJs() !!}
      {!! NoCaptcha::display() !!}
      </div>
      <button class='btn main-save-button' style="margin-top:20px;">Send message</button>
   </form>
</div>
<script>
function getResponse(drop_value){
   var e = document.getElementById("enquiry_type");
   var warn = document.getElementById("advertise_warning");
  var strUser = e.options[e.selectedIndex].value;
  if (strUser == 'Advertising') {
   warn.style.display = "inline";
  } else {
    warn.style.display = "none";
  }
}
</script>
<h2 class="text-center contact-or contact-sep" >OR</h2>
<p class="text-center contact-call">Give us a call on <a href="tel:+61425638428" class="contact-phone contact-call-on">0425 638 428</a></p>
<div class="mb100"></div>
@stop