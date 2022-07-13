@extends('customer.layout.app')

@section('title')
About Us
@endsection

@section('styles')
<style>
.client-desc {
  padding-left: 275px;
}
.dev-desc {
  margin-top: 15px;
  padding-left: 0px;
  padding-right: 275px;
}
.support-img {
  height: 250px;
  width: 250px;
}
@media screen and (max-width: 768px) {
  .support-img {
    width: 100%;
    height: auto;
    padding: 15px;
  }
  .client-desc,
  .dev-desc {
    padding: 15px;
  }
}
</style>
@endsection

@section('content')
<section class="content-header">
  <h1>
    About Us
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">About Us</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-sm-12">

      <div class="box box-primary">
        {{-- <div class="box-header">
          <h3 class="box-title">Filter</h3>
        </div> --}}<!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <h2>Rana Marriage Bureau</h2>
              <img class="support-img" src="{{asset('assets/img/raju.jpg')}}" height="250px" width="250px" align="left">
              <p align="justify" class="client-desc">Rana Marriage Bureau is an independant organization operating for all caste from around 15 years. As a part of woman empowerment, Rana Marriage Bureau provides service to find marital perfect match, which is FREE for woman and ₹ 205 for man.</p>
            </div>
            <div class="col-md-12" style="margin-top: 40px;">
              <h2>Technical Support (ER Tech)</h2>
              <img class="support-img" src="{{asset('assets/img/kanaiya-rana.jpg')}}" height="250px" width="250px" align="right">
              <p align="justify" class="dev-desc">ER Tech provides support for different website with maintainance service which includes hosting in many maintainance service packages. We are also helping to minimise the hassle for our clients by providing technical support and at cheaper rate. Maintaince packages will come with free design and development upto unlimited hours so that any time, any change, won't cost you and keep your website up to date. For more details and exclusive plans, visit us on <a href="http://ertechnosoft.000webhostapp.com">ER Tech</a>.</p>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div>
</section>
@endsection

@section('scripts')
@endsection