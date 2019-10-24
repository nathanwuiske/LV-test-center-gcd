@extends('layouts.main')
@section('content')

<style>
  .about {
    padding: 130px 0;
    padding-top:80px;
}

.about .heading h2 {
    font-size: 30px;
    font-weight: 700;
    margin: 0;
    padding: 0;
    color:black;

}

.about p {
    font-size: 15px;
    font-weight: 400;
    line-height: 1.7;
    color: #999999;
    margin: 20px 0 15px;
    padding: 0;
   color:black;
}

.card-body{
   text-align:center;
}

.responsive{
   max-width: 100%;
   height: auto;

}
</style>

<section class="about" id="about">
    <div class="container">
        <div class="heading text-center">
            <h2>For Gold Coast Business</h2>
        </div>
        <div *ngIf="messageDetails == 2">
            <div class="card card-body">
               <p> A highly successful
                     Gold Coast project
                     <strong>THAT SUPPORTS LOCAL BUSINESS.</strong> <br> Plug your business into the largest
                  consumer and customer networks
                  on the Gold Coast
               </p>
               <img src='imgs/about/business/1.png' height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p> This is not about advertising & discounts
                  we are about consumer ENGAGEMENT.
               </p>
               <img src='imgs/about/business/2.jpg' height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p>We have been responsible for millions of
                  $$$ in turnover for Gold Coast business
               </p>
               <img src='imgs/about/business/3.jpg' height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p>Return YEAR ROUD consumer results</p>
               <img src='imgs/about/business/4.jpg' height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p>Save you 1000ʼs of $$$ each year in advertising</p>
               <img src='imgs/about/business/5.jpg' height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p>With "project" pricing made affordable for ALL Gold Coast business</p>
               <img src='imgs/about/business/6.jpg' height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p>We are engaged with 100ʼs and 1000ʼs of
                  Gold Coast customers and we want to
                  put them in touch with YOUR BUSINESS. 
               </p>
               <img src='imgs/about/business/7.png' height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p>We have references from the most
                  sucessful businesses on the Gold Coast
               </p>
               <img src='imgs/about/business/8.jpg' height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p>There is no logical reason
                  for us not to speak.
               </p>
               <img src='imgs/about/business/9.png' height="520" width="520" class="responsive">
            </div>
            <a href="https://goldcoastdiscounts.com.au/advertise">
               <div class="card card-body">
               <a href="{{route("advertise")}}" style="color:#007ACC;font-size:17px;">Click here to Advertise With Us</a>
               </div>
            </a>
         </div>
    </div>
</section>

<div class="mb50"></div>
@stop