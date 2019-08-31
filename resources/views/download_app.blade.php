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
               <a onClick="message()"><img src="/imgs/download_app/apple.jpg"></a>
               <a onClick="message()"><img src="/imgs/download_app/google.jpg"></a>
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
         timer: 4000,
			type: 'info',
         title: 'Sorry! The GCD App has temporarily been removed.'
		})
}
</script>
@stop