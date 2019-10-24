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
            <h2>Gold Coast Business Network</h2>
        </div>
        <div>
            <div class="card card-body">
               <p>FREE Gold Coast
                     BUSINESS NETWORK
                     for all local business. <br>Get discounted rates for all types of business services.</p>
               <p><strong>Letterbox Deliveries</strong><br> GC Business Network discounted rates</p>
               <img src='imgs/about/businessnetwork/1.png' height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p><strong>Business Printing</strong><br> GC Business Network discounted rates</p>
               <img src='imgs/about/businessnetwork/2.png' height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p><strong>Business Signage</strong><br> GC Business Network discounted rates</p>
               <img src='imgs/about/businessnetwork/3.jpg' height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p><strong>Printer Ink & Toners</strong><br> GC Business Network discounted rates</p>
               <img src='imgs/about/businessnetwork/4.jpg' height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p>FREE Gold Coast Positions Vacant<br> SAVE money on advertising for staff</p>
               <img src='imgs/about/businessnetwork/5.jpg' height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p>NEW GC Book Keeping service starts 2020</p>
               <img src='imgs/about/businessnetwork/6.jpg' height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p><strong>Accounting & Lawyers</strong><br> GC Business Network discounted rates</p>
               <img src='imgs/about/businessnetwork/7.jpg' height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p>If your business is lucky enough to showcase on this page..<br> youʼre probably going to sell!</p>
               <img src='imgs/about/businessnetwork/8.png' height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p>And if youʼre in crisis... we can help!<br> We know the Gold Coast better than anyone. </p>
               <img src='imgs/about/businessnetwork/9.jpg' height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
             
            </div>
         </div>
    </div>
</section>

<div class="mb50"></div>
@stop