@extends('customer.layout.app')

@section('title')
Privacy Policy
@endsection

@section('styles')
@endsection

@section('content')
<section class="content-header">
  <h1>
    Privacy Policy
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Refund Policy</li>
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
              <p align="justify" class="client-desc">Under no circumstances there will be a refund. Rana Marriage Bureau will not refund any payment to any user or member for any reason whatsoever unless it is the case or an error on the part of Rana Marriage Bureau and its authorities. It is suggested to read the entire terms & conditions before making any payment.</p>
              <p align="justify" class="client-desc">Rana Marriage Bureau will not refund any user or member who has decided not to continue to use our matrimonial services.</p>
              <p align="justify" class="client-desc">Agreeing to our terms and conditions during the creation of your account indicates that you are completely concerned about the refund policy of Rana Marriage Bureau.</p>
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