@extends('layouts.app')

@section('content')
<body class="hold-transition sidebar-mini pl-0 pr-0"> <!-- Applied pl-0 and pr-0 to fix modal bug -->
<div class="wrapper">
<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <router-link to="/dashboard" class="admin-sidebar-link">
      <img src="{{asset('imgs/1.png')}}" class="sidebar-image img-circle elevation-3">
      <span class="admin-sidebar-text font-weight-light">GCD Admin</span>
    </router-link>
    <div class="sidebar">
        
      <!-- Sidebar Menu Items -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <router-link to="/dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
                <p class="white">Dashboard</p>
            </router-link>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-envelope"></i>
              <p class="white">
                Voucher Management
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <router-link to="/vouchers" class="nav-link">
                  <i class="nav-icon fas fa-list"></i>
                  <p class="white">Vouchers</p>
                 </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/categories" class="nav-link">
                  <i class="nav-icon fas fa-ellipsis-v"></i>
                  <p class="white">Categories</p>
                 </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/locations" class="nav-link">
                  <i class="nav-icon fas fa-map-marker-alt"></i>
                  <p class="white">Locations</p>
                 </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/tags" class="nav-link">
                  <i class="nav-icon fas fa-tags"></i>
                  <p class="white">Tags</p>
                 </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/business" class="nav-link">
                  <i class="nav-icon fas fa-briefcase"></i>
                  <p class="white">Businesses</p>
                 </router-link>
              </li>
            </ul>
          </li>
  
         <li class="nav-item">
            <router-link to="/users" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                 <p class="white">User Management</p>
            </router-link>
         </li>

         <li class="nav-item">
            <router-link to="/issues" class="nav-link">
                <i class="nav-icon fas fa-exclamation"></i>
                 <p class="white">Issues</p>
            </router-link>
         </li>

        </ul>
      </nav>
    </div>
  </aside>
<!-- End Main Sidebar Container -->

<!-- Main page Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header-->
    <div class="content-header">
        <div class="container-fluid">
              <!-- <h1>Hello text that stays</h1>-->
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <router-view></router-view>
        </div>
    </div>
</div> 
<!-- end content-wrapper -->
 

<!-- Footer Main -->
<footer class="main-footer">
    <strong>Copyright 2019 </strong>
</footer>
</div>
</body>


@endsection
