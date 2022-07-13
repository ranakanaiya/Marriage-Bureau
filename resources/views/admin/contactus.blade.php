@extends('admin.layout.app')

@section('title')
Contact Messages
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
    Contact Messages
    <small>Contact</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('admin.contactus.index')}}">Contact Messages</a></li>
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
              <h3 class="box-title">Contact Messages List</h3>
            </div>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table class="table datatable table-bordered table-striped" style="width: 100%;">
            <thead>
              <tr>
                <th>No.</th>
                <th>Date</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>email</th>
                <th>Contact</th>
                <th>Message</th>
              </tr>
            </thead>
            <tbody>
              @foreach($msgs as $msg)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{date('d-m-Y',strtotime($msg->created_at))}}</td>
                <td>{{$msg->first_name}}</td>
                <td>{{$msg->last_name}}</td>
                <td>{{$msg->email}}</td>
                <td>{{$msg->contact_no}}</td>
                <td>{!!nl2br($msg->message)!!}</td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>No.</th>
                <td>Date</td>
                <th>First Name</th>
                <th>Last Name</th>
                <th>email</th>
                <th>Contact</th>
                <th>Message</th>
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
			$(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
		} );
    $('.datatable').dataTable({
      "responsive": true,
			"columnDefs": [
			    { "width": "8%", "targets": 0 },
                // { "width": "15%", "targets": 5 },
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