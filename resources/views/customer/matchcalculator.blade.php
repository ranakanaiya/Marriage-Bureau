@extends('customer.layout.app')

@section('title')
Match Gun Calculator (Hinduism Astrology)
@endsection

@section('styles')
<link href="{{asset('/assets/plugins/iCheck/all.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Match Gun Calculator (Hinduism Astrology)
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">My Profile</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">

    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Horoscope Detail Update</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-primary btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div><!-- /.box-header -->
        <form method="post" action="{{route('matchcalculator.post')}}">
          @csrf
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <div class="col-md-6">
                  <label>Janmaksar Type&nbsp;:&nbsp;&nbsp;</label>
                  @foreach(config('constants.JANMAKSAR_TYPE') as $key => $val)
                  @if($val!=0)
                  <label>
                    <input type="radio" value="{{$val}}" name="janmaksar_type" class="minimal">
                    {{$key}}&nbsp;&nbsp;
                  </label>
                  @endif
                  @endforeach
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="col-md-3 col-sm-12">
                  <div class="form-group">
                    <label for="naksatra">Naksatra</label>
                    <select name="naksatra" id="naksatra" class="form-control" required>
                      @foreach(config('constants.NAKSHATRA') as $key => $val)
                      @if($val!=0)
                      <option value="{{$val}}">{{$key}}</option>
                      @endif
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-3 col-sm-12">
                  <div class="form-group">
                    <label for="zodiac_sign">Zodiac Sign</label>
                    <select name="zodiac_sign" id="zodiac_sign" class="form-control" required>
                      @foreach(config('constants.ZODIAC_SIGN') as $key => $val)
                      @if($val!=0)
                      <option value="{{$val}}" >{{$key}}</option>
                      @endif
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-3 col-sm-12">
                  <div class="form-group">
                    <label for="gan">Gan</label>
                    <select name="gan" id="gan" class="form-control" required>
                      @foreach(config('constants.GAN') as $key => $val)
                      @if($val!=0)
                      <option value="{{$val}}">{{$key}}</option>
                      @endif
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-3 col-sm-12">
                  <div class="form-group">
                    <label for="naadi">Naadi</label>
                    <select name="naadi" id="naadi" class="form-control" required>
                      @foreach(config('constants.NAADI') as $key => $val)
                      @if($val!=0)
                      <option value="{{$val}}">{{$key}}</option>
                      @endif
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="col-md-12">
                  <button type="submit" class="btn btn-primary pull-right">Submit</button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
        </form>
      </div><!-- /.box -->
    </div><!-- /.col -->


  </div><!-- /.row -->
</section>

@if(Session::Has('message'))
@if(Session::get('status') != 'error')
<div id="matchResultModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Match Calcualtion Result</h4>
      </div>  
      <form method="post" action="{{route('dashboard.family_detail')}}">
        @csrf
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            @if(Session::get('data')['status']==1)
            <span class="text-green">{{Session::get('data')['message']}}</span>
            @else
            <span class="text-red">{{Session::get('data')['message']}}</span>
            @endif
          </div>
        </div>
      </div>
      <div class="modal-footer">
        {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>

  </div>
</div>
@endif
@endif

@endsection

@section('scripts')
<script src="{{asset('/assets/plugins/iCheck/icheck.min.js')}}" type="text/javascript"></script>
<script>
	$(document).ready(function(e){
    @if(Session::Has('message'))
    @if(Session::get('status') != 'error')
    $('#matchResultModal').modal('show');
    @endif
    @endif
		$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
	});
</script>
@endsection