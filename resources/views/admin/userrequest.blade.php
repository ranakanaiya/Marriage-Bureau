@extends('admin.layout.app')

@section('title')
User Requests
@endsection

@section('styles')
<!-- DATA TABLES -->
{{-- <link href="{{asset('/assets/plugins/datatables/dataTables.bootstrap.css')}}" rel="stylesheet" type="text/css" /> --}}
<link href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    User Requests
    <small>Managment</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">User Requests</a></li>
    <li class="active">List</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">

      <div class="box box-primary">
        <div class="box-header">
          <div class="row">
            <div class="col-md-12">
              <h3 class="box-title">User Request List</h3>
            </div>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table class="table datatable table-bordered table-striped" style="width: 100%;">
            <thead>
              <tr>
                <th>No.</th>
                <th>Date</th>
                <th>Customer Image</th>
                <th>Customer</th>
                <th>Sender Image</th>
                <th>Sender</th>
                <th>Request Type</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($requests as $request)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$request->created_at->format('d-m-Y')}}</td>
                @if(!empty($request->user->personal_detail))
                <td><img height="55px" width="55px" class="profile-img" src="{{asset('/assets/img/'.(!empty($request->user->personal_detail->image_original)?'user/'.json_decode($request->user->personal_detail->image_original)[0]:'userNotFound.jpeg'))}}"><br></td> 
                <td>{{$request->user->personal_detail->first_name}} {{$request->user->personal_detail->last_name}}<br>{{$request->user->email}}
                    <br>{{json_decode($request->user->personal_detail->contact)[0]}}<br>{{json_decode($request->user->personal_detail->contact)[1]}}</td>
                @else
                <td><img height="55px" width="55px" class="profile-img" src="{{asset('/assets/img/user/userNotFound.jpeg')}}"></td> 
                <td></td>
                @endif

                @if(!empty($request->sender->personal_detail))
                <td><img height="55px" width="55px" class="profile-img" src="{{asset('/assets/img/'.(!empty($request->sender->personal_detail->image_original)?'user/'.json_decode($request->sender->personal_detail->image_original)[0]:'userNotFound.jpeg'))}}"><br></td> 
                <td>{{$request->sender->personal_detail->first_name}} {{$request->sender->personal_detail->last_name}}<br>{{$request->sender->email}}
                    <br>{{json_decode($request->sender->personal_detail->contact)[0]}}<br>{{json_decode($request->sender->personal_detail->contact)[1]}}</td>
                @else
                <td><img height="55px" width="55px" class="profile-img" src="{{asset('/assets/img/user/userNotFound.jpeg')}}"></td> 
                <td></td>
                @endif

                <td>{{($request->type==0?'Connect':'Image')}}</td>
                <td>
                  @if($request->status==0)
                  <span class="text-aqua">Pending</span>
                  @elseif($request->status==1)
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
                <th>Date</th>
                <th>Customer Image</th>
                <th>Customer</th>
                <th>Sender Image</th>
                <th>Sender</th>
                <th>Request Type</th>
                <th>Status</th>
              </tr>
            </tfoot>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section>

@endsection

@section('scripts')
<!-- DATA TABES SCRIPT -->
<script src="{{asset('/assets/plugins/datatables/jquery.dataTables.js')}}" type="text/javascript"></script>
<script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<!-- page script -->
<script type="text/javascript">
  function CustomerDelete(obj)
  {
    swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this Customer! Other details related to this Customer will also be deleted!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              swal("Customer has been deleted!", {
                icon: "success",
              });
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
			if(title!=='Image' && title!=='Status' && title!=='Action')
				$(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
		} );
    $('.datatable').dataTable({
      "responsive": true,
			"columnDefs": [
			    { "width": "8%", "targets": 0 },
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
			}
		});
  });
</script>
@endsection