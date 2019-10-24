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
            <h2>For Gold Coast Locals</h2>
        </div>
        <div>
            <div class="card card-body">
               <p>FREE Gold Coast Discounts with 100’s of deals saving Gold Coast LOCALS.
                  If you like BUY one GET 1 FREE we’ve got heaps of them
               </p>
               <img src='imgs/about/locals/1.jpg' height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p> ...we’ve also got the best Chicken Palmi on the GC too!</p>
               <img src='imgs/about/locals/2.png' height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p>We service a GC customer network of over 500,000 LOCAL residents, families, seniors</p>
               <img src='imgs/about/locals/3.jpg' height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p>AND visitors to the Gold Coast.</p>
               <img src='imgs/about/locals/4.jpg' height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p>And.. we’re not just the best in meal deals...</p>
               <img src='imgs/about/locals/5.jpg' height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p>We’ve got value everywhere... FOR everyone!</p>
               <img src='imgs/about/locals/6.jpg' height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p>FREE Music Lessons</p>
               <img src='imgs/about/locals/7.jpg' height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p>$89 Car Services, saving you 100’s of $$$</p>
               <img src='imgs/about/locals/8.jpg' height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p>Right through to FREE Wedding Receptions.. We’ve got everything...</p>
               <img src='imgs/about/locals/9.jpg' height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p>for you...</p>
               <img src='imgs/about/locals/10.jpg' height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p>for you...</p>
               <img src='imgs/about/locals/11.jpg' height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p>AND even you</p>
               <img src='imgs/about/locals/12.png' height="520" width="520" class="responsive">
            </div>
            <div class="card card-body">
               <p>ALL our vouchers are FREE. So please give us a shout out... "Like us" on Facebook
                  and share this App with your facebook friends.
               </p>
               <a href="https://www.facebook.com/GoldCoastDiscounts/">
               <img src='imgs/about/locals/facebook.png' height="320" width="500" class="responsive"></a>
            </div>
         </div>
    </div>
</section>

<div class="mb50"></div>
@stop