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
            <h2>Case Study</h2>
        </div>
        <div>
            <div class="card card-body">
               <p>Australian Business Projects provides
                     bleeding edge solution for community,
                     business and government</p>
               <img src='imgs/about/casestudy/1.jpg' height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p>This project is a ten year study of the Gold Coast community,
                  consumer and business engagement. 
               </p>
               <img src='imgs/about/casestudy/2.jpg' height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p>It is highly successful, free for the
                  community and responsible for millions of
                  dollars in turnover for Gold Coast business 
               </p>
               <img src='imgs/about/casestudy/3.jpg' height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p> We understand the Gold Coast better than anyone</p>
               <img src='imgs/about/casestudy/4.jpg' height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p> We work with the best... </p>
               <img src='imgs/about/casestudy/5.png' height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p> And mentor them too...</p>
               <img src='imgs/about/casestudy/6.jpg' height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p> Whether youʼve got a local problem...</p>
               <img src='imgs/about/casestudy/7.png' height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p>Or a national concern.. We can help! </p>
               <img src='imgs/about/casestudy/8.jpg'  height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p> Weʼve provide bleeding edge solutions for community, business and government.</p>
               <img src='imgs/about/casestudy/9.jpg'  height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p> Projects that provide irrefutable solution to drug addiction and rehabilitation. Ceases
                  (ICE) and methamphetamine use in it tracks. 
               </p>
               <img src='imgs/about/casestudy/10.jpg'  height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p>Visit our website to see more about us
                  your community and our projects
                  <a href="https://www.australianbusinessprojects.com.au/" style="color:#007ACC;font-size:17px;">www.AustralianBusinessProjects.com.au</a>
               </p>
               <img src='imgs/about/casestudy/11.jpg' height="520" width="520" class="responsive">
            </div>
         </div>
    </div>
</section>

<div class="mb50"></div>
@stop