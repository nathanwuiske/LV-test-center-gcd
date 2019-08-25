@extends('layouts.main')
@section('content')
<style>
   body{
   background-color: #F3F3F3;
   background-attachment: fixed !important;
   background-position: center center;
   background-repeat: no-repeat;
   background-size: cover;
   padding: 0;
   }
</style>
<section class="advertiseFacts">
   <div class="parallax-overlay-app">
      <div class="container">
         <div class="row">
            <div class=" text-center mb50">
               <h2 class="advert" style="margin-bottom:15px; color:black">Download our app</h2>
               <p style="color:black;"> Use all your favourite deals on your phone</p>
               <div class="devider" style="margin-top:0; color:black"><i style=" color:black"class="fas fa-arrow-down fa-lg"></i></div>
            </div>
            <div class=" text-center mb50 app-mobile">
               <a href="#"><img src="/imgs/apple.jpg"></a>
               <a href="#"><img src="/imgs/google.jpg"></a>
            </div>
         </div>
      </div>
   </div>
</section>
<div class="mb300"></div>
@stop