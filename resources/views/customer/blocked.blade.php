@extends('customer.layout.app')

@section('title')
Blocked Users
@endsection

@section('styles')
<!-- DATA TABLES -->
{{-- <link href="{{asset('/assets/plugins/datatables/dataTables.bootstrap.css')}}" rel="stylesheet" type="text/css" /> --}}
<link href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Blocked Users
    <small>Managment</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Blocked Users</a></li>
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
              <h3 class="box-title">Blocked Users List</h3>
            </div>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table class="table datatable table-bordered table-striped" style="width: 100%;">
            <thead>
              <tr>
                <th>No.</th>
                <th>Image</th>
                <th>Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
              <tr>
                <td>{{$loop->iteration}}</td>
                @if(!empty($user->blocked_user->personal_detail))
                <td>
                  @if((!empty($user->blocked_user->sent_image_request(auth()->id())) && $user->blocked_user->sent_image_request(auth()->id())->status==1) || (!empty($user->blocked_user->received_image_request(auth()->id())) && $user->blocked_user->received_image_request(auth()->id())->status==1))
                  <img height="55px" width="55px" class="profile-img" src="{{asset('/assets/img/'.(!empty($user->blocked_user->personal_detail->image_original)?'user/'.json_decode($user->blocked_user->personal_detail->image_original)[0]:'userNotFound.jpeg'))}}">
                  @else
                  <img height="55px" width="55px" class="profile-img" src="{{asset('/assets/img/'.(!empty($user->blocked_user->personal_detail->image)?'user/'.json_decode($user->blocked_user->personal_detail->image)[0]:'userNotFound.jpeg'))}}">
                  @endif
                </td> 
                <td><a title="Customer Detail" href="{{route('customer.details',$user->blocked_user->id)}}">{{$user->blocked_user->personal_detail->first_name}} {{$user->blocked_user->personal_detail->last_name}}</a></td>
                @else
                <td><img height="55px" width="55px" class="profile-img" src="{{asset('/assets/img/user/userNotFound.jpeg')}}"></td> 
                <td></td>
                @endif
                <td class="text-center">
                <form method="post" class="d-inline" action="{{route('user.unblock',$user->blocked_user->id)}}">
                  @csrf
                  <a href="#" title="UnBlock" onclick="CustomerBlock(this,{{$user->blocked_user->is_blocked}},'{{$user->blocked_user->name}}')"><i class="fa fa-2x fa-ban text-danger"></i></a>
                </form>
              </td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>No.</th>
                <th>Image</th>
                <th>Name</th>
                <th>Action</th>
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
  function CustomerBlock(obj, status,name)
  {
    swal({
      title: 'UnBlock '+name+' ?',
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
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