<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li >
        <a href="{{route('admin.dashboard')}}">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <li class="">
        <a href="{{route('admin.customers.create')}}">
          <i class="fa fa-user"></i> <span>Add Customers</span>
        </a>
      </li>
      <li class="">
        <a href="{{route('admin.customers.index')}}">
          <i class="fa fa-user"></i> <span>Customers</span>
        </a>
      </li>
      <li class="">
        <a href="{{route('admin.customers.archived')}}">
          <i class="fa fa-archive"></i> <span>Customer Archived</span>
        </a>
      </li>
      <li class="">
        <a href="{{route('admin.userrequest.index')}}">
          <i class="fa fa-envelope"></i> <span>User Requests</span>
        </a>
      </li>
      <li class="">
        <a href="{{route('admin.contactus.index')}}">
          <i class="fa fa-envelope"></i> <span>Contact Messages</span>
        </a>
      </li>
      {{-- <li class="">
        <a href="{{route('admin.terms')}}">
          <i class="fa fa-cog"></i> <span>T&C Managment</span>
        </a>
      </li>
      <li class="">
        <a href="{{route('admin.privacy')}}">
          <i class="fa fa-cog"></i> <span>Privacy Policy Managment</span>
        </a>
      </li> --}}
      
      {{-- <li class="">
        <a href="pages/widgets.html">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li> --}}
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>