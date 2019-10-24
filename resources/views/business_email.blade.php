@extends('layouts.main')
@section('content')
<style>body { background-image: url(/imgs/contact/phone-laptop.jpg); background-size: cover; background-repeat: no-repeat; background-position: center right; }</style>
<div class="mb80"></div>
<h2 class="text-center contact-header">Add Email</h2>
<p class="text-center contact-subtext">Gold Coast Discounts client management</p>
<div class="container-message">
      @if (Session::has('success_message'))
      <p class="alert alert-success">Record successfully added to database</p>
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
   <form method="post" action="{{ route('business.store')}}">
      {{csrf_field()}}
      <div class="contact-main">
          <input type="email" placeholder="Enter Email Address" class="input" name="business_email" type="email" value="{{ old('business_email') }}">
         <input type="text" placeholder="Enter business name (OPTIONAL)" class="input" name="business_name" value="{{ old('business_name') }}">
      </div>
        <div class="contact-main">
             <input type="text" placeholder="Enter client's name (OPTIONAL)" class="input" name="client_name" value="{{ old('client_name') }}">
              <input type="text" placeholder="Enter client's phone number (OPTIONAL)" class="input" name="client_phone" value="{{ old('client_phone') }}">
             </div>
             
      
      <button class='btn main-save-button' style="margin-top:20px;">Submit</button>
      
   </form>
</div>
<div class="mb100"></div>
@stop