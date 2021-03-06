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
               <div class="fact-item">
                  <i class="fas fa-bolt fa-3x"></i>
                  <h2>Fast</h2>
                  <p>Most ads live within 24-48hrs</p>
               </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 text-center wow fadeInUp animated" data-wow-duration="500ms" data-wow-delay="600ms">
               <div class="fact-item">
                  <i class="fas fa-users fa-3x"></i>
                  <h2>Effective</h2>
                  <p>Engage your business with 1000's of customers</p>
               </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 text-center wow fadeInUp animated" data-wow-duration="500ms" data-wow-delay="900ms">
               <div class="fact-item">
                  <i class="fas fa-dollar-sign fa-3x"></i>
                  <h2>Cheap</h2>
                  <p>Best priced advertising on the Gold Coast</p>
               </div>
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
<style>
   
     
      h3{
          color:black;
       }
       h4{
          color:black;
          font-size:20px;
       }
       .align-engage{
           position:relative;
           left:130px;
      }
       @media only screen and (max-width: 1024px) {
           .align-point{
               left:0;
          }
           .phone-down{
               position:relative;
               top:15px;
          }
      }
       @media only screen and (max-width: 600px) {
          .phone-down{
            
             bottom:20px;
          }
           .display-no{
               display:none;
          }
           .align-engage{
               left:0px;
          }
           .about h4 {
               font-size: 18px;
               font-weight: 500;
               color:black;
               margin: 8px 0;
          }
      }
      
        </style>
<!-- Start Package 1 section -->
<section id="features" class="features">
   <div class="container">  
   
      <div class="row">
             <div class="col-lg-12 ">
                  <h3 class="text-center phone-down" style="margin-bottom:20px;">Engage your business with the Gold Coast</h3>
                  <p class="text-center fontSize17" style="color:black;">This project services a Gold Coast <strong>consumer network of over 500,000</strong> 
                     Locals, Residents, Families, Seniors, AND Visitors to the Coast.
                  </p>

                  <div class="row align-engage">
                     <div class="col-md-6">
                        <h4><i style="color:#07AD4D;" class="far fa-star"></i> GC Printed Brochures</h4>
                     </div>
                     <div class="col-md-6">
                        <h4><i style="color:#07AD4D;" class="far fa-star"></i> GoldCoastDiscounts.com.au</h4>
                     </div>
                     <div class="col-md-6">
                        <h4><i style="color:#07AD4D;" class="far fa-star"></i> GC Letterbox Deliveries</h4>
                     </div>
                     <div class="col-md-6">
                        <h4><i style="color:#07AD4D;" class="far fa-star"></i> Android App</h4>
                     </div>
                     <div class="col-md-6">
                        <h4><i style="color:#07AD4D;" class="far fa-star"></i> GC Digital Brochures</h4>
                     </div>
                     <div class="col-md-6">
                        <h4><i style="color:#07AD4D;" class="far fa-star"></i> iOS App</h4>
                     </div>
                     <div class="col-md-6">
                        <h4><i style="color:#07AD4D;" class="far fa-star"></i> FreeMealDeals.com.au</h4>
                     </div>
                     <div class="col-md-6">
                        <h4><i style="color:#07AD4D;" class="far fa-star"></i> Facebook / GCD</h4>
                     </div>
                  </div>
                  <p class="text-center fontSize17" style="margin-top:10px;color:black;">This is not a project about advertising or discount companies, 
                     <strong>this is a project about community, consumer and business engagement.</strong>
                  </p>
               </div>
            </div>    
      <div class="row">
         <br>
         <h2 class="text-center mb10"  style="color:black">Package 1</h2>
         <p class="text-center fontSize17 mb20"  style="color:black"><strong>12 Months (FULL YEAR)</strong> consumer engagement affordable for ALL Gold Coast Business
         
         
         </p>
         <p class="text-center fontSize17 mb20"  style="color:black">This includes</p>

         <!-- Start info item -->
         <div class="col-md-3 wow fadeInLeft" data-wow-duration="500ms">
            <div class="service-item">
               <div class="service-icon">
                  <i class="fas fa-ad fa-2x"></i>
               </div>
               <div class="service-desc"> 
                  <h3><span class="advert-red">x(3)</span> Advertisements</h3>
                  <p>12 Months, multiple advertisements, year round customer engagement</p>
               </div>
            </div>
         </div>
         <!-- End service item -->

         <!-- Start info item -->
         <div class="col-md-3 wow fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
            <div class="service-item">
               <div class="service-icon">
                  <i class="fas fa-newspaper fa-2x"></i>
               </div>
               <div class="service-desc">
                  <h3><span class="advert-red">50,000</span> Printed Ads</h3>
                  <p>Printed and distributed into Gold Coast letterboxes and homes for only 1 cent each.</p>
               </div>
            </div>
         </div>
         <!-- End service item -->

         <!-- Start info item -->
         <div class="col-md-3 wow fadeInRight" data-wow-duration="500ms" data-wow-delay="800ms">
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
         <div class="col-md-3 wow fadeInDown" data-wow-duration="500ms"  data-wow-delay="1200ms">
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
         <p class="text-center fontSize17 mb20"  style="color:black">This includes</p>

         <!-- Start info item -->
         <div class="col-md-3 wow fadeInLeft" data-wow-duration="500ms">
            <div class="service-item">
               <div class="service-icon">
                  <i class="fas fa-ad fa-2x"></i>
               </div>
               <div class="service-desc">
                  <h3><span class="advert-red">x(4)</span> Advertisements</h3>
                  <p>12 Months, multiple advertisements, year round customer engagement </p>
               </div>
            </div>
         </div>
         <!-- end service item -->

         <!-- Start info item -->
         <div class="col-md-3 wow fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
            <div class="service-item">
               <div class="service-icon">
                  <i class="fas fa-newspaper fa-2x"></i>
               </div>
               <div class="service-desc">
                  <h3><span class="advert-red">1/4 Million</span> Printed Ads</h3>
                  <p>Printed and distributed into Gold Coast letterboxes and homes for LESS than 1/4 of a cent each.</p>
               </div>
            </div>
         </div>
         <!-- end service item -->

         <!-- Start info item -->
         <div class="col-md-3 wow fadeInRight" data-wow-duration="500ms" data-wow-delay="800ms">
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
         <div class="col-md-3 wow fadeInDown" data-wow-duration="500ms"  data-wow-delay="1200ms">
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
         <div class="col-md-12" style="margin-top:50px;">
            <h2 class="text-center" class="pt40"  style="color:black"> Pricing </h2>
            <p style="font-size:16px;color:black;" class="text-center" > Choose your preferred deal</p>
         </div>
       
         <div class="columns">
            <ul class="price">
               <li class="header" style="line-height:25px;">Package 1 <br>50,000 Brochure Ads / x2 Digital Ads</li>
               <li class="grey">2 easy payments of $350 + GST</li>
               <li>Pay $350 deposit NOW to start advertising<br> and $350 balance in 45 days.</li>
               <li><a style="cursor:pointer;" 
                  id="checkout-button-sku_FpWnjp4aOiaHmX" role="link" class="button">Buy Now</a></li>
               <li class="greyli"> <strong>OR</strong></li>
               <li>Pay in full and get an extra 3 months advertising <strong>FREE</strong> <br> Advertising you right through 2021,
               saving you <strong>$206.25</strong></li>
               <li class="grey">$750 / year + GST</li>
               <li><a style="cursor:pointer;" 
                  id="checkout-button-sku_FpWnbvDwN6vqjx" role="link" class="button">Buy Now</a></li>
            </ul>
         </div>
         <div class="columns">
            <ul class="price">
               <li class="header" style="line-height:25px;">Package 2<br> 1/4 Million Brochure Ads / x3 Digital ads</li>
               <li class="grey">2 easy payments of $750 + GST</li>
               <li>Pay $750 deposit NOW to start advertising <br> and $750 balance in 45 days.</li>
               <li><a style="cursor:pointer;" 
                  id="checkout-button-sku_FpWoMwP7xHIIUP" role="link" class="button">Buy Now</a></li>
               <li class="greyli"> <strong>OR</strong></li>
               <li>Pay in full and get an extra 3 months advertising <strong>FREE</strong> <br> Advertising you right through 2021,
                  saving you <strong>$412.50</strong></li>
               <li class="grey">$1500 / year + GST</li>
               <li><a style="cursor:pointer;" 
                  id="checkout-button-sku_FpWnoE2XVhqPAo" role="link" class="button">Buy Now</a></li>
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
      successUrl: 'https://goldcoastdiscounts.com.au/success',
      cancelUrl: 'https://goldcoastdiscounts.com.au/advertise',
      billingAddressCollection: 'required',
    })
    .then(function (result) {
      if (result.error) {
        var displayError = document.getElementById('error-message');
        displayError.textContent = result.error.message;
      }
    });
  });

 var checkoutButton = document.getElementById('checkout-button-sku_FpWnjp4aOiaHmX');
  checkoutButton.addEventListener('click', function () {
    stripe.redirectToCheckout({
      items: [{sku: 'sku_FpWnjp4aOiaHmX', quantity: 1}],
      successUrl: 'https://goldcoastdiscounts.com.au/success',
      cancelUrl: 'https://goldcoastdiscounts.com.au/advertise',
      billingAddressCollection: 'required',
    })
    .then(function (result) {
      if (result.error) {
        var displayError = document.getElementById('error-message');
        displayError.textContent = result.error.message;
      }
    });
  });

  var checkoutButton = document.getElementById('checkout-button-sku_FpWnoE2XVhqPAo');
  checkoutButton.addEventListener('click', function () {
    stripe.redirectToCheckout({
      items: [{sku: 'sku_FpWnoE2XVhqPAo', quantity: 1}],
      successUrl: 'https://goldcoastdiscounts.com.au/success',
      cancelUrl: 'https://goldcoastdiscounts.com.au/advertise',
      billingAddressCollection: 'required',
    })
    .then(function (result) {
      if (result.error) {
        var displayError = document.getElementById('error-message');
        displayError.textContent = result.error.message;
      }
    });
  });

 var checkoutButton = document.getElementById('checkout-button-sku_FpWoMwP7xHIIUP');
  checkoutButton.addEventListener('click', function () {
    stripe.redirectToCheckout({
      items: [{sku: 'sku_FpWoMwP7xHIIUP', quantity: 1}],
      successUrl: 'https://goldcoastdiscounts.com.au/success',
      cancelUrl: 'https://goldcoastdiscounts.com.au/advertise',
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