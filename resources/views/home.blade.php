@extends('layouts.app')

@section('content')

<body class="hold-transition sidebar-mini">
<div class="wrapper">
<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <router-link to="/example" class="admin-sidebar-link">
      <img src="https://i.imgur.com/pi2jjiw.png" class="sidebar-image img-circle elevation-3">
      <span class="admin-sidebar-text font-weight-light">GCD Admin</span>
    </router-link>
    <div class="sidebar">
        
      <!-- Sidebar Menu Items -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <router-link to="/example" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
                <p style="color: white">Dashboard</p>
            </router-link>
          </li>

          <li class="nav-item">
            <router-link to="/test" class="nav-link">
                <i class="nav-icon fas fa-envelope"></i>
                 <p style="color: white">Vouchers Management</p>
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
            <h1>Hello text that stays</h1>
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
    <!-- Right side footer -->
    <div class="float-right d-none d-sm-inline">
        Something on the right here maybe
    </div>
    <!-- Left side footer -->
    <strong>Copyright &copy; 2019 <a href="#">Some link</a></strong> All rights reserved.
</footer>
</div>
</body>

@endsection
