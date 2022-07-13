<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>@yield('title','Rana Marriage Bureau')</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="icon" href="{{asset('assets/img/rm_logo.png')}}" type="image/icon type">
    @include('admin.layout.styles')
    @yield('styles')

  </head>
  <body class="skin-blue fixed">
    <div class="wrapper">
      @include('admin.layout.header')
      @include('admin.layout.sidebar')

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!--Error success alert section-->
        <section class="content" style="min-height: 0px;padding:0px;">
@if(Session::Has('message'))
      @if(Session::get('status') == 'success')
        <div class="alert alert-success alert-dismissible">
          <button href="#" class="close" data-dismiss="alert" aria-label="close">&times;</button>
          <strong>{{ucwords(Session::get('status'))}}!</strong> {{Session::get('message')}}
        </div>
      @else
        <div class="alert alert-danger alert-dismissible">
          <button href="#" class="close" data-dismiss="alert" aria-label="close">&times;</button>
          <strong>{{ucwords(Session::get('status'))}}!</strong> {{Session::get('message')}}
        </div>
      @endif
@endif
@if ($errors->any())
        
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible">
          <button href="#" class="close" data-dismiss="alert" aria-label="close">&times;</button>
          <strong>Error!</strong> {{$error}}
        </div>
    @endforeach
@endif
        </section>
        <!-- Content Header (Page header) -->
        @yield('content')
      </div><!-- /.content-wrapper -->
      @include('admin.layout.footer')
    </div><!-- ./wrapper -->

<!-- Full Screen Modal -->
<div id="fullScreenModal" class="screenModal">

  <!-- The Close Button -->
  <span class="screen-close" onclick="screenClose()">&times;</span>

  <!-- Modal Content (The Image) -->
  <img class="screen-modal-content" id="img01">

  <!-- Modal Caption (Image Text) -->
  <div id="screenDescription">
      {{-- <table>
        <tr>
            <th>Date:</th>
            <th id="date01"></th>
        </tr>
        <tr>
            <th style="vertical-align: top;">Description:</th>
            <th id="description01"></th>
        </tr>
      </table> --}}
  </div>
</div>


    @include('admin.layout.scripts')
    @yield('scripts')
  </body>
</html>