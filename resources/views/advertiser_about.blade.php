@extends('layouts.main')
@section('content')
<style>
.responsive {
     max-width: 100%;
     height: auto;
}
 .about {
     padding-top:80px;
     padding-bottom:0;
}
 .about .heading h2 {
     font-size: 30px;
     font-weight: 700;
     margin: 0;
     padding: 0;
     color:black;
}
 .about .heading h2 span {
     color: #F24259;
}
 .about .heading p {
     font-size: 15px;
     font-weight: 400;
     line-height: 1.7;
     color: #999999;
     margin: 20px 0 60px;
     padding: 0;
     color:black;
}
 .about h3 {
     font-size: 25px;
     font-weight: 700;
     margin: 0;
     padding: 0;
     color:black;
}
 .about p {
     font-size: 15px;
     font-weight: 400;
     line-height: 1.7;
     color: #999999;
     margin: 20px 0 15px;
     padding: 0;
     color:black;
}
 .about h4 {
     font-size: 25px;
     font-weight: 500;
     color:black;
     margin: 8px 0;
}
 .about h4 i {
     color: #F24259;
     margin-right: 10px;
}
 .align-point{
     position:relative;
     left:50px;
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
     .small-img{
         width:100%;
    }
     .display-no{
         display:none;
    }
     .align-engage{
         left:15px;
    }
     .about h4 {
         font-size: 18px;
         font-weight: 500;
         color:black;
         margin: 8px 0;
    }
}

  </style>

<section class="about" id="about">
        <div class="container">
           <div class="heading text-center">
              <h2>About this project</h2>
              <p class="fontSize17" style="color:black; margin-bottom:10px;"> Australian Business Projects (ABP 117) is a 10 year project study of Gold Coast community, consumer and business.  It is highly successful, it is free for the community and has
                 been responsible for millions of $$$ in turnover for Gold Coast Business.  This is a project that supports local business.  It saves you thousands of dollars on advertising and delivers
                 year-round consumer results.  It is engaged with the largest community and consumer networks on the Gold Coast and it wants to place them in touch with your business.   
              </p>
              <div class="row">
                 <a href="{{route("for_locals")}}"><img src="imgs/about/main/1.png" class="col-md-6 col-sm-12 responsive"></a>
                 <a href="{{route("for_business")}}"><img src="imgs/about/main/2.png" class="col-md-6 col-sm-12 responsive"></a>
              </div>
              <div class="row">
                 <a href="{{route("for_businessnetwork")}}"><img src="imgs/about/main/3.png" class="col-md-6 col-sm-12 responsive"></a>
                 <a href="{{route("for_casestudy")}}"> <img src="imgs/about/main/4.png" class="col-md-6 col-sm-12 responsive"></a>
              </div>
           </div>
      
        </div>
     </section>

<div class="mb50"></div>
@stop