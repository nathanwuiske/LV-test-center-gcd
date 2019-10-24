@extends('layouts.main')
@section('content')
<!-- Start advertise facts section -->
<section id="advertiseFacts" class="advertiseFacts">
   <div class="parallax-overlay">
      <div class="container">
         <div class="row">
            <!--  <div class="sec-title text-center mb50 wow rubberBand animated" data-wow-duration="1000ms"> -->
            <div class=" text-center mb50">
               <h2 class="advert">Australian Business Projects is responsible for millions of $$$$ in turnover for Gold Coast Business</h2>
               <div class="devider"><i class="fas fa-arrow-down fa-lg"></i></div>
            </div>
           
            <div class="col-md-4 col-sm-12 col-xs-12 text-center wow fadeInUp animated" data-wow-duration="500ms" data-wow-delay="300ms">
               <a href="{{route('about')}}">
               <div class="fact-item">
                  <i class="fas fa-users fa-3x"></i>
                  <h2>Engage</h2>
                  <p>Gold Coast community, consumer and business engagement</p>
               </div>
            </a>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 text-center wow fadeInUp animated" data-wow-duration="500ms" data-wow-delay="600ms">
            <a href="{{route('about')}}">
               <div class="fact-item">
                  <i class="fas fa-bolt fa-3x"></i>
                  <h2>Effective</h2>
                  <p>Highly Successful, delivering year round business results</p>
               </div>
            </a>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 text-center wow fadeInUp animated" data-wow-duration="500ms" data-wow-delay="900ms">
               <a href="{{route('about')}}">
               <div class="fact-item">
                  <i class="fas fa-dollar-sign fa-3x"></i>
                  <h2>Cheap</h2>
                  <p>Project pricing made affordable for every Gold Coast business</p>
               </div>
            </a>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12 text-center" style="top:70px;">
            <a href="{{route('advertiser_about')}}" class="ad-linker">  <p> <i class="far fa-address-card"></i>
                      Click here to find out more about us</p>   </a>
            </div>

         </div>
      </div>
   </div>
</section>
<!-- End advertise facts section -->

<!-- Start Package 1 section -->
<section id="features" class="features">
   <div class="container">  
         <div class="row">
               
      <div class="row">

         <h2 class="text-center mb10"  style="color:black;">Package 1</h2>
     <p class="text-center fontSize17 mb20"  style="color:black"><strong>12 Months (FULL YEAR)</strong> consumer engagement with project prices that support Gold Coast businesses
         
      
         </p>

  

         <!-- Start info item -->
         <div class="col-md-4 wow fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
            <div class="service-item">
               <div class="service-icon">
                  <i class="fas fa-ad fa-2x"></i>
               </div>
               <div class="service-desc">
                  <h3><span class="advert-red">50,000</span> Printed Ads</h3>
                  <p>Printed and distributed into Gold Coast letterboxes and homes for only 1 cent each.</p>
               </div>
            </div>
         </div>
         <!-- End service item -->

         <!-- Start info item -->
         <div class="col-md-4 wow fadeInRight" data-wow-duration="500ms" data-wow-delay="800ms">
            <div class="service-item">
               <div class="service-icon">
                  <i class="fas fa-mobile-alt fa-2x"></i>
               </div>
               <div class="service-desc">
                  <h3><span class="advert-red">x(2)</span> Digital Ads</h3>
                  <p>Promoting your business directly into customers mobile phones.</p>
               </div>
            </div>
         </div>
         <!-- End service item -->

         <!-- Start info item -->
         <div class="col-md-4 wow fadeInDown" data-wow-duration="500ms"  data-wow-delay="1200ms">
            <div class="service-item">
               <div class="service-icon">
                  <i class="fab fa-facebook-square fa-2x"></i>
               </div>
               <div class="service-desc">
                  <h3><span class="advert-red">x(7)</span> Digital Medias &nbsp;</h3>
                  <p>Gold Coast Medias & Apps consumers and customers like, love and follow.</p>
               </div>
            </div>
         </div>
         <!-- End service item -->
      </div>
   </div>
</section>
<!-- End section -->


<section id="features" class="features">
   <div class="container">
      <div class="row">
         <h2 class="text-center mb10"  style="color:black">Package 2</h2>
         <p class="text-center fontSize17 mb20"  style="color:black"><strong>12 Months (FULL YEAR)</strong> 
            consumer engagement TO THE MAX... our most popular deal!</p>
         <!-- Start info item -->


         <!-- Start info item -->
         <div class="col-md-4 wow fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
            <div class="service-item">
               <div class="service-icon">
                  <i class="fas fa-ad fa-2x"></i>
               </div>
               <div class="service-desc">
                  <h3><span class="advert-red">1/4 Million</span> Printed Ads</h3>
                  <p>Printed and distributed into Gold Coast letterboxes and homes for LESS than 1/4 of a cent each.</p>
               </div>
            </div>
         </div>
         <!-- end service item -->

         <!-- Start info item -->
         <div class="col-md-4 wow fadeInRight" data-wow-duration="500ms" data-wow-delay="800ms">
            <div class="service-item">
               <div class="service-icon">
                  <i class="fas fa-mobile-alt fa-2x"></i>
               </div>
               <div class="service-desc">
                  <h3><span class="advert-red">x(3)</span> Digital Ads</h3>
                  <p>Promoting your business directly into customers mobile phones.</p>
               </div>
            </div>
         </div>
         <!-- end service item -->

         <!-- Start info item -->
         <div class="col-md-4 wow fadeInDown" data-wow-duration="500ms"  data-wow-delay="1200ms">
            <div class="service-item">
               <div class="service-icon">
                  <i class="fab fa-facebook-square fa-2x"></i>
               </div>
               <div class="service-desc">
                  <h3><span class="advert-red">x(7)</span> Digital Medias&nbsp;</h3>
                  <p>Gold Coast Medias & Apps consumers and customers like, love and follow.</p>
               </div>
            </div>
         </div>
         <!-- end service item -->

         <!-- Pricing -->
         <div class="col-md-12" style="margin-top:20px;">
            <h2 class="text-center" class="pt40"  style="color:black"> Pricing </h2>
            <p style="font-size:16px;color:black;" class="text-center" >Most ads live within 24 to 48 hours
                  <br>Get free artwork and save <strong>$150</strong> per ad<br>
                  Choose your prefered consumer engagement...
               </p>
         </div>
       
         <div class="columns">
            <ul class="price">
               <li class="header" style="line-height:25px;">Package 1 <br>FREE artwork 3 ads save $450</li>
               <li class="grey">50,000 Brochure Ads / x2 Digital Ads</li>
               <li class="grey">2 easy payments of $350 + GST</li>
               <li>Pay $350+GST deposit to start advertising<br> now and $350+GST balance in 45 days.</li>
               <li><a style="cursor:pointer;" 
                  id="checkout-button-sku_FmcZ9GjDHPAU6s" role="link" class="button">Buy Now</a></li>
               <li class="greyli"> <strong>OR</strong></li>
               <li>Pay in full and get an extra 25% off <br> 3 months advertising FREE valued at <strong>$206.25</strong><br>
                  + Free artwork on 4 ads, our project prices have already saved you <strong>$656.25!</strong> 
                  
                  
                  </li>
               <li class="grey">$750 / year + GST</li>
               <li><a style="cursor:pointer;" 
                  id="checkout-button-sku_FpWnbvDwN6vqjx" role="link" class="button">Buy Now</a></li>
            </ul>
         </div>
         <div class="columns">
            <ul class="price">
               <li class="header" style="line-height:25px;">Package 2<br> FREE artwork 4 ads save $600</li>
               <li class="grey">1/4 Million Brochure Ads / x3 Digital ads</li>
               <li class="grey">2 easy payments of $750 + GST</li>
               <li>Pay $750+GST deposit to start advertising <br> now and $750+GST balance in 45 days.</li>
               <li><a style="cursor:pointer;" 
                  id="checkout-button-sku_FmcgVy3ZmwBs3m" role="link" class="button">Buy Now</a></li>
               <li class="greyli"> <strong>OR</strong></li>
               <li>Pay in full and get an extra 25% off <br> 
                 12 months advertising and extra 3 months FREE, valued at <strong>$412.55</strong><br>
                  + Free artwork on 4 ads, our project prices have already saved you <strong>$1012.55!</strong> 
                  
                  
                  </li>
             

               <li class="grey">$1500 / year + GST</li>
               <li><a style="cursor:pointer;" 
                  id="checkout-button-sku_Fmal6moKvciwrb" role="link" class="button">Buy Now</a></li>
            </ul>     
            <div id="error-message"></div>
         </div>
      </div>
   </div>
</section>


<script src="https://js.stripe.com/v3"></script>

<script>
    var stripe = Stripe('pk_live_F5Iryw4XwWpZVg0rXhNk4M7x');

    var checkoutButton = document.getElementById('checkout-button-sku_FpWnbvDwN6vqjx');
    checkoutButton.addEventListener('click', function () {
    stripe.redirectToCheckout({
      items: [{sku: 'sku_FpWnbvDwN6vqjx', quantity: 1}],
      successUrl: 'https://localdiscounts.com.au/success',
      cancelUrl: 'https://localdiscounts.com.au/advertise',
      billingAddressCollection: 'required',
    })
    .then(function (result) {
      if (result.error) {
        var displayError = document.getElementById('error-message');
        displayError.textContent = result.error.message;
      }
    });
  });


  var checkoutButton1 = document.getElementById('checkout-button-sku_FmHiWAZZn5y1Fk');
  checkoutButton1.addEventListener('click', function () {
    stripe.redirectToCheckout({
      items: [{sku: 'sku_FmHiWAZZn5y1Fk', quantity: 1}],
      successUrl: 'http://127.0.0.1:8000/success',
      cancelUrl: 'http://127.0.0.1:8000/advertise',
      billingAddressCollection: 'required',
    })
    .then(function (result) {
      if (result.error) {
        var displayError = document.getElementById('error-message');
        displayError.textContent = result.error.message;
      }
    });
  });

  var checkoutButton2 = document.getElementById('checkout-button-sku_FmcZ9GjDHPAU6s');
  checkoutButton2.addEventListener('click', function () {
    stripe.redirectToCheckout({
      items: [{sku: 'sku_FmcZ9GjDHPAU6s', quantity: 1}],
      successUrl: 'http://127.0.0.1:8000/success',
      cancelUrl: 'http://127.0.0.1:8000/advertise',
      billingAddressCollection: 'required',
    })
    .then(function (result) {
      if (result.error) {
        var displayError = document.getElementById('error-message');
        displayError.textContent = result.error.message;
      }
    });
  });

  var checkoutButton3 = document.getElementById('checkout-button-sku_FmcgVy3ZmwBs3m');
  checkoutButton3.addEventListener('click', function () {
    stripe.redirectToCheckout({
      items: [{sku: 'sku_FmcgVy3ZmwBs3m', quantity: 1}],
      successUrl: 'http://127.0.0.1:8000/success',
      cancelUrl: 'http://127.0.0.1:8000/advertise',
      billingAddressCollection: 'required',
    })
    .then(function (result) {
      if (result.error) {
        var displayError = document.getElementById('error-message');
        displayError.textContent = result.error.message;
      }
    });
  });
</script>
@stop