<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li>
        <a href="{{route('dashboard')}}">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <li class="">
        <a href="{{route('userrequests.index')}}">
          <i class="fa fa-envelope"></i> <span>Inbox</span> <span class="label label-primary pull-right">{{(session()->has('requestCount')?session()->get('requestCount'):'')}}</span>
        </a>
      </li>
      <li>
        <a href="{{route('users.blocked')}}">
          <i class="fa fa-ban"></i> <span>Blocked Users</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>