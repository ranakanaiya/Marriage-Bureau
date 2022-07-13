<header class="main-header">
  <!-- Logo -->
  <a href="index2.html" class="logo"><b>Rana Marriage</b>Bureau</a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            {{-- <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image"/> --}}
            <span class="hidden-xs">{{auth()->user()->name}}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              {{-- <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" /> --}}
              <p>
                {{auth()->user()->name}}
                <small>{{date('d, F, Y')}}</small>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="text-center">
                <a href="{{route('admin.logout')}}" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>