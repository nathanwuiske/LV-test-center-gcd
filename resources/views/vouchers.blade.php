@extends('layouts.main')
@section('content')
<div class="mb80"></div>
<h2 style="text-align:center;font-size: 25px;color:#07AD4D; font-weight: bold;">Browse Vouchers</h2>
<!-- Content -->
<div class="container">
      <div class="row">
    <!-- Start search -->
<div class="s131" style="border:none;">
   <form action="/search" method="get">
      <div class="inner-form">
         <div class="input-field first-wrap">
            <input id="search" name="search" type="search" placeholder="Search through our vouchers" />
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
<script src="js/choices.min.js"></script>
<script>
   const choices = new Choices('[data-trigger]',
   {
     searchEnabled: false
   });
   
</script>
 
 @if(!empty($categoryname))
<h2 style="font-size: 25px; text-align:center;"> Sorting vouchers by {{$categoryname}}</h2>
@endif

@if(!empty($searchname))
<h2 style="font-size: 25px; text-align:center;"> Search for "{{$searchname}}"</h2>
@endif

@if(!empty($popularall))
<h2 style="font-size: 25px;text-align:center;">Showing Popular Vouchers</h2>
@endif

@if(!empty($newestall))
<h2 style="font-size: 25px;text-align:center;">Showing Newest Vouchers</h2>
@endif

@if(!empty($expiryall))
<h2 style="font-size: 25px;text-align:center;">Sorting Vouchers by Expiry Date</h2>
@endif

@if(count($vouchers) <= 0)
 <div class="alert alert-danger text-center">
    <strong>Sorry!</strong> We couldn't find what you were looking for.<br>
    <a class="errorReturn" href="{{route('vouchers')}}">Click here to return to vouchers</a>
 </div>
 <div class="mb350"></div>
 @endif
       @if(!empty($vouchers))
       @foreach($vouchers as $voucher) 
       <div class="col-md-4 col-sm-6 col-lg-3 col-xl-3">
            <div class="card alignVoucherCards" >
                  @if(!empty($voucher->latitude) && !empty($voucher->longitude))
                     <a href="#" onClick="showModalAndLoadMap({{$voucher->id}}, {{$voucher->latitude}}, {{$voucher->longitude}})" role="button" data-toggle="modal">
                  @else
                        <a href="#voucher{{$voucher->id}}" role="button" data-toggle="modal">
                  @endif
                     <div class="hoverOver" style="background-color: white; border: 1px solid #CCCCCC; text-align: center; ">
                        <br>
                        <img class="card-img-top" class="img-fluid" width="220" height="270" src="{{url('imgs/vouchers/' . $voucher->image)}}" alt="{{$voucher->name}}" onerror="this.onerror=null;this.src='imgs/errors/no-voucher-image.png';">
                        <h2 style="color:#07AD4D; font-size: 20px; margin-bottom: 10px;margin-top: 10px;">{{ str_limit($voucher->name, $limit = 15, $end='...') }}</h2>
                        <button class="btn btn-lg" style="background-color:#07AD4D;  width: 50%; height: 100%; margin-right: 10px;"><i class="fa fa-close"></i>View</button>
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
       </div>
       <div class="modal fade" id="voucher{{$voucher->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
           <div class="modal-content">
              <div class="modal-header" style="background-color:#07AD4D;">
                 <h5 class="modal-title" style="color: white; font-size: 15px;">VOUCHER DETAILS</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 0.9; color: white; position:absolute;right: 2%;top: 2%;">
                 <span aria-hidden="true"><i class="fas fa-times"></i></span>
                 </button>
              </div>
              <div class="modal-body  text-center" style="background-color: #F2F2F2">
               <img id="modal_image_{{$voucher->id}}" src="{{url('imgs/vouchers/' . $voucher->image)}}" 
               @if ($voucher->isRedeemed)
               style="opacity:0.4;"
               @endif
               class="img-fluid img-center modal-image" alt="{{$voucher->name}}" onerror="this.onerror=null;this.src='imgs/errors/no-voucher-image.png';">
               <p style="word-wrap: break-word; font-size: 18px;">
                  <br><span class="header-modal">About Deal</span>
                  <br>
                 <p style="font-size: 14px;">{!! nl2br(e($voucher->description)) !!}</p>
               </p>
               @if (!empty($voucher->website_link))
               <a class="web-link" style="color:#4272D7" href="{{$voucher->website_link}}" target="_blank">
               <i class="fas fa-globe-americas"  style="color:#4272D7"></i><strong> Visit Website</strong></a>
               @endif
               @if (empty($voucher->expiry_date))
               <p>
                  <br><span class="header-modal">Voucher Expiry</span>
                  <br><i>Expiry information not available for this voucher</i>
               </p>
               @else
               <p>
                  <br><span class="header-modal">Voucher Expiry</span>
                  <br>
                   @if ($voucher->expiry_days == 0)
                   <p style="font-size: 14px;">Voucher will expire <strong>today</strong></p>
                   @elseif ($voucher->expiry_days == 1)
                   <p style="font-size: 14px;">Voucher will expire <strong>tomorrow</strong></p>
                   @else
                   <p style="font-size: 14px;">Voucher will expire in <strong>{{$voucher->expiry_days}}</strong> days</p>
                   @endif
               </p>
               @endif 
               @if(!empty($voucher->latitude) && !empty($voucher->longitude))
               <span class="header-modal">Location</span><br><br>
               <iframe id="mapsid{{$voucher->id}}" src="" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
               @endif
               @if ($voucher->isRedeemed)
               <div class="redeem-overlay redeem-overlay-previous">
                  <p class="redeem-overlay-p">You've already redeemed this voucher</p>
                  <p class="text-center">You can redeem again after <strong><span>{{$voucher->redeemAvailable}}</span></strong></p>
               </div>
                 @else
                 <div id="redeem-current-{{$voucher->id}}" style="display:none">
                  <div class="redeem-overlay">
                     <p class="redeem-overlay-p" style="color:#07AD4D">Voucher Redeemed!</p>
                     <p class="text-center">Voucher redeemed at <strong><span id="redeem-current-time-{{$voucher->id}}"></span></strong></p>
                     <p class="text-center" style="margin-bottom:20px;">Voucher next available at <strong><span id="redeem-next-time-{{$voucher->id}}"></span></strong></p>
                  </div>
                  <p class="header-modal text-center"><span style="color:#07AD4D;"class="fas fa-check-circle check-circle"></span> Voucher Redeemed!</p>
               </div>
                 @endif
                 @auth
                 <span class="header-modal"> Redeem voucher... easy as 1,2,3</span>
                 <p style="font-size:15px;">
                 1. Please ensure you are at the business or establishment.<br>
                 2. Present voucher <strong>at point of sale</strong>, and <strong>press [Redeem Voucher]</strong>. <br>
                 3. Business representative will then press <strong>[confirm]</strong>.</p>
                 @endauth
              </div>
              <div class="modal-footer" style="background-color: #F2F2F2">
               @guest
               <a href="{{route('login')}}"><p class="text-center"style="color:#A61106;">You need to be logged in to redeem vouchers.</p></a>
               <button class="btn btn-lg" style="float:left; background-color: #07AD4D; color:white;" disabled>Redeem</button>
               @endguest
               @auth
               <a id="redeem-a{{$voucher->id}}" href="#warningRedeem{{$voucher->id}}" role="button" data-toggle="modal" 
               @if ($voucher->isRedeemed)
               class="disabled-a"
               @endif>
               <button class="btn btn-lg" id="start_redeem_{{$voucher->id}}" style="float:left;background-color: #07AD4D; color:white;"
               @if ($voucher->isRedeemed)
               disabled
               @endif>Redeem Voucher</button></a>
               @endauth
               <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">Close</button>
              </div>
           </div>
        </div>
     </div>
     @auth
     @component('modals.warning-modal')
     @slot('voucherid')
     {{$voucher->id}}
     @endslot
     @slot('userid')
     {{ Auth::user()->id }}
     @endslot
     @slot('voucherimage')
     {{ $voucher->image }}
     @endslot
     @endcomponent
         @endauth
       @endforeach
       @endif 
      </div>

</div>
<div class="text-center">
   {{ $vouchers->links() }}
</div>

<script>
      function showModalAndLoadMap(voucherid, voucher_latitude, voucher_longitude) {
         if(voucher_latitude && voucher_longitude){
         $('#voucher'+voucherid).modal('show');
         $('#mapsid'+voucherid).attr('src', 
         "https://www.google.com/maps/embed/v1/place?key=AIzaSyCC6emn13XOdxMhZAsbaGIgt2HcK3iKAoc&q=" + voucher_latitude + "," + voucher_longitude);
         }
      }
      </script>
@stop