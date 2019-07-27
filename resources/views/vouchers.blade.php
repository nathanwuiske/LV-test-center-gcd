@extends('layouts.main')
@section('content')
<div style="margin-bottom: 80px"></div>
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
<script src="js/extention/choices.js"></script>
<script>
   const choices = new Choices('[data-trigger]',
   {
     searchEnabled: false
   });
   
</script>
 
 @if(!empty($categoryname))
<h2 style="font-size: 25px;"> Sorting vouchers by "{{$categoryname}}"</h2>
@endif

@if(!empty($searchname))
<h2 style="font-size: 25px;"> Search for "{{$searchname}}"</h2>
@endif

@if(!empty($popularall))
<h2 style="font-size: 25px;">Popular Vouchers</h2>
@endif

@if(!empty($newestall))
<h2 style="font-size: 25px;">Newest Vouchers</h2>
@endif

@if(count($vouchers) <= 0)
 <div class="alert alert-danger text-center">
    <strong>Sorry!</strong> We couldn't find what you were looking for.<br>
    <a class="errorReturn" href="{{route('vouchers')}}">Click here to return to vouchers</a>
 </div>
 @endif
       @if(!empty($vouchers))
       @foreach($vouchers as $voucher) 
       <div class="col-md-4 col-sm-6 col-lg-3 col-xl-3">
            <div class="card alignVoucherCards" >
                  <a href="#voucher{{$voucher->id}}" role="button" data-toggle="modal">
                     <div class="hoverOver" style="background-color: white; border: 1px solid #CCCCCC; text-align: center; ">
                        <br>
                        <img class="card-img-top" class="img-fluid" width="220" height="270" src="{{url('imgs/vouchers/' . $voucher->image)}}" alt='{{$voucher->name}}'>
                        <h2 style="color:#07AD4D; font-size: 20px; margin-bottom: 10px;margin-top: 10px;">{{ str_limit($voucher->name, $limit = 22, $end='...') }}</h2>
                        <button class="btn btn-lg" style="background-color:#07AD4D;  width: 50%; height: 100%; margin-right: 10px;"><i class="fa fa-close"></i>View</button>
                     </a>
                     <form action="/addfavourite" method="get" class="fav-hover" style="float:right; ">
                       
                        <button id="addfavourite" value="{{$voucher->id}}" name="addfavourite"  class="btn btn-lg" style="background-color:#07AD4D; color:white; position: relative; right: 65%;"><i class="fas fa-heart "></i></button>
                        </form>
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
               <div class="modal-body" style="background-color: #F2F2F2">
                  <img id="modal_image_{{$voucher->id}}" src="{{url('imgs/vouchers/' . $voucher->image)}}" class="img-fluid img-center testa" alt='{{$voucher->name}}'>
                  <p style="word-wrap: break-word;"><br><strong>About Deal</strong> <br>{{$voucher->description}}</p>
                  <p><br><strong>Expiry Date</strong> <br>{{$voucher->expiry_date}}</p>
                  <a href="#" style="color: #07AD4D;"><br><i class="fas fa-globe-americas"></i><strong> Visit Website</strong> <br>{{$voucher->website_link}}</a>
                  <button class="btn btn-lg" style="width: 100%; height: 100%; background-color: #07AD4D; color:white;"><i class="fa fa-close"></i>Redeem Voucher on App</button>
               </div>
               <div class="modal-footer" style="background-color: #F2F2F2"> 
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>
       @endforeach
       @endif 
      </div>

</div>
<div class="text-center" style="">
   {{ $vouchers->links() }}
</div>
@stop