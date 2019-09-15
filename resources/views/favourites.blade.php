@extends('layouts.main')
@section('content')
<div style="margin-bottom: 80px"></div>
<!-- Content -->
<div class="container">
   <div class="padding-top-md" >
      <div class="row">
         <div class="col-sm-12">
            <h2 class="text-center">Favourite Vouchers</h2>
         </div>
      </div>
   </div>

@if (session('deleted'))
   <div class="alert alert-success text-center" role="alert">
      {{ session('deleted') }}
   </div>
@endif

@if(count($userFav) == 0)
<a href="{{route('vouchers')}}" class="fav-red"> <p class="text-center" >
<br>You don't have any favourited vouchers. Click here to start!</p></a>
@else
<p class="text-center"> You've saved {{$favCount}} voucher(s) to your favourites</p> 
@endif
@if(!empty($userFav))
   @foreach($userFav as $favouriteVoucher)      
   <div class="col-md-4 col-sm-5 col-lg-3 col-xl-3">
      <div class="card alignVoucherCards">
         <a href="#voucher{{$favouriteVoucher->id}}" role="button" data-toggle="modal">
            <div class="hoverOver voucher-style">
               <br>
               <img class="card-img-top" class="img-fluid" width="220" height="270" src="{{url('imgs/vouchers/' . $favouriteVoucher->image)}}" alt="{{$favouriteVoucher->name}}" onerror="this.onerror=null;this.src='imgs/errors/no-voucher-image.png';">
               <h2 class="voucher-name">{{ str_limit($favouriteVoucher->name, $limit = 15, $end='...') }}</h2>
               <button class="btn btn-lg voucher-view-btn"><i class="fa fa-close"></i>View</button>
         </a>
         <form action="/removefavourite" method="get" class="fav-hover" style="float:right; ">
   
         <button id="removefavourite" value="{{$favouriteVoucher->id}}" name="removefavourite"  class="btn btn-lg " style="background-color:#D9534F; color:white; position: relative; right: 65%;"><i class="fas fa-trash delete-favourite"></i></button>
         <script type="text/javascript">
            $(document).ready(function(){
                 $("form").submit(function() {
                        $(this).submit(function() {
                            return false;
                        });
                        return true;
                    }); 
            }); 
         </script>
      </form>
         <div style="margin-bottom: 20px;"></div>
         </div>
      </div>
   </div>

   <div class="modal fade" id="voucher{{$favouriteVoucher->id}}" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
               <h5 class="modal-title">VOUCHER DETAILS</h5>
                  <button type="button" class="close modal-close-i" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true"><i class="fas fa-times"></i></span>
                  </button>
               </div>
               <div class="modal-body text-center">
                  <img id="modal_image_{{$favouriteVoucher->id}}" src="{{url('imgs/vouchers/' . $favouriteVoucher->image)}}" 
                  @if ($favouriteVoucher->isRedeemed)
                     style="opacity:0.4;"
                  @endif
                  class="img-fluid img-center modal-image" alt='{{$favouriteVoucher->name}}' onerror="this.onerror=null;this.src='imgs/errors/no-voucher-image.png';">
                  <p style="font-size: 18px;">
                     <br><span class="header-modal">About Deal</span>
                     <br>
                  <p style="font-size: 14px;">{!! nl2br(e($favouriteVoucher->description)) !!}</p>
                  </p>
                  @if (!empty($favouriteVoucher->website_link))
                  <a class="web-link" style="color:#4272D7" href="{{$favouriteVoucher->website_link}}" target="_blank">
                  <i class="fas fa-globe-americas"  style="color:#4272D7"></i><strong> Visit Website</strong></a>
                  @endif
                  @if (empty($favouriteVoucher->expiry_date))
                  <p>
                     <br><span class="header-modal">Voucher Expiry</span>
                     <br><i>Expiry information not available for this voucher</i>
                  </p>
                  @else
                  <p>
                     <br><span class="header-modal">Voucher Expiry</span>
                     <br>
                     @if ($favouriteVoucher->expiry_days == 0)
                  <p class="voucher-expire-f">Voucher will expire <strong>today</strong></p>
                  @elseif ($favouriteVoucher->expiry_days == 1)
                  <p class="voucher-expire-f">Voucher will expire <strong>tomorrow</strong></p>
                  @else
                  <p class="voucher-expire-f">Voucher will expire in <strong>{{$favouriteVoucher->expiry_days}}</strong> days</p>
                  @endif
                  </p>
                  @endif 
                  @if(!empty($favouriteVoucher->latitude) && !empty($favouriteVoucher->longitude))
                  <span class="header-modal">Location</span><br><br>
                  <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCC6emn13XOdxMhZAsbaGIgt2HcK3iKAoc&q={{$favouriteVoucher->latitude}},{{$favouriteVoucher->longitude}}" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                  @endif
                  @if ($favouriteVoucher->isRedeemed)
                  <div class="redeem-overlay redeem-overlay-previous">
                     <p class="redeem-overlay-p">You've already redeemed this voucher</p>
                     <p class="text-center">You can redeem again after <strong><span>{{$favouriteVoucher->redeemAvailable}}</span></strong></p>
                  </div>
                  @else
                  <div id="redeem-current-{{$favouriteVoucher->id}}" class="" style="display:none">
                        <p class="header-modal text-center"><span style="color:#07AD4D;"class="fas fa-check-circle check-circle"></span> Voucher Redeemed!</p>
                        <p class="text-center">Voucher redeemed at <strong><span id="redeem-current-time-{{$favouriteVoucher->id}}"></span></strong></p>
                        <p class="text-center" style="margin-bottom:20px;">Voucher next available at <strong><span id="redeem-next-time-{{$favouriteVoucher->id}}"></span></strong></p>
                  </div>
                  @endif     
                  @auth
                  <span class="header-modal"> Redeem voucher... easy as 1,2,3</span>
                  <p style="font-size:15px;">
                  1. Please ensure you are at the business or establishment.<br>
                  2. Present voucher <strong>at point of sale</strong>, and <strong>press [Redeem Voucher]</strong>. <br>
                  3. Business representative will then press <strong>[confirm]</strong>.</p>
                  
                  <a id="redeem-a{{$favouriteVoucher->id}}" href="#warningRedeem{{$favouriteVoucher->id}}" role="button" data-toggle="modal"  @if ($favouriteVoucher->isRedeemed)
                  class="disabled-a"
                  @endif>
                  <button class="btn btn-lg" id="start_redeem_{{$favouriteVoucher->id}}" style="width: 100%; height: 100%; background-color: #07AD4D; color:white;"
                  @if ($favouriteVoucher->isRedeemed)
                  disabled
                  @endif>Redeem Voucher</button></a>
                  @endauth
                  @guest
                  <a href="{{route('login')}}"><p class="text-center"style="color:#A61106;">Must be logged in to redeem vouchers</p></a>
                  <button class="btn btn-lg" style="width: 100%; height: 100%; background-color: #07AD4D; color:white;" disabled>Redeem</button>
                  @endguest
               </div>
               <div class="modal-footer" style="background-color: #F2F2F2">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>
      @component('modals.warning-modal')
      @slot('voucherid')
      {{$favouriteVoucher->id}}
      @endslot
      @slot('userid')
      {{ Auth::user()->id }}
      @endslot
      @slot('voucherimage')
      {{ $favouriteVoucher->image }}
      @endslot
      @endcomponent
   @endforeach
@endif
</div>
</div>
<div class="text-center">
      {{ $userFav->links() }}
</div>
<div class="mb80"></div>
@if(count($userFav) == 0)
<div class="mb450"></div>
@endif
@stop