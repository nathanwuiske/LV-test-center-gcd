@extends('layouts.main') @section('content')
<!-- Load jssor slider and category select -->
<script src="js/jssor.slider.min.js" type="text/javascript"></script>
<script src="js/slider.js"></script>
<script src="js/extention/choices.js"></script>
<link rel="stylesheet" href="/css/slider.css">

<!-- START jssor1 slider -->
<div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:1300px;height:360px;overflow:hidden;visibility:hidden;">
    <!-- Loading -->
    <div data-u="loading" class="jssorl-009-spin jssor1-load">
        <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="../svg/slider/spin.svg" />
    </div>
    <div data-u="slides" class="jssor1-d-slides">
        <div>
            <img data-u="image" src="1.webp" />
        </div>
        <div>
            <img data-u="image" src="2.webp" />
        </div>
        <div>
            <img data-u="image" src="3.webp" />
        </div>
    </div>
    <!-- Bullet Navigator -->
    <div data-u="navigator" class="jssorb032" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
        <div data-u="prototype" class="i" style="width:16px;height:16px;">
            <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <circle class="b" cx="8000" cy="8000" r="5800"></circle>
            </svg>
        </div>
    </div>
    <!-- Arrow Navigator -->
    <div data-u="arrowleft" class="jssora051" style="width:65px;height:65px;top:0px;left:25px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
        <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
            <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
        </svg>
    </div>
    <div data-u="arrowright" class="jssora051" style="width:65px;height:65px;top:0px;right:25px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
        <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
            <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
        </svg>
    </div>
</div>
<!-- END jssor1 slider -->

<!-- Start search -->
<div class="s131">
    <form action="/search" method="get">
        <div class="inner-form">
            <div class="input-field first-wrap">
                <input id="search" name="search" type="search" placeholder="What are you looking for?" />
            </div>
            <div class="input-field third-wrap">
                <button class="btn-search" type="submit"> <i class="fa fa-search"></i> Search</button>
            </div>
    </form>
    <div class="input-field second-wrap">
        <form method="get" action="/filter">
            <div class="input-select select">
                <select data-trigger="" name="slct" id="slct" onchange="this.form.submit()">
                    <option placeholder="">Categories</option>
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
    </div>
</div>
<!-- End search -->

<!-- Main content -->
<section id="businesses" class="content-background-white">
    <div class="container">
       <div class="row">
          <h2 class="home-header-pop">Businesses</h2>
          <div id="jssor_5" style="position:relative;margin:0 auto;top:35px;width:1050px;height:300px;visibility:hidden;">
             <!-- Loading Screen -->
             <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="../svg/slider/spin.svg" />
             </div>
             <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1050px;height:420px;overflow:hidden;">
                @if(!empty($businesses)) 
                @foreach($businesses as $business)
                <div class="card alignVoucherCards">
                   <a href="#business{{$business->id}}" role="button" data-toggle="modal">
                      <div class="hoverOver" style="background-color: white; text-align: center; ">
                         <img class="card-img-top" class="img-fluid" width="200" height="200" src="{{url('imgs/businesses/' . $business->image)}}" alt='{{$business->name}}'>
                   </a>
                   <div style="margin-bottom: 20px;"></div>
                   </div>
                </div>
                @endforeach 
                @endif
             </div>
             <!-- Arrow Navigator -->
             <div data-u="arrowleft" class="jssora073" style="width:50px;height:50px;top:0px;left:-40px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
                <img src="/imgs/arrows/left.png" height="50px" width="50px">
             </div>
             <div data-u="arrowright" class="jssora073" style="width:50px;height:50px;top:0px;right:-46px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
                <img src="/imgs/arrows/right.png" height="50px" width="50px">
             </div>
          </div>
       </div>
    </div>
 </section>


<section id="popular" class="content-background-grey">
    <div class="container">
    <div class="row">
    <h2 class="home-header-pop" style="float:left;">Popular Vouchers</h2>
    <a href="{{action('VoucherPageController@popular_all')}}">
       <h1 class="view-all">View all </h1>
    </a>
    <div id="jssor_2" class="jssor2-main">
       <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
          <img class="jssor2-img" src="../svg/slider/spin.svg" />
       </div>
       <div data-u="slides" class="jssor2-d-sliders">
          @if(!empty($popular)) 
          @foreach($popular as $voucher)
          <div class="card alignVoucherCards">
             <a href="#voucher{{$voucher->id}}" role="button" data-toggle="modal">
                <div class="hoverOver voucher-style">
                   <br>
                   <img class="card-img-top" class="img-fluid" width="220" height="270" src="{{url('imgs/vouchers/' . $voucher->image)}}" alt='{{$voucher->name}}'>
                   <h2 class="voucher-name">{{ str_limit($voucher->name, $limit = 22, $end='...') }}</h2>
                   <button class="btn btn-lg voucher-view-btn"><i class="fa fa-close"></i>View</button>
             </a>
             <div style="float:right;">
             @auth

            <!-- favourited -->
            <button id="deletefavourite{{$voucher->id}}" 
                     onClick="deleteFromFavourites({{$voucher->id}}, {{ Auth::user()->id }})" 
                     name="addfavourite" 
                     class="btn btn-lg"
                     style="background-color:#07AD4D; color:white; position: relative; right: 65%;color: #ad1707; {{ $voucher->isFavourited ? '' : 'display: none;' }}">
               <i class="fas fa-heart"></i>
            </button>

            <!-- not favourited -->
            <button id="addfavourites{{$voucher->id}}" 
                     onClick="addToFavourites({{$voucher->id}}, {{ Auth::user()->id }})" 
                     name="deletefavourite" 
                     class="btn btn-lg"
                     style="background-color:#07AD4D; color:white; position: relative; right: 65%;{{ $voucher->isFavourited ? 'display: none;' : '' }}">
               <i class="fas fa-heart" ></i>
            </button>

             @endauth
             @guest
             <a href="{{ route('login') }}"> <button class="btn btn-lg" style="background-color:#07AD4D; color:white; position: relative; right: 65%;"><i class="fas fa-heart "></i></button> </a> 
             @endguest
             </div>
             <div style="margin-bottom: 20px;"></div>
             </div>
          </div>
          @endforeach @endif
       </div>
       <!-- Arrow Navigator   -->
       <div data-u="arrowleft" class="jssora073" style="width:50px;height:50px;top:0px;left:-40px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
          <img src="/imgs/arrows/left.png" height="50px" width="50px">
       </div>
       <div data-u="arrowright" class="jssora073" style="width:50px;height:50px;top:0px;right:-40px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
          <img src="/imgs/arrows/right.png" height="50px" width="50px">
       </div>
    </div>
 </section>

<section id="newest" class="content-background-white">
    <div class="container">
    <div class="row">
       <h2 class="home-header-pop" style="float:left;">Newest Vouchers</h2>
       <a href="{{action('VoucherPageController@newest_all')}}">
          <h1 class="view-all">View all </h1>
       </a>
       <div id="jssor_3" style="position:relative;margin:0 auto;margin-bottom:35px;top:35px;width:1050px;height:420px;visibility:hidden;">
          <!-- Loading Screen -->
          <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
             <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="../svg/slider/spin.svg" />
          </div>
          <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1050px;height:420px;overflow:hidden;">
             @if(!empty($latest)) 
             @foreach($latest as $voucher)
             <div class="card alignVoucherCards">
                <a href="#voucher{{$voucher->id}}" role="button" data-toggle="modal">
                   <div class="hoverOver" style="background-color: white; border: 1px solid #CCCCCC; text-align: center; ">
                      <br>
                      <img class="card-img-top" class="img-fluid" width="220" height="270" src="{{url('imgs/vouchers/' . $voucher->image)}}" alt='{{$voucher->name}}'>
                      <h2 style="color:#07AD4D; font-size: 20px; margin-bottom: 10px;margin-top: 10px;">{{ str_limit($voucher->name, $limit = 22, $end='...') }}</h2>
                      <button class="btn btn-lg" style="background-color:#07AD4D;  width: 50%; height: 100%; margin-right: 10px;"><i class="fa fa-close"></i>View</button>
                </a>
                <div style="float:right;">
                @auth
                  <!-- if favourited -->
                  <button id="deletefavourite{{$voucher->id}}" 
                           onClick="deleteFromFavourites({{$voucher->id}}, {{ Auth::user()->id }})" 
                           name="addfavourite" 
                           class="btn btn-lg"
                           style="background-color:#07AD4D; color:white; position: relative; right: 65%;color: #ad1707; {{ $voucher->isFavourited ? '' : 'display: none;' }}">
                     <i class="fas fa-heart"></i>
                  </button>

                  <!-- if not favourited -->
                  <button id="addfavourites{{$voucher->id}}" 
                           onClick="addToFavourites({{$voucher->id}}, {{ Auth::user()->id }})" 
                           name="deletefavourite" 
                           class="btn btn-lg"
                           style="background-color:#07AD4D; color:white; position: relative; right: 65%;{{ $voucher->isFavourited ? 'display: none;' : '' }}">
                     <i class="fas fa-heart" ></i>
                  </button>

                @endauth
                @guest
                <a href="{{ route('login') }}"> <button class="btn btn-lg" style="background-color:#07AD4D; color:white; position: relative; right: 65%;"><i class="fas fa-heart "></i></button> </a> 
                @endguest
                </div>
                <div style="margin-bottom: 20px;"></div>
                </div>
             </div>
             @endforeach @endif
          </div>
          <!-- Arrow Navigator -->
          <div data-u="arrowleft" class="jssora073" style="width:50px;height:50px;top:0px;left:-40px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
             <img src="/imgs/arrows/left.png" height="50px" width="50px">
          </div>
          <div data-u="arrowright" class="jssora073" style="width:50px;height:50px;top:0px;right:-46px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
             <img src="/imgs/arrows/right.png" height="50px" width="50px">
          </div>
       </div>
    </div>
 </section>


<section id="other" class="content-background-grey">
    <div class="container">
       <div class="row">
          <h2 class="home-header-pop" style="float:left;">Other Vouchers</h2>
          <a href="#">
             <h1 class="view-all">View all </h1>
          </a>
          <div id="jssor_4" style="position:relative;margin:0 auto;margin-bottom:35px;top:35px;width:1050px;height:420px;visibility:hidden;">
             <!-- Loading Screen -->
             <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="../svg/slider/spin.svg" />
             </div>
             <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1050px;height:420px;overflow:hidden;">
                @if(!empty($latest)) 
                @foreach($latest as $voucher)
                <div class="card alignVoucherCards">
                   <a href="#voucher{{$voucher->id}}" role="button" data-toggle="modal">
                      <div class="hoverOver" style="background-color: white; border: 1px solid #CCCCCC; text-align: center; ">
                         <br>
                         <img class="card-img-top" class="img-fluid" width="220" height="270" src="{{url('imgs/vouchers/' . $voucher->image)}}" alt='{{$voucher->name}}'>
                         <h2 style="color:#07AD4D; font-size: 20px; margin-bottom: 10px;margin-top: 10px;">{{ str_limit($voucher->name, $limit = 22, $end='...') }}</h2>
                         <button class="btn btn-lg" style="background-color:#07AD4D;  width: 50%; height: 100%; margin-right: 10px;"><i class="fa fa-close"></i>View</button>
                   </a>
                   <div style="float:right;">
                   @auth
                  <!-- if favourited -->
                  <button id="deletefavourite{{$voucher->id}}" 
                        onClick="deleteFromFavourites({{$voucher->id}}, {{ Auth::user()->id }})" 
                        name="addfavourite" 
                        class="btn btn-lg"
                        style="background-color:#07AD4D; color:white; position: relative; right: 65%;color: #ad1707; {{ $voucher->isFavourited ? '' : 'display: none;' }}">
                  <i class="fas fa-heart"></i>
                  </button>

                  <!-- if not favourited -->
                   <button id="addfavourites{{$voucher->id}}" 
                        onClick="addToFavourites({{$voucher->id}}, {{ Auth::user()->id }})" 
                        name="deletefavourite" 
                        class="btn btn-lg"
                        style="background-color:#07AD4D; color:white; position: relative; right: 65%;{{ $voucher->isFavourited ? 'display: none;' : '' }}">
                   <i class="fas fa-heart" ></i>
                  </button>

                   @endauth
                   @guest
                   <a href="{{ route('login') }}"> <button class="btn btn-lg" style="background-color:#07AD4D; color:white; position: relative; right: 65%;"><i class="fas fa-heart "></i></button> </a> 
                   @endguest
                   </div>
                   <div style="margin-bottom: 20px;"></div>
                   </div>
                </div>
                @endforeach 
                @endif
             </div>
             <!-- Arrow Navigator -->
             <div data-u="arrowleft" class="jssora073" style="width:50px;height:50px;top:0px;left:-40px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
                <img src="/imgs/arrows/left.png" height="50px" width="50px">
             </div>
             <div data-u="arrowright" class="jssora073" style="width:50px;height:50px;top:0px;right:-46px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
                <img src="/imgs/arrows/right.png" height="50px" width="50px">
             </div>
          </div>
       </div>
    </div>
 </section>
@if(!empty($vouchers)) 
@foreach($vouchers as $voucher)
<div class="modal fade" id="voucher{{$voucher->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header" style="background-color:#07AD4D;">
             <h5 class="modal-title" style="color: white; font-size: 15px;">VOUCHER DETAILS</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 0.9; color: white; position:absolute;right: 2%;top: 2%;">
             <span aria-hidden="true"><i class="fas fa-times"></i></span>
             </button>
          </div>
          <div class="modal-body" style="background-color: #F2F2F2">
             <img id="modal_image_{{$voucher->id}}" src="{{url('imgs/vouchers/' . $voucher->image)}}" class="img-fluid img-center modal-image" alt='{{$voucher->name}}'>
             <p style="word-wrap: break-word;">
                <br><strong class="header-modal">About Deal</strong>
                <br>
                {!! nl2br(e($voucher->description)) !!}
             </p>
             @if (!empty($voucher->website_link))
             <a href="{{$voucher->website_link}}" target="_blank">
             <i class="fas fa-globe-americas"></i><strong> Visit Website</strong></a>
             @endif
             @if (empty($voucher->expiry_date))
             <p>
                <br><strong class="header-modal">Expiry Date</strong>
                <br><i>Expiry date not available</i>
             </p>
             @else
             <p>
                <br><strong class="header-modal">Expiry Date</strong>
                <br>{{\Carbon\Carbon::parse($voucher->expiry_date)->format('d/m/Y')}}
             </p>
             @endif 
             @if(!empty($voucher->latitude) && !empty($voucher->longitude))
             <strong class="header-modal">Location</strong><br><br>
             <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCC6emn13XOdxMhZAsbaGIgt2HcK3iKAoc&q={{$voucher->latitude}},{{$voucher->longitude}}" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
             @endif
             @if ($voucher->isRedeemed)
             <div class="redeem-overlay redeem-overlay-previous">
                <p style="text-align:center;color:#A61106;">Voucher Already Redeemed</p>
                <p class="text-center">Voucher available again after <strong><span>{{$voucher->redeemAvailable}}</span></strong></p>
             </div>
             @else
             <div id="redeem-current-{{$voucher->id}}" class="redeem-overlay redeem-overlay-current" style="display:none">
                <p class="header-modal text-center"><span style="color:#07AD4D;"class="fas fa-check-circle check-circle"></span> Voucher Redeemed!</p>
                <p class="text-center">Voucher redeemed at <strong><span id="redeem-current-time-{{$voucher->id}}"></span></strong></p>
                <p class="text-center" style="margin-bottom:0px;">Voucher next available at <strong><span id="redeem-next-time-{{$voucher->id}}"></span></strong></p>
             </div>
             @endif     
             @auth
             <p class="text-center"><span id="time{{$voucher->id}}" style="color:#A61106; font-size:18px;"></span><br></p>
             <a id="redeem-a{{$voucher->id}}" href="#warningRedeem{{$voucher->id}}" role="button" data-toggle="modal"  @if ($voucher->isRedeemed)
                  class="disabled-a"
                  @endif>
             <button class="btn btn-lg" id="start_redeem_{{$voucher->id}}" style="width: 100%; height: 100%; background-color: #07AD4D; color:white;"
                  @if ($voucher->isRedeemed)
                  disabled
                  @endif>Redeem</button></a>
             @endauth
             @guest
             <p class="text-center"style="color:#A61106;">Must be logged in to redeem vouchers</p>
             <button class="btn btn-lg" style="width: 100%; height: 100%; background-color: #07AD4D; color:white;" disabled>Redeem</button>
             @endguest
          </div>
          <div class="modal-footer" style="background-color: #F2F2F2">
             <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
       </div>
    </div>
 </div>

 @auth
 <div class="modal fade" id="warningRedeem{{$voucher->id}}" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header" style="background-color:#07AD4D;">
               <h5 class="modal-title" style="color: white; font-size: 15px;">Voucher Redemption</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 0.9; color: white; position:absolute;right: 2%;top: 2%;">
               <span aria-hidden="true"><i class="fas fa-times"></i></span>
               </button>
            </div>
            <div class="modal-body" style="background-color: #F2F2F2">
               Please ensure you are at the establishment before redeeming the voucher.<br>
               Once redeemed, you will have 5:00 min to present the voucher at the counter before the voucher is disabled.<br><br>
            </div>
            <div class="modal-footer" style="background-color: #F2F2F2">
               <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
               <button type="button" class="btn btn-success" onClick="startRedeem({{$voucher->id}}, {{ Auth::user()->id }})" data-dismiss="modal">Redeem</button>
            </div>
         </div>
      </div>
   </div>
   @endauth
@endforeach @endif

</div>
</div>
</div>
<script>
    const choices = new Choices('[data-trigger]', {
        searchEnabled: false
    });
</script>
<script type="text/javascript">
/* Initalize jssor sliders */
    jssor_1_slider_init();
    jssor_2_slider_init();
    jssor_3_slider_init();
    jssor_4_slider_init();
    jssor_5_slider_init();
</script>

@stop