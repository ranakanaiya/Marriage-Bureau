@extends('customer.layout.app')

@section('title')
{{$title}}
@endsection

@section('styles')

@endsection

@section('content')
<section class="content-header">
  <h1>
    {{$title}}
    {{-- <small>Control panel</small> --}}
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Subscription</li>
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
            <div class="col-md-12 text-red">
              {{$message}}
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