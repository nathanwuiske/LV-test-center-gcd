@extends('layouts.main')
@section('content')
<div style="margin-bottom: 80px"></div>
<!-- Content -->
<div class="container">
   <div class="padding-top-md" >
      <div class="row">
         <div class="col-sm-12 border-bottom-sm">
            <h3 class="text-center">Account Information</h3>
         </div>
      </div>
   </div>
   <div class="panel-body">
      <div class="row">
         <div class="col-xs-12 col-sm-4">
         </div>
         <div class="col-xs-12 col-sm-4 col-md-5">
            <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-user"></i></span>
               <input type="text" class="form-control" placeholder="{{ Auth::user()->first_name }}" disabled>
            </div>
            <div class="input-group padding-top-sm">
               <span class="input-group-addon"><i class="fas fa-envelope"></i></span>
               <input type="text" class="form-control" placeholder="{{ Auth::user()->email}}" disabled>
            </div>
            <div class="input-group padding-top-sm">
               <span class="input-group-addon"><i class="fas fa-phone"></i></span>
               <input type="text" class="form-control" placeholder="{{ Auth::user()->phone_number}}" disabled>
            </div>
         </div>
      </div>
   </div>
   <div class="panel-body text-center">
      <button class="btn btn-lg btn-primary"><i class="fa fa-close"></i>Update</button>
   </div>
</div>
<div style="margin-bottom: 270px"></div>
@stop