<header class="main-header">               
  <nav class="navbar navbar-static-top">
    <div class="container-fluid">
    <div class="navbar-header">
      <a href="{{route('dashboard')}}" class="navbar-brand"><b>Rana Marriage</b>Bureau</a>
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
        <i class="fa fa-bars"></i>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navbar-collapse">
      <ul class="nav navbar-nav">
        {{-- <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li> --}}
        <li>
          <a href="{{route('dashboard')}}">
            <span>Dashboard</span>
          </a>
        </li>
        <li class="">
          <a href="{{route('userrequests.index')}}">
            <span>Inbox</span> <span class="label label-primary pull-right">{{(session()->has('requestCount')?session()->get('requestCount'):'')}}</span>
          </a>
        </li>
        <li>
          <a href="{{route('users.blocked')}}">
            <span>Blocked Users</span>
          </a>
        </li>
        <li>
          <a href="{{route('matchcalculator')}}">
            <span>Match Calculator</span>
          </a>
        </li>
        <li>
          <a href="{{route('aboutus')}}">
            <span>About Us</span>
          </a>
        </li>
        <li>
          <a href="{{route('contactus')}}">
            <span>Contact Us</span>
          </a>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <!-- User image -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            @if(!empty(auth()->user()->personal_detail) && !empty(auth()->user()->personal_detail->image_original) && count(json_decode(auth()->user()->personal_detail->image_original))>0)
                <img src="{{asset('/assets/img/user/'.json_decode(auth()->user()->personal_detail->image_original)[0])}}" class="user-image" alt="User Image" />
            @endif
            <span class="header-user">{{auth()->user()->name}}</span>
          </a>
          <ul class="dropdown-menu">
            <li class="user-header">
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
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown user user-menu">
          <div id="google_translate_element"></div>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
</header>

{{-- <header class="main-header">
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
            <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
            <span class="hidden-xs">{{auth()->user()->name}}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
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
</header> --}}