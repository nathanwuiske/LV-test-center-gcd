@extends('layouts.main') @section('content')

<!-- Load jssor slider -->
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
           <div id="jssor_5" style="position:relative;margin:0 auto;top:0px;left:0px;width:1050px;height:300px;overflow:hidden;visibility:hidden;top:50px">
               <!-- Loading Screen -->
               <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                   <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="../svg/slider/spin.svg" />
               </div>
               <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1050px;height:420px;overflow:hidden;">
                   @if(!empty($businesses)) @foreach($businesses as $business)
                   <div class="card alignVoucherCards">
                       <a href="#business{{$business->id}}" role="button" data-toggle="modal">
                           <div class="hoverOver" style="background-color: white; text-align: center; ">
                               <img class="card-img-top" class="img-fluid" width="200" height="200" src="{{url('imgs/businesses/' . $business->image)}}" alt='{{$business->name}}'>
                       </a>
                       <div style="margin-bottom: 20px;"></div>
                       </div>
                   </div>
                   @endforeach @endif
               </div>

               <!-- Arrow Navigator -->
               <div data-u="arrowleft" class="jssora073" style="width:50px;height:50px;top:0px;left:0px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
                   <svg viewBox="0 0 16000 16000" style="position:absolute;top:-55px;left:0;width:100%;height:100%;">
                       <path class="a" d="M4037.7,8357.3l5891.8,5891.8c100.6,100.6,219.7,150.9,357.3,150.9s256.7-50.3,357.3-150.9 l1318.1-1318.1c100.6-100.6,150.9-219.7,150.9-357.3c0-137.6-50.3-256.7-150.9-357.3L7745.9,8000l4216.4-4216.4 c100.6-100.6,150.9-219.7,150.9-357.3c0-137.6-50.3-256.7-150.9-357.3l-1318.1-1318.1c-100.6-100.6-219.7-150.9-357.3-150.9 s-256.7,50.3-357.3,150.9L4037.7,7642.7c-100.6,100.6-150.9,219.7-150.9,357.3C3886.8,8137.6,3937.1,8256.7,4037.7,8357.3 L4037.7,8357.3z"></path>
                   </svg>
               </div>
               <div data-u="arrowright" class="jssora073" style="width:50px;height:50px;top:0px;right:0px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
                   <svg viewBox="0 0 16000 16000" style="position:absolute;top:-55px;left:0;width:100%;height:100%;">
                       <path class="a" d="M11962.3,8357.3l-5891.8,5891.8c-100.6,100.6-219.7,150.9-357.3,150.9s-256.7-50.3-357.3-150.9 L4037.7,12931c-100.6-100.6-150.9-219.7-150.9-357.3c0-137.6,50.3-256.7,150.9-357.3L8254.1,8000L4037.7,3783.6 c-100.6-100.6-150.9-219.7-150.9-357.3c0-137.6,50.3-256.7,150.9-357.3l1318.1-1318.1c100.6-100.6,219.7-150.9,357.3-150.9 s256.7,50.3,357.3,150.9l5891.8,5891.8c100.6,100.6,150.9,219.7,150.9,357.3C12113.2,8137.6,12062.9,8256.7,11962.3,8357.3 L11962.3,8357.3z"></path>
                   </svg>
               </div>
           </div>
       </div>
   </div>
</section>


<section id="popular" class="content-background-grey">
    <div class="container">
        <div class="row">
            <!--
         <i style="position:relative; top: 280px; cursor:pointer; right: 2%;" class="fas fa-chevron-left fa-4x" onclick="OnArrowRightClick();" ></i>
         <i style="position:relative; left: 96.8%; top: 280px; cursor:pointer;" class="fas fa-chevron-right fa-4x" onclick="OnArrowLeftClick();"></i>
         -->
            <h2 class="home-header-pop" style="float:left;">Popular Vouchers</h2>
            <a href="{{action('VoucherPageController@popular_all')}}"><h1 class="view-all">View all </h1></a>
            <div id="jssor_2" class="jssor2-main">
                <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                    <img class="jssor2-img" src="../svg/slider/spin.svg" />
                </div>
                <div data-u="slides" class="jssor2-d-sliders">
                    @if(!empty($popular)) @foreach($popular as $voucher)
                    <div class="card alignVoucherCards">
                        <a href="#voucher{{$voucher->id}}" role="button" data-toggle="modal">
                            <div class="hoverOver voucher-style">
                                <br>
                                <img class="card-img-top" class="img-fluid" width="220" height="270" src="{{url('imgs/vouchers/' . $voucher->image)}}" alt='{{$voucher->name}}'>
                                <h2 class="voucher-name">{{ str_limit($voucher->name, $limit = 22, $end='...') }}</h2>
                                <button class="btn btn-lg voucher-view-btn"><i class="fa fa-close"></i>View</button>
                        </a>
                        <form action="/addfavourite" method="get" class="fav-hover" style="float:right; ">
                            <button id="addfavourite" value="{{$voucher->id}}" name="addfavourite" class="btn btn-lg" style="background-color:#07AD4D; color:white; position: relative; right: 65%;"><i class="fas fa-heart "></i></button>
                        </form>
                        <div style="margin-bottom: 20px;"></div>
                        </div>
                    </div>
                    @endforeach @endif
                </div>
                <!-- Arrow Navigator   -->
                <div data-u="arrowleft" class="jssora073" style="width:50px;height:50px;top:0px;left:0px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
                    <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                        <path class="a" d="M4037.7,8357.3l5891.8,5891.8c100.6,100.6,219.7,150.9,357.3,150.9s256.7-50.3,357.3-150.9 l1318.1-1318.1c100.6-100.6,150.9-219.7,150.9-357.3c0-137.6-50.3-256.7-150.9-357.3L7745.9,8000l4216.4-4216.4 c100.6-100.6,150.9-219.7,150.9-357.3c0-137.6-50.3-256.7-150.9-357.3l-1318.1-1318.1c-100.6-100.6-219.7-150.9-357.3-150.9 s-256.7,50.3-357.3,150.9L4037.7,7642.7c-100.6,100.6-150.9,219.7-150.9,357.3C3886.8,8137.6,3937.1,8256.7,4037.7,8357.3 L4037.7,8357.3z"></path>
                    </svg>
                </div>
                <div data-u="arrowright" class="jssora073" style="width:50px;height:50px;top:0px;right:0px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
                    <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                        <path class="a" d="M11962.3,8357.3l-5891.8,5891.8c-100.6,100.6-219.7,150.9-357.3,150.9s-256.7-50.3-357.3-150.9 L4037.7,12931c-100.6-100.6-150.9-219.7-150.9-357.3c0-137.6,50.3-256.7,150.9-357.3L8254.1,8000L4037.7,3783.6 c-100.6-100.6-150.9-219.7-150.9-357.3c0-137.6,50.3-256.7,150.9-357.3l1318.1-1318.1c100.6-100.6,219.7-150.9,357.3-150.9 s256.7,50.3,357.3,150.9l5891.8,5891.8c100.6,100.6,150.9,219.7,150.9,357.3C12113.2,8137.6,12062.9,8256.7,11962.3,8357.3 L11962.3,8357.3z"></path>
                    </svg>
                </div>
            </div>
</section>

<section id="newest" class="content-background-grey">
    <div class="container">
        <div class="row">
            <h2 class="home-header-pop" style="float:left;">Newest Vouchers</h2>
            <a href="{{action('VoucherPageController@newest_all')}}"><h1 class="view-all">View all </h1></a>
            <div id="jssor_3" style="position:relative;margin:0 auto;top:0px;left:0px;width:1050px;height:420px;overflow:hidden;visibility:hidden;">
                <!-- Loading Screen -->
                <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                    <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="../svg/slider/spin.svg" />
                </div>
                <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1050px;height:420px;overflow:hidden;">
                    @if(!empty($latest)) @foreach($latest as $voucher)
                    <div class="card alignVoucherCards">
                        <a href="#voucher{{$voucher->id}}" role="button" data-toggle="modal">
                            <div class="hoverOver" style="background-color: white; border: 1px solid #CCCCCC; text-align: center; ">
                                <br>
                                <img class="card-img-top" class="img-fluid" width="220" height="270" src="{{url('imgs/vouchers/' . $voucher->image)}}" alt='{{$voucher->name}}'>
                                <h2 style="color:#07AD4D; font-size: 20px; margin-bottom: 10px;margin-top: 10px;">{{ str_limit($voucher->name, $limit = 22, $end='...') }}</h2>
                                <button class="btn btn-lg" style="background-color:#07AD4D;  width: 50%; height: 100%; margin-right: 10px;"><i class="fa fa-close"></i>View</button>
                        </a>
                        <form action="/addfavourite" method="get" class="fav-hover" style="float:right; ">
                            <button id="addfavourite" value="{{$voucher->id}}" name="addfavourite" class="btn btn-lg" style="background-color:#07AD4D; color:white; position: relative; right: 65%;"><i class="fas fa-heart "></i></button>
                        </form>
                        <div style="margin-bottom: 20px;"></div>
                        </div>
                    </div>
                    @endforeach @endif
                </div>
                <!-- Arrow Navigator -->
                <div data-u="arrowleft" class="jssora073" style="width:50px;height:50px;top:0px;left:0px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
                    <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                        <path class="a" d="M4037.7,8357.3l5891.8,5891.8c100.6,100.6,219.7,150.9,357.3,150.9s256.7-50.3,357.3-150.9 l1318.1-1318.1c100.6-100.6,150.9-219.7,150.9-357.3c0-137.6-50.3-256.7-150.9-357.3L7745.9,8000l4216.4-4216.4 c100.6-100.6,150.9-219.7,150.9-357.3c0-137.6-50.3-256.7-150.9-357.3l-1318.1-1318.1c-100.6-100.6-219.7-150.9-357.3-150.9 s-256.7,50.3-357.3,150.9L4037.7,7642.7c-100.6,100.6-150.9,219.7-150.9,357.3C3886.8,8137.6,3937.1,8256.7,4037.7,8357.3 L4037.7,8357.3z"></path>
                    </svg>
                </div>
                <div data-u="arrowright" class="jssora073" style="width:50px;height:50px;top:0px;right:0px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
                    <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                        <path class="a" d="M11962.3,8357.3l-5891.8,5891.8c-100.6,100.6-219.7,150.9-357.3,150.9s-256.7-50.3-357.3-150.9 L4037.7,12931c-100.6-100.6-150.9-219.7-150.9-357.3c0-137.6,50.3-256.7,150.9-357.3L8254.1,8000L4037.7,3783.6 c-100.6-100.6-150.9-219.7-150.9-357.3c0-137.6,50.3-256.7,150.9-357.3l1318.1-1318.1c100.6-100.6,219.7-150.9,357.3-150.9 s256.7,50.3,357.3,150.9l5891.8,5891.8c100.6,100.6,150.9,219.7,150.9,357.3C12113.2,8137.6,12062.9,8256.7,11962.3,8357.3 L11962.3,8357.3z"></path>
                    </svg>
                </div>
            </div>
        </div>
</section>


<section id="other" class="content-background-white">
    <div class="container">
        <div class="row">
            <h2 class="home-header-pop" style="float:left;">Other Vouchers</h2>
            <a href="#"><h1 class="view-all">View all </h1></a>
            <div id="jssor_4" style="position:relative;margin:0 auto;top:0px;left:0px;width:1050px;height:420px;overflow:hidden;visibility:hidden;">
                <!-- Loading Screen -->
                <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                    <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="../svg/slider/spin.svg" />
                </div>
                <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1050px;height:420px;overflow:hidden;">
                    @if(!empty($latest)) @foreach($latest as $voucher)
                    <div class="card alignVoucherCards">
                        <a href="#voucher{{$voucher->id}}" role="button" data-toggle="modal">
                            <div class="hoverOver" style="background-color: white; border: 1px solid #CCCCCC; text-align: center; ">
                                <br>
                                <img class="card-img-top" class="img-fluid" width="220" height="270" src="{{url('imgs/vouchers/' . $voucher->image)}}" alt='{{$voucher->name}}'>
                                <h2 style="color:#07AD4D; font-size: 20px; margin-bottom: 10px;margin-top: 10px;">{{ str_limit($voucher->name, $limit = 22, $end='...') }}</h2>
                                <button class="btn btn-lg" style="background-color:#07AD4D;  width: 50%; height: 100%; margin-right: 10px;"><i class="fa fa-close"></i>View</button>
                        </a>
                        <form action="/addfavourite" method="get" class="fav-hover" style="float:right; ">
                            <button id="addfavourite" value="{{$voucher->id}}" name="addfavourite" class="btn btn-lg" style="background-color:#07AD4D; color:white; position: relative; right: 65%;"><i class="fas fa-heart "></i></button>
                        </form>
                        <div style="margin-bottom: 20px;"></div>
                        </div>
                    </div>
                    @endforeach @endif
                </div>
                <!-- Arrow Navigator -->
                <div data-u="arrowleft" class="jssora073" style="width:50px;height:50px;top:0px;left:0px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
                    <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                        <path class="a" d="M4037.7,8357.3l5891.8,5891.8c100.6,100.6,219.7,150.9,357.3,150.9s256.7-50.3,357.3-150.9 l1318.1-1318.1c100.6-100.6,150.9-219.7,150.9-357.3c0-137.6-50.3-256.7-150.9-357.3L7745.9,8000l4216.4-4216.4 c100.6-100.6,150.9-219.7,150.9-357.3c0-137.6-50.3-256.7-150.9-357.3l-1318.1-1318.1c-100.6-100.6-219.7-150.9-357.3-150.9 s-256.7,50.3-357.3,150.9L4037.7,7642.7c-100.6,100.6-150.9,219.7-150.9,357.3C3886.8,8137.6,3937.1,8256.7,4037.7,8357.3 L4037.7,8357.3z"></path>
                    </svg>
                </div>
                <div data-u="arrowright" class="jssora073" style="width:50px;height:50px;top:0px;right:0px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
                    <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                        <path class="a" d="M11962.3,8357.3l-5891.8,5891.8c-100.6,100.6-219.7,150.9-357.3,150.9s-256.7-50.3-357.3-150.9 L4037.7,12931c-100.6-100.6-150.9-219.7-150.9-357.3c0-137.6,50.3-256.7,150.9-357.3L8254.1,8000L4037.7,3783.6 c-100.6-100.6-150.9-219.7-150.9-357.3c0-137.6,50.3-256.7,150.9-357.3l1318.1-1318.1c100.6-100.6,219.7-150.9,357.3-150.9 s256.7,50.3,357.3,150.9l5891.8,5891.8c100.6,100.6,150.9,219.7,150.9,357.3C12113.2,8137.6,12062.9,8256.7,11962.3,8357.3 L11962.3,8357.3z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>




<div class="row responsive-center">
    @if(count($vouchers)<=0 ) 
        <div class="alert alert-danger text-center">
        <strong>Sorry!</strong> We couldn't find what you were looking for.
        <br>
        <a class="errorReturn" href="{{route('home')}}">Click here to return home</a>
</div>
@endif @if(!empty($vouchers)) @foreach($vouchers as $voucher)

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
                <p style="word-wrap: break-word;">
                    <br><strong>About Deal</strong>
                    <br>{{$voucher->description}}</p>
                @if (empty($voucher->expiry_date))
                <p>
                    <br><strong>Expiry Date</strong>
                    <br><i>Expiry date not available</i></p>
                @else
                <p>
                    <br><strong>Expiry Date</strong>
                    <br>{{\Carbon\Carbon::parse($voucher->expiry_date)->format('d/m/Y')}}</p>
                @endif @if (!empty($voucher->website_link))
                <a href="{{$voucher->website_link}}" target="_blank" style="color: #07AD4D;">
                    <br><i class="fas fa-globe-americas"></i><strong> Visit Website</strong></a>
                @endif
                <button class="btn btn-lg" style="width: 100%; height: 100%; background-color: #07AD4D; color:white;"><i class="fa fa-close"></i>Redeem Voucher on App</button>
            </div>
            <div class="modal-footer" style="background-color: #F2F2F2">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

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
    jssor_1_slider_init();
    jssor_2_slider_init();
    jssor_3_slider_init();
    jssor_4_slider_init();
    jssor_5_slider_init();
</script>
@stop