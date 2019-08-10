@extends('layouts.main')
@section('content')
<div style="margin-bottom: 80px"></div>
<style>
.sidebar {
  display: inline-block;
  width: 25%;
  border-radius: 3px;
  overflow: hidden;
}

.sidebar i {
  margin-right: 15px;
}

.sidebar-menu-item {
  background: #FFF;
  padding: 20px;
  color: #999;
  border-bottom: 1px solid #F0F1F2;
  transition: all 0.3s ease;
}
.sidebar-menu-item--active {
  color: #000;
  border-left: 3px solid #348AA7;
}
.sidebar-menu-item:hover {
  background: #f7f7f7;
  cursor: pointer;
}

.main {
  width: 70%;
  vertical-align: top;
  display: inline-block;
  background: #FFF;
  margin-left: 3%;
  border-radius: 3px;
  overflow: hidden;
}

.main-header {
  padding: 20px;
  border-bottom: 1px solid #F0F1F2;
}

.main-content {
  padding: 20px;
}

.main-settings-form {
  max-width: 80%;
  display: block;
  margin: 0 auto;
}

.main-input-label {
  font-size: 100%;
  display: block;
  margin: 5px 5px 5px 5px;
}

.main-input {
  display: inline-block;
  width: 100%;
  border: 1px solid #F1F3F5;
  margin-bottom: 20px;
  outline: none;
  padding: 15px;
  border-radius: 3px;
  color: #000;

}

.main-input:disabled {
   background: #dddddd;
}

.main-input:focus {
  border: 1px solid #348AA7;
  transition: all 0.3s ease;
}

.btn {
  margin-bottom: 20px;
  border: none;
  outline: none;
  padding: 15px 25px;
  border-radius: 3px;
  transition: all 0.3s ease;
}

.main-save-button {
  color: #FFF;
  background-color: #8ED081;
}
.main-save-button:hover {
  background-color: #6dc25c;
  cursor: pointer;
}

.main-cancel-button {
  color: #FFF;
  background: #CCC;
}
.main-cancel-button:hover {
  background-color: #b3b3b3;
  cursor: pointer;
}


@media (max-width: 764px) {
  .sidebar {
    width: 100%;
    margin-bottom: 20px;
  }

  .sidebar-menu-item {
    padding: 15px;
  }

  .main {
    width: 100%;
    margin: 0;
  }

}
</style>
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
         <div class='sidebar-menu-item' onclick="changeTab(event, 'referal')">
            <i class='fa fa-user-plus'></i>
            Referals
         </div>
      </div>
      <div class='main' id="settings">
         <div class='main-header'>
            <h2>Settings</h2>
         </div>
         <div class='main-content'>
            <div class='main-settings-form' >
               <label class='main-input-label'>E-mail:</label>
               <input class='main-input' placeholder='{{ Auth::user()->email}}' type='text' disabled>
               <label class='main-input-label'>Name:</label>
               <input id="getname" class='main-input' value='{{ Auth::user()->first_name}}' type='text'>
               <label class='main-input-label'>Phone Number:</label>
               <input id="getnumber" class='main-input' value='{{ Auth::user()->phone_number}}' type='text'>
               <button class='btn main-save-button' onClick="updateAccount({{ Auth::user()->id }}, document.getElementById('getname').value, document.getElementById('getnumber').value)">Save</button>
               <button class='btn main-cancel-button'>Cancel</button>
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
      <div class='main' id="trans" style="display:none">
         <div class='main-header'>
            <h2>Order History</h2>
         </div>
         <div class='main-content'>
            <p class="text-center">Track all your orders with us here</p>
            <div class='main-settings-form' >
               <p class="text-center" style="color: #ad1707;">You currently have no orders</p>
               <button class='btn main-save-button' style="margin-top:250px;margin-left:250px;">Create</button>
            </div>
         </div>
      </div>
      <div class='main' id="referal" style="display:none">
         <div class='main-header'>
            <h2>Referal History</h2>
         </div>
         <div class='main-content'>
            <p class="text-center">Refer your friends and recieve rewards</p>
            <div class='main-settings-form' >
               <p class="text-center" style="color: #ad1707;">You currently have no referals</p>
               <button class='btn main-save-button' style="margin-top:250px;margin-left:250px;">Start now</button>
            </div>
         </div>
      </div>
   </div>

<div style="margin-bottom: 300px"></div>

<script>
      function changeTab(evt, cityName){
      var i;
  var x = document.getElementsByClassName("main");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none"; 
  }
  document.getElementById(cityName).style.display = "inline-block";
  /* Change the menu item active link if clicked on */ 
  tablinks = document.getElementsByClassName("sidebar-menu-item");
  for (i = 0; i < x.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" sidebar-menu-item--active", "");
  }
  evt.currentTarget.className += " sidebar-menu-item--active";
   }


   function updateAccount(id, name, phone_number) {
      $.ajaxSetup({
      headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });
	$.ajax({
		type: 'put',
		url: 'updateaccount/' + id,
		data: {
         'first_name': name,
         'phone_number': phone_number
		},
		success: function () {
			Swal.fire({
				toast: true,
				position: 'top',
            showConfirmButton: false,
				timer: 2000,
				type: 'success',
				title: 'Account settings successfully updated'
            })
            
		},
		error: function (XMLHttpRequest) {
			Swal.fire({
				toast: true,
				position: 'top',
				showConfirmButton: false,
				timer: 3500,
				type: 'error',
				title: 'The given information is invalid'
			})
		}
	});
}
   </script>

@stop