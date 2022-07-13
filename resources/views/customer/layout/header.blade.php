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
        <li><div id="google_translate_element"></div></li>
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            @if(!empty(auth()->user()->personal_detail) && !empty(auth()->user()->personal_detail->image_original))
                <img src="{{asset('/assets/img/user/'.auth()->user()->personal_detail->image_original)}}" class="user-image" alt="User Image" />
            @endif
            {{-- <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image"/> --}}
            <span class="hidden-xs">{{auth()->user()->name}}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              {{-- @if(!empty(auth()->user()->personal_detail) && !empty(auth()->user()->personal_detail->image))
                <img src="{{asset('/assets/img/user/'.auth()->user()->personal_detail->image)}}" class="img-circle" alt="User Image" />
              @endif --}}
              <p>
                {{auth()->user()->name}}
                <small>{{date('d, F, Y')}}</small>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="{{route('profile')}}" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a href="{{route('logout')}}" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>