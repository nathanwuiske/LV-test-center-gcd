@extends('layouts.main')
@section('content')
<style>
   body{
      background-image: url(../imgs/download_app/background.jpg); 
  background-size: cover;  
  background-repeat: no-repeat; 
  background-position: center center; 
  background-attachment: fixed;
   }
</style>
<section class="advertiseFacts">
   <div class="parallax-overlay-app">
      <div class="container">
         <div class="row">
          <img class="download-mobile" src="/imgs/download_app/phone.png">
            <div class="text-center mb50 app-mobile">
               <a href="https://apps.apple.com/us/app/gold-coast-discounts/id1481178823?ls=1"><img src="/imgs/download_app/apple.jpg"></a>
             <a href="https://play.google.com/store/apps/details?id=com.abp.GCD&hl=en"><img src="/imgs/download_app/google.jpg"></a>
            </div>
         </div>
      </div>
   </div>
</section>
<div class="mb400"></div>

<script>
function message() {
		Swal.fire({
			toast: true,
			position: 'top',
			showConfirmButton: false,
         timer: 5000,
			type: 'info',
         title: 'Sorry! The GCD iOS App has been temporarily removed.'
		})
}
</script>
@stop