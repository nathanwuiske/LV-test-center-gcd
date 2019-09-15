@extends('layouts.main')
@section('content')
<div class="mb80"></div>
<style>
  body{
    background-color:white;
  }
  @media only screen and (max-width: 767px) {
  .small-screen {
   width:100%;
   height:100%;
  }
}
  </style>
<div class="container">
   <div class="row">
      <div class="col-sm-12">
         <h2 class="text-center" style="color:#07AD4D">Payment Success!</h2><br>
      </div>
   </div>
   <div class="alert alert-success text-center">
      <p class="text-center">Your payment was successfully completed.</p>
      <p class="text-center">We've emailed you a copy of your receipt and will be in contact with you in the next 24 hours. </p>
  </div>
  
  
   <div class="text-center">
     <img class="small-screen" src="/imgs/payment/success.gif" loop=false>
   </div>


</div>
<div class="mb250"></div>
@stop