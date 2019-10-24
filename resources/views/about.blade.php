@extends('layouts.main')
@section('content')
<div class="mb100"></div>
<style>
   
   .responsive {
     max-width: 100%;
     height: auto;
}
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

      <div class="container">
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
          


              <img src="imgs/about_other/1.jpg" class="col-md-3 col-sm-12 responsive">
              <img src="imgs/about_other/2.jpg" class="col-md-3 col-sm-12 responsive">
              <img src="imgs/about_other/3.jpg" class="col-md-3 col-sm-12 responsive">
              <img src="imgs/about_other/4.jpg" class="col-md-3 col-sm-12 responsive">

              <img src="imgs/about_other/5.jpg" class="col-md-3 col-sm-12 responsive">
              <img src="imgs/about_other/6.jpg" class="col-md-3 col-sm-12 responsive">
              <img src="imgs/about_other/7.jpg" class="col-md-3 col-sm-12 responsive">
              <img src="imgs/about_other/8.jpg" class="col-md-3 col-sm-12 responsive">

              <img src="imgs/about_other/9.jpg" class="col-md-3 col-sm-12 responsive">
              <img src="imgs/about_other/10.jpg" class="col-md-3 col-sm-12 responsive">
              <img src="imgs/about_other/11.jpg" class="col-md-3 col-sm-12 responsive">
              <img src="imgs/about_other/12.jpg" class="col-md-3 col-sm-12 responsive">

              <img src="imgs/about_other/13.jpg" class="col-md-3 col-sm-12 responsive">
              <img src="imgs/about_other/14.jpg" class="col-md-3 col-sm-12 responsive">
              <img src="imgs/about_other/15.jpg" class="col-md-3 col-sm-12 responsive">
              <img src="imgs/about_other/16.jpg" class="col-md-3 col-sm-12 responsive">

              <img src="imgs/about_other/17.jpg" class="col-md-3 col-sm-12 responsive">
              <img src="imgs/about_other/18.jpg" class="col-md-3 col-sm-12 responsive">
              <img src="imgs/about_other/19.jpg" class="col-md-3 col-sm-12 responsive">
              <img src="imgs/about_other/20.jpg" class="col-md-3 col-sm-12 responsive">

             <div style="position:relative;top:10px">
             <a href="{{route("for_locals")}}"> <img src="imgs/about_other/21.jpg" class="col-md-3 col-sm-12 responsive"> </a>
              <a href="{{route("for_business")}}"> <img src="imgs/about_other/22.jpg" class="col-md-3 col-sm-12 responsive"></a>
              <a href="{{route("for_businessnetwork")}}"> <img src="imgs/about_other/23.jpg" class="col-md-3 col-sm-12 responsive"></a>
              <a href="{{route("for_casestudy")}}"> <img src="imgs/about_other/24.jpg" class="col-md-3 col-sm-12 responsive"></a>
             </div>
      </div>

<div class="mb300"></div>

@stop