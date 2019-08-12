@extends('layouts.main')
@section('content')
<div style="margin-bottom: 80px"></div>
<!-- Content -->
<div class="container">
   <div class="padding-top-md" >
      <div class="row">
         <div class="col-sm-12 border-bottom-sm">
            <h2 class="text-center">Favourite Vouchers</h2>
         </div>
      </div>
   </div>
   @if(!empty($deleted))
  
   <div class="alert alert-success text-center" role="alert">
      <p>Voucher deleted </p>
   </div>
   @endif
   @if(!empty($added))
   <div class="alert alert-success text-center" role="alert">
      <p>Voucher added to favourites </p>
   </div>
   @endif
   @if(!empty($existing))
   <div class="alert alert-danger text-center" role="alert">
      <p>Voucher has been already added to favourites </p>
   </div>
   @endif
   @foreach(Auth::user()->getfavourites as $favouriteVoucher)         
   <div class="col-md-4 col-sm-6 col-lg-3 col-xl-3">
      <div class="card alignVoucherCards" >
         <a href="#voucher{{$favouriteVoucher->id}}" role="button" data-toggle="modal">
            <div class="hoverOver" style="background-color: white; border: 1px solid #CCCCCC; text-align: center; ">
               <br>
               <img class="card-img-top" class="img-fluid" width="220" height="270" src="{{url('imgs/vouchers/' . $favouriteVoucher->image)}}" alt='{{$favouriteVoucher->name}}'>
               <h2 style="color:#07AD4D; font-size: 20px; margin-bottom: 10px;margin-top: 10px;">{{ str_limit($favouriteVoucher->name, $limit = 22, $end='...') }}</h2>
               <button class="btn btn-lg" style="background-color:#07AD4D;  width: 50%; height: 100%; margin-right: 10px;"><i class="fa fa-close"></i>View</button>
         </a>
         <form action="/removefavourite" method="get" class="fav-hover" style="float:right; ">
         <button id="removefavourite" value="{{$favouriteVoucher->id}}" name="removefavourite"  class="btn btn-lg" style="background-color:#D9534F; color:white; position: relative; right: 65%;"><i class="fas fa-trash"></i></button>
         </form>
         <div style="margin-bottom: 20px;"></div>
         </div>
      </div>
   </div>
   <div class="modal fade" id="voucher{{$favouriteVoucher->id}}" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5>VOUCHER DETAILS</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true"><i class="fas fa-times"></i></span>
               </button>
            </div>
            <div class="modal-body">
               <img id="modal_image_{{$favouriteVoucher->id}}" src="{{url('imgs/vouchers/' . $favouriteVoucher->image)}}" class="img-fluid img-center" alt='{{$favouriteVoucher->name}}'>
               <p><br><strong>About Deal</strong><br>{{$favouriteVoucher->description}}</p>
               <p><br><strong>Expiry Date</strong><br>{{$favouriteVoucher->expiry_date}}</p>
               <a href="#"><br><i class="fas fa-globe-americas"></i><strong>Visit Website</strong><br>{{$favouriteVoucher->website_link}}</a>
               <button class="btn btn-lg"><i class="fa fa-close"></i>Redeem Voucher on App</button>
            </div>
            <div class="modal-footer"> 
               <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
   @endforeach
</div>
</div>
<div style="margin-bottom: 350px"></div>
@stop