<!DOCTYPE html>
<html lang="en" class="no-js">
   <head>
     <title>Gold Coast Discounts</title>
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta charset="utf-8">
      <meta name="description" content="Providing free vouchers to the Gold Coast community">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCC6emn13XOdxMhZAsbaGIgt2HcK3iKAoc"></script>

      <!-- jquery core -->
      <script src="/js/jquery-1.11.1.min.js"></script>
      <!--Search bar -->
     <link rel="stylesheet" href="/css/search.css">
	   <!-- Fontawesome Icon -->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
      <!-- Twitter Bootstrap css -->
      <link rel="stylesheet" href="/css/bootstrap.min.css">
      <!-- CSS animations -->
      <link rel="stylesheet" href="/css/animate.css">
      <!-- Main Stylesheet -->
      <link rel="stylesheet" href="/css/main.css">
      <!-- Media-queries for other devices -->
      <link rel="stylesheet" href="/css/media-queries.css">
      <!-- Modernizer Script for old Browsers -->
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
            <nav class="collapse navbar-collapse navbar-right" role="navigation">
               <ul id="nav" class="nav navbar-nav">
                  <li><a href="{{route('home')}}">Home</a></li> 
                  <li><a href="{{route('vouchers')}}">Vouchers</a></li> 
                  <li><a href="{{route('advertise')}}">Advertise With Us</a></li>
                  <li><a href="{{route('contact')}}">Contact Us</a></li>
                  <li><a href="https://goldcoastdiscounts.com.au/LatestBrochure.pdf" target="_blank">Latest Brochure</a></li>
                  <li><a href="http://gcbusinessnetwork.com.au/" target="_blank">Business Network</a></li>
                  
                  @if (Route::has('login'))
                  @auth
                  <li><a href="#"><i class="fas fa-user"></i> {{ str_limit(Auth::user()->first_name, $limit = 20, $end='...') }} <i class="fas fa-caret-down"></i></a>
                  <ul>
                  <li><a href="{{route('account')}}"><i class="fas fa-cog"></i> Settings</a></li>
                  <li><a href="{{route('favourites')}}"><i class="fas fa-star"></i> Favourites</a></li>
                  <li><a href="{{route('adminhome')}}"><i class="fas fa-user-shield"></i> Admin</a></li>
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
            </nav>
            <!-- End Main navigation -->
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
                        <li><a href="https://www.facebook.com/GoldCoastDiscounts/"><img src="/imgs/face.png" width="20" height="20"> Facebook</a></li>
                        <li><a href="https://twitter.com/DiscountsGold"><img src="/imgs/twitter.png" width="20" height="20"> Twitter</a></li>
                        <li><a href="https://www.instagram.com/gold_coast_discounts/"><img src="/imgs/instagram.png" width="20" height="20"> Instagram</a></li>
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
	
	  <!-- Scripts -->
	  
     <script src="/js/sweetalert2.all.min.js"></script>
     <link rel="stylesheet" href="/css/sweetalert2.min.css">
      <!-- Bootstrap -->
      <script src="/js/bootstrap.min.js"></script>
      <!-- jssor slider -->
      <script src="/js/jssor.slider.min.js"></script>

      <!-- WOW animations -->
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