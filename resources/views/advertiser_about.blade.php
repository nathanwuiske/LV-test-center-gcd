@extends('layouts.main')
@section('content')

<style>
  .about {
    padding: 130px 0;
    padding-top:80px;
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
    font-size: 15px;
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
}

  </style>

<section class="about" id="about">
    <div class="container">
        <div class="heading text-center">
            <h2>About GCD Advertising</h2>
            <p class="fontSize17" style="color:black"> Australian Business Projects (ABP 117) is a 10 year project study of Gold Coast community, consumer and business.  It is highly successful; 
                it is free for the community and <strong>it supports local businesses</strong> by helping them save 
                thousands of dollars on advertising and delivering year round consumer results. It is engaged with the largest community and consumer networks on the Gold Coast and it wants to place them in touch with your business. 
                <br>
                <br>
                <img src="/imgs/about/1.jpg" alt="about" class="img-fluid small-img" width="33%">
                <img src="/imgs/about/2.jpg" alt="about" class="img-fluid small-img display-no" width="33%">
                <img src="/imgs/about/3.jpg" alt="about" class="img-fluid display-no" width="33%">
                <br>
                <br>
                This project has been responsible
               for millions of $$$ in turnover for Gold Coast Business. It is direct contact with the largest 
               customer and consumer networks on the Gold Coast and it powerfully promotes Gold Coast business.
               <br>
             </p>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <img src="/imgs/about/4.jpg" alt="about" class="img-fluid" width="100%">
            </div>
            <div class="col-lg-6">
                <h3 class="text-center phone-down">Engage your business with the Gold Coast</h3>
                <p>The project services a Gold Coast <strong>consumer network of over 500,000</strong> 
                  Locals, Residents, Families, Seniors, AND Visitors to the Coast.</p>
                <div class="row">
                    <div class="col-md-6">
                        <h4><i style="color:#07AD4D;" class="far fa-star"></i>Facebook / GoldCoastDiscounts</h4>
                    </div>
                    <div class="col-md-6">
                        <h4><i style="color:#07AD4D;" class="far fa-star"></i>GCD Android / IOS App</h4>
                    </div>
                    <div class="col-md-6">
                        <h4><i style="color:#07AD4D;" class="far fa-star"></i>FreeMealDeals.com.au</h4>
                    </div>
                    <div class="col-md-6">
                        <h4><i style="color:#07AD4D;" class="far fa-star"></i>GoldCoastDiscounts.com.au</h4>
                    </div>
                    <div class="col-md-6">
                        <h4><i style="color:#07AD4D;" class="far fa-star"></i>Gold Coast Digital Brochures</h4>
                    </div>
                    <div class="col-md-6">
                        <h4><i style="color:#07AD4D;" class="far fa-star"></i>Gold Coast Printed Brochures <span class="align-point">(Letterbox Deliveries)</span></h4>
                    </div>
                </div>
                <p>This is not a project about advertising or discount companies, 
                <strong>this is a project about community, consumer and business engagement.</strong></p>
            </div>
        </div>
    </div>
</section>

<div class="mb50"></div>
@stop