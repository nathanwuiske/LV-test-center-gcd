@extends('layouts.main')
@section('content')
<div class="mb80"></div>
<div class='container'>
   <div class='sidebar'>
      <div class='sidebar-menu-item sidebar-menu-item--active' onclick="changeTab(event, 'settings')">
         <i class='fa fa-cog'></i>
         Settings
      </div>
      <div class='sidebar-menu-item' onclick="changeTab(event, 'trans')">
         <i class='fa fa-briefcase'></i>
         Orders
      </div>
   </div>
   <div class='account-main' id="settings">
      <div class='main-header'>
         <h2>Settings</h2>
      </div>
      <div class='main-content'>
         <div class='main-settings-form' >
            <label class='main-input-label'>E-mail:</label>
            <input class='main-input' placeholder='{{ Auth::user()->email}}' type='text' disabled>
            <label class='main-input-label'>Name:</label>
            <input id="getname" class='main-input' placeholder="e.g. John Doe" value='{{ Auth::user()->full_name}}' type='text'>
            <label class='main-input-label'>Phone Number:</label>
            <input id="getnumber" class='main-input' placeholder="e.g. 0428529240" value='{{ Auth::user()->phone_number}}' type='text'>
            <button class='btn main-save-button' onClick="checkToUpdate({{ Auth::user()->id }}, document.getElementById('getname').value, document.getElementById('getnumber').value)">Save</button>
            @if(count($errors))
            <ul class="alert alert-danger">
               @foreach($errors->all() as $error)
               <li class="login-error-message">{{$error}}</li>
               @endforeach
            </ul>
            @endif
         </div>
      </div>
   </div>
   <div class='account-main' id="trans" style="display:none">
      <div class='main-header'>
         <h2>Order History</h2>
      </div>
      <div class='main-content'>
         <p class="text-center">Track all your orders with us here</p>
         <div class='main-settings-form' >
            <p class="text-center main-red-col">You currently have no orders</p>
            <div class="mt330"></div>
         </div>
      </div>
   </div>
</div>
<div class="mb300"></div>

<script>
function changeTab(evt, tabName) {
	var i;
	var x = document.getElementsByClassName("account-main");
	for (i = 0; i < x.length; i++) {
		x[i].style.display = "none";
	}
	document.getElementById(tabName).style.display = "inline-block";
	/* Change the menu item active link if clicked on */
	tablinks = document.getElementsByClassName("sidebar-menu-item");
	for (i = 0; i < x.length; i++) {
		tablinks[i].className = tablinks[i].className.replace(" sidebar-menu-item--active", "");
	}
	evt.currentTarget.className += " sidebar-menu-item--active";
}
var hasChanged = false;

$("#getname").on("input", function () {
	hasChanged = true;
});
$("#getnumber").on("input", function () {
	hasChanged = true;
});

function checkToUpdate(id, name, phone_number) {
	if (hasChanged) {
		updateAccount(id, name, phone_number);
	} else {
		Swal.fire({
			toast: true,
			position: 'top',
			showConfirmButton: false,
         timer: 3000,
			type: 'error',
         title: 'No changes have been made'
		})
	}
}
</script>

@stop