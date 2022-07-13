@extends('customer.layout.app')

@section('title')
Inbox
@endsection

@section('styles')
<link href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
{{-- <style>
  .tab-pane {
    width: 100%;
    overflow-x: auto;
  }
</style> --}}
@endsection

@section('content')
<section class="content-header">
  <h1>
    Inbox
    <small>Request Managment</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">

    <div class="col-sm-12">

      <div class="box box-primary">
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                  <li class="active"><a href="#tab_1-1" data-toggle="tab">Request Received</a></li>
                  <li><a href="#tab_2-2" data-toggle="tab">Request Sent</a></li>
                  <li class="pull-left header">Requests</li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1-1">
                    <table class="table datatable table-bordered table-striped rsponsive" style="width: 100%;">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Image</th>
                          <th>Request</th>
                          <th>Age</th>
                          <th>Marital Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($received as $req)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          @if(!empty($req->sender->personal_detail))
                          <td>
                            @if((!empty($req->user->sent_image_request(auth()->id())) && $req->user->sent_image_request(auth()->id())->status==1) || (!empty($req->user->received_image_request(auth()->id())) && $req->user->received_image_request(auth()->id())->status==1))
                            <img height="55px" width="55px" class="profile-img" src="{{asset('/assets/img/'.(!empty($req->sender->personal_detail->image_original)?'user/'.json_decode($req->sender->personal_detail->image_original)[0]:'userNotFound.jpeg'))}}">
                            @else
                            <img height="55px" width="55px" class="profile-img" src="{{asset('/assets/img/'.(!empty($req->sender->personal_detail->image)?'user/'.json_decode($req->sender->personal_detail->image)[0]:'userNotFound.jpeg'))}}">
                            @endif
                          </td>
                          <td><strong>{{$req->sender->personal_detail->first_name}} {{$req->sender->personal_detail->last_name}}</strong> {{($req->type==0?'is interested to connect, Are you interested too?':'has requested to see your profile picture, Should we show them?')}}</td>
                          <td>{{\Carbon\Carbon::parse($req->sender->personal_detail->dob)->diff(\Carbon\Carbon::now())->format('%y years');}}</td>
                          <td>{{array_keys(config('constants.MARRITAL_STATUS'),$req->sender->personal_detail->marital_status)[0]}}</td>
                          @else
                          <td><img height="55px" width="55px" class="profile-img" src="{{asset('/assets/img/user/userNotFound.jpeg')}}"></td> 
                          <td></td>
                          <td></td>
                          <td></td>
                          @endif
                          <td class="text-center">
                            @if(auth()->user()->subscribed==1)

                              @if($req->status==0)
                              <form method="post" action="{{route('customer.request.accept',['user_request'=>$req->id,'user'=>$req->sender->id])}}" class="d-inline">
                                @csrf
                                <input type="hidden" value="1" name="accepted">
                                <a href="#" title="Accept" onclick="accept(this)" class="text-green"><i class="fa fa-check fa-2x"></i></a>
                              </form>&nbsp;&nbsp;

                              <form method="post" action="{{route('customer.request.accept',['user_request'=>$req->id,'user'=>$req->sender->id])}}" class="d-inline">
                                @csrf
                                <input type="hidden" value="5" name="accepted">
                                <a href="#" title="Reject" onclick="accept(this)" class="text-red"><i class="fa fa-times fa-2x"></i></a>
                              </form>
                              @elseif($req->status==1)
                                <span class="text-green">Accepted</span>
                              @else
                                <span class="text-red">Rejected</span>
                              @endif

                            @else
                              <button type="button" onclick="location.href='{{route('subscription.plans')}}';" class="btn btn-primary">Subscribe</button>
                            @endif
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>No.</th>
                          <th>Image</th>
                          <th>Request</th>
                          <th>Age</th>
                          <th>Marital Status</th>
                          <th>Action</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2-2">
                    <table class="table datatable table-bordered table-striped" style="width: 100%;">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Image</th>
                          <th>Name</th>
                          <th>Age</th>
                          <th>Marital Status</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($sent as $req)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          @if(!empty($req->user->personal_detail))
                          <td>
                            @if((!empty($req->user->sent_image_request(auth()->id())) && $req->user->sent_image_request(auth()->id())->status==1) || (!empty($req->user->received_image_request(auth()->id())) && $req->user->received_image_request(auth()->id())->status==1))
                            <img height="55px" width="55px" class="profile-img" src="{{asset('/assets/img/'.(!empty($req->user->personal_detail->image_original)?'user/'.json_decode($req->user->personal_detail->image_original)[0]:'userNotFound.jpeg'))}}">
                            @else
                            <img height="55px" width="55px" class="profile-img" src="{{asset('/assets/img/'.(!empty($req->user->personal_detail->image)?'user/'.json_decode($req->user->personal_detail->image)[0]:'userNotFound.jpeg'))}}">
                            @endif
                          </td> 
                          <td><strong>{{$req->user->personal_detail->first_name}} {{$req->user->personal_detail->last_name}}</strong> ({{($req->type==0?'Sent Request to Connect':'Sent Request for  Profile Picture')}})</td>
                          <td>{{\Carbon\Carbon::parse($req->user->personal_detail->dob)->diff(\Carbon\Carbon::now())->format('%y years');}}</td>
                          <td>{{array_keys(config('constants.MARRITAL_STATUS'),$req->user->personal_detail->marital_status)[0]}}</td>
                          @else
                          <td><img height="55px" width="55px" class="profile-img" src="{{asset('/assets/img/user/userNotFound.jpeg')}}"></td> 
                          <td></td>
                          <td></td>
                          <td></td>
                          @endif
                          <td>
                            @if($req->status==0)
                              <span class="text-aqua">Pending</span>
                            @elseif($req->status==1)
                              <span class="text-green">Accepted</span>
                            @else
                              <span class="text-red">Rejected</span>
                            @endif
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>No.</th>
                          <th>Image</th>
                          <th>Name</th>
                          <th>Age</th>
                          <th>Marital Status</th>
                          <th>Status</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div>
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
<script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script>
  function accept(obj)
  {
    swal({
            title: "Are you sure?",
            text: "Once done, You cannot revert it!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((accept) => {
            if (accept) {
              $(obj).closest('form').submit();
            } else {
              // swal("Your imaginary file is safe!");
            }
          });
  }
  $(function () {
    var search = '<tr>';
    $('.datatable tfoot th').each( function () {
      var title = $(this).text();
      if(title!=='Image' && title!=='Action')
        $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
    } );
    $('.datatable').dataTable({
      "columnDefs": [
          { "width": "8%", "targets": [0,1] },
                // { "width": "15%", "targets": 5 },
          { orderable: false, targets: [-1] }
        ],
      initComplete: function () {
      // Apply the search
        this.api().columns().every( function () {
          var that = this;
          
          $( 'input', this.footer() ).on( 'keyup change clear', function () {
            if ( that.search() !== this.value ) {
              that.search( this.value).draw();
            }
          });
        });
      },
      responsive: true
    });
  });
</script>
@endsection