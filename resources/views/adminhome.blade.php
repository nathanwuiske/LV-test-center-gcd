@extends('layouts.app')
@section('content')
<body class="hold-transition sidebar-mini pl-0 pr-0">
   <!-- Applied pl-0 and pr-0 to fix modal bug -->
   <div class="wrapper">
      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        
         <div class="sidebar">
            <!-- Sidebar Menu Items -->
            <nav class="mt-2">
               <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <li class="nav-header" style="color: white">General Management</li>
                  <li class="nav-item">
                     <router-link to="/dashboard" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p class="white">Dashboard</p>
                     </router-link>
                  </li>
                  <li class="nav-item">
                        <router-link to="/messages" class="nav-link">
                           <i class="nav-icon fas fa-comment-alt"></i>
                           <p class="white">App Notifications</p>
                        </router-link>
                     </li>
                  <li class="nav-item">
                     <router-link to="/issues" class="nav-link">
                        <i class="nav-icon fas fa-exclamation"></i>
                        <p class="white">User Issues</p>
                     </router-link>
                  </li>
                  <li class="nav-header" style="color: white">Voucher Management</li>
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
                  <li class="nav-item">
                        <router-link to="/archived" class="nav-link">
                           <i class="nav-icon fas fa-archive"></i>
                           <p class="white">Archived</p>
                        </router-link>
                  </li>
                  <li class="nav-header" style="color: white">User Management</li>
                  <li class="nav-item">
                     <router-link to="/users" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p class="white">Users</p>
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
            </div>
         </div>
         <!-- Main content -->
         <div class="content">
            <div class="container-fluid">
               <!-- set router view -->
               <router-view></router-view>
               <!-- set progressbar -->
               <vue-progress-bar></vue-progress-bar>
            </div>
         </div>
      </div>
      <!-- end content-wrapper -->
      <!-- Footer Main -->
      <footer class="main-footer">
         <strong>Copyright © 2019 Gold Coast Discounts</strong>
      </footer>
   </div>
</body>
@endsection