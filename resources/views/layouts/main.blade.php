<!DOCTYPE html>
<html lang="en" class="no-js">
   <head>
      <!-- Global site tag (gtag.js) - Google Analytics -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=UA-145592137-1"></script>
      <script>
         window.dataLayer = window.dataLayer || [];
         function gtag(){dataLayer.push(arguments);}
         gtag('js', new Date());
         gtag('config', 'UA-145592137-1');
      </script>
      <title>Gold Coast Discounts</title>
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta charset="utf-8">
      <meta name="description" content="Providing free vouchers to the Gold Coast community">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCC6emn13XOdxMhZAsbbQIgt2HcK3iKJQ1"></script>
      <script src="/js/jquery-1.11.1.min.js"></script>
      <link rel="stylesheet" href="/css/search.min.css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
      <link rel="stylesheet" href="/css/bootstrap.min.css">
      <link rel="stylesheet" href="/css/animate.min.css">
      <link rel="stylesheet" href="/css/main.css">
      <link rel="stylesheet" href="/css/media-queries.min.css">
      <script src="/js/modernizr-2.6.2.min.js"></script>
      <script src="js/main.js"></script>
   </head>

   <body id="body">
      <!-- Navigation -->
      <header id="navigation" class="navbar-fixed-top navbar">
         <div class="container">
            <div class="navbar-header">
               <!-- responsive nav button, for smaller screened devices -->
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
               <span class="sr-only">Toggle navigation</span>
               <i class="fas fa-bars fa-2x"></i>
               </button>
               <!-- Logo -->
               <a class="navbar-brand" href="{{route('home')}}">
                <h1 id="mainLogo">Gold Coast Discounts</h1>
               </a>
            </div>
            <!-- Main navigation -->
            <nav class="collapse navbar-collapse navbar-right" role="navigation" id="topNav">
               <ul id="nav" class="nav navbar-nav display-nav-higher">
                  <li><a href="{{route('home')}}">Home</a></li> 
               
                <li><a href="#"> Digital Medias</a>
                
                     <ul>
                           <li><a href="{{route('vouchers')}}"> Vouchers</a>
                        <li><a href="https://www.facebook.com/GoldCoastDiscounts/" target="_blank">Facebook</a></li>
                                 <li><a href="https://www.instagram.com/goldcoastdiscounts/" target="_blank">Instagram</a></li>
                                          <li><a href="https://twitter.com/CoastDiscounts" target="_blank">Twitter</a></li>
                                            <li><a href="http://freemealdeals.com.au/" target="_blank">Free Meal Deals</a></li>
                                          
                        <li><a class="display-brochure" href="https://docs.google.com/viewer?url=https://goldcoastdiscounts.com.au/Digtal_Brochure.pdf" target="_blank" rel="noopener">Digital Brochures</a></li>
                          <li><a href="https://docs.google.com/viewer?url=https://goldcoastdiscounts.com.au/Spring-Brochure-2019-1st-Edition.pdf"  target="_blank">Letterbox Brochures</a></li>
                        <!--<li><a href="#">GC Digital Brochure</a></li>-->
                        <!-- <li><a href="https://www.freemealdeals.com.au" target="_blank">FreeMealDeals.com.au</a></li>-->
                        <li><a href="https://play.google.com/store/apps/details?id=com.abp.GCD&hl=en"  target="_blank">App - Google Play</a></li>
                        <li><a href="https://apps.apple.com/us/app/gold-coast-discounts/id1481178823?ls=1">App - Apple Store</a></li>
                     </ul>
                  </li>
         <li><a href="https://gcb.wuiske.com/jobs"  target="_blank">GC Jobs</a></li>
                  <li><a href="#">GC Advertising</a>
                     <ul>
                         <li><a href="{{route('advertise')}}">Project Prices</a>
                       <li><a href="{{route('about')}}">About</a></li>
                        <!--<li><a href="#">Media Kit</a></li> -->
                     </ul>
                  </li>
 
                  <li><a href="#">GC Business Network</a>
                     <ul>
                        <li><a href="https://gcb.wuiske.com/" target="_blank">Discounted Network Rates</a>
                       <li><a href="https://gcb.wuiske.com/jobs"  target="_blank">FREE Staff Advertising</a></li>
                        <li><a href="https://gcb.wuiske.com/sales"  target="_blank">GC Business Sales</a></li>
                     </ul>
                  </li>
                  
                  <li><a href="{{route('advertiser_about')}}">About</a>
                     <ul>
                        <li><a href="http://www.australianbusinessprojects.com.au/">Australian Business Projects</a></li> 
                        <li><a href="http://facebook/AustralianBusinessProjects">Facebook/AustralianBusinessProjects</a></li>
                         <li><a href="http://facebook/GoldCoastDiscounts">Facebook/GoldCoastDiscounts</a></li>
                          <li><a href="http://facebook/GCBusinessNetwork">Facebook/GCBusinessNetwork</a></li> 
                           <li><a href="http://facebook/GC Business Sales">Facebook/GC Business Sales</a></li> 
                     </ul>
                  </li>
               
   
                  <li><a href="{{route('contact')}}">Contact</a></li>

            

                  @if (Route::has('login'))
                  @auth
                  <li><a href="#"><i class="fas fa-user"></i> {{ str_limit(Auth::user()->full_name, $limit = 20, $end='...') }} <i class="fas fa-caret-down"></i></a>
               <ul>
                  <li><a href="{{route('account')}}"><i class="fas fa-cog"></i> Account</a></li>
                  <li><a href="{{route('favourites')}}"><i class="fas fa-star"></i> Favourites</a></li>
                  @if (Auth::user()->isAdmin())
                  <li><a href="{{route('adminhome')}}"><i class="fas fa-user-shield"></i> Admin</a></li>
                  @endif
                  @if (Auth::user()->isAdmin())
                  <li><a href="{{route('business_email')}}"><i class="fas fa-envelope"></i> Email</a></li>
                  @endif
                  <li><a href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                     <i class="fas fa-sign-out-alt"></i> Logout
                     </a>
                  </li>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     @csrf
                  </form>
                  @else
                  <li><a href="{{ route('login') }}"><strong>Login / Register</strong></a> </li>
                  @endauth
                  @endif
               </ul>
            </ul>
            </nav>
            <!-- End Main navigation -->

            <nav class="collapse navbar-collapse navbar-right" role="navigation" id="topNav2">
                  <ul id="nav2" class="nav navbar-nav display-nav-phone">
                     <li><a href="{{route('home')}}">Home</a></li> 
                     <li><a href="{{route('vouchers')}}">Vouchers</a></li> 
                     <li><a href="{{route('advertise')}}">Advertising</a></li>
                    
                     <li><a class="display-brochure" href="https://docs.google.com/viewer?url=https://goldcoastdiscounts.com.au/Spring-Brochure-2019-1st-Edition.pdf" rel="noopener">Letterbox Brochures</a></li>
                     <li><a href="https://gcb.wuiske.com/" target="_blank" rel="noopener">GC Business Network</a></li>
                      <li><a href="{{route('about')}}">About</a></li>
                       <li><a href="{{route('contact')}}">Contact</a></li>
                     @if (Route::has('login'))
                     @auth
                     <li><a href="#"><i class="fas fa-user"></i> {{ str_limit(Auth::user()->full_name, $limit = 20, $end='...') }} <i class="fas fa-caret-down"></i></a>
                 
                     <li><a href="{{route('account')}}"><i class="fas fa-cog"></i> Account</a></li>
                     <li><a href="{{route('favourites')}}"><i class="fas fa-star"></i> Favourites</a></li>
                     @if (Auth::user()->isAdmin())
                     <li><a href="{{route('adminhome')}}"><i class="fas fa-user-shield"></i> Admin</a></li>
                     @endif
                     @if (Auth::user()->isAdmin())
                     <li><a href="{{route('business_email')}}"><i class="fas fa-envelope"></i> Email</a></li>
                     @endif
                     <li><a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                     </li>
                     <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                     </form>
                     @else
                     <li><a href="{{ route('login') }}"><strong>Login / Register</strong></a> </li>
                     @endauth
                     @endif
                 
               </ul>
               </nav>

         </div>
      </header>
	  <!--End Navigation -->

	  <!-- Page Content -->
	  @yield('content')
	  <!-- End Page Content -->

	   <!-- Footer -->
      <footer id="footer" class="footer">
         <div class="container">
            <div class="row">
               <div class="col-md-3 col-sm-6 col-xs-12">
                     <div class="footer-single">
                           <h6>Information</h6>
                           <ul>
                              <li><a href="{{route('advertise')}}"> Advertise with Us</a></li>
                              <li><a href="{{route('privacy')}}"> Privacy Policy</a></li>
                              <li><a href="{{route('terms')}}"> Terms and Conditions</a></li>
                           </ul>
                        </div>
               </div>
               <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="footer-single">
                     <h6>Follow Us</h6>
                     <ul>
                        <li><a href="https://www.facebook.com/GoldCoastDiscounts/" rel="noopener" target="_blank"><img src="/imgs/footer/facebook.png" width="20" height="20" alt="Facebook"> Facebook</a></li>
                        <li><a href="https://twitter.com/CoastDiscounts" rel="noopener" target="_blank"><img src="/imgs/footer/twitter.png" width="20" height="20" alt="Twitter"> Twitter</a></li>
                        <li><a href="https://www.instagram.com/goldcoastdiscounts/" rel="noopener" target="_blank"><img src="/imgs/footer/instagram.png" width="20" height="20" alt="Instagram"> Instagram</a></li>
                     </ul>
                  </div>
               </div>
               <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="footer-single">
                     <br><br><p>Gold Coast Discounts provides free vouchers to the Gold Coast community.</p>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <p class="copyright text-center">
                     Copyright © 2019 <a href="https://goldcoastdiscounts.com.au/">GoldCoastDiscounts.com.au </a>- All Rights Reserved.
                  </p>
               </div>
            </div>
         </div>
      </footer>
     <script src="/js/sweetalert2.all.min.js"></script>
     <link rel="stylesheet" href="/css/sweetalert2.min.css">
      <script src="/js/bootstrap.min.js"></script>
      <script src="/js/wow.min.js"></script>
      <script>
         var wow = new WOW ({
         	boxClass:     'wow',      
         	animateClass: 'animated', // animation css class (animated.css)
         	offset:       120,          // distance between the bottom of browser viewport and the top of hidden box (default is 0)
         	mobile:       false,       // turn off animations on mobile
         	live:         true        // constantly check for new WOW elements on the page.
           }
         );
         wow.init();
	  </script> 
   </body>
</html>