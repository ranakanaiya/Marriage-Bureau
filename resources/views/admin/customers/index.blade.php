@extends('admin.layout.app')

@section('title')
Customers
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
    Customers
    <small>Managment</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Customers</a></li>
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
            <div class="col-md-8">
              <h3 class="box-title">Customer List</h3>
            </div>
            <div class="col-md-4">
              <button class="btn btn-primary pull-right" onclick="location.href='{{route('admin.customers.create')}}';"><i class="fa fa-plus"></i> Add Customer</button>
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
                <th>Contact</th>
                <th>Email</th>
                <th>Subscribed</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
              <tr{{($user->is_blocked?' class=text-red':'')}}>
                <td>{{$loop->iteration}}</td>
                @if(!empty($user->personal_detail))
                <td><img height="55px" width="55px" class="profile-img" src="{{asset('/assets/img/'.(!empty($user->personal_detail->image_original)?'user/'.json_decode($user->personal_detail->image_original)[0]:'userNotFound.jpeg'))}}"></td> 
                <td><a title="Customer Detail" href="{{route('admin.customers.details',$user->id)}}">{{$user->personal_detail->first_name}} {{$user->personal_detail->last_name}}</a></td>
                <td>{{json_decode($user->personal_detail->contact)[0]}}<br>
                  {{json_decode($user->personal_detail->contact)[1]}}
                </td>
                @else
                <td><img height="55px" width="55px" class="profile-img" src="{{asset('/assets/img/user/userNotFound.jpeg')}}"></td> 
                <td></td>
                <td></td>
                @endif
                <td>{{$user->email}}</td>
                <td>
                  @if($user->subscribed==0)
                  <span class="text-red">No</span>
                  @else
                  <span class="text-green">Yes</span>
                  @endif
                </td>
                <td class="text-center"><a href="{{route('admin.customers.edit',$user->id)}}" class="btn btn-primary" title="Edit" style="width:100%;"><i class="fa fa-pencil-square-o"></i> Edits</a>
                <form method="post" class="d-inline" action="{{route('admin.customers.destroy',$user->id)}}" style="width:100%;">
                  @method('delete')
                  @csrf
                  <a href="#" onclick="CustomerDelete(this)" class="btn btn-danger" style="width:100%;"><i class="fa fa-trash-o"></i> Delete</a>
                </form>
                <form method="post" class="d-inline" action="{{route('admin.customers.block',$user->id)}}" style="width:100%;">
                  @csrf
                  <a href="#" class="btn btn-{{($user->is_blocked==0?'danger':'success')}} mt-1" style="width:100%;" onclick="CustomerBlock(this,{{$user->is_blocked}},'{{$user->name}}')"><i class="fa fa-ban"></i> {{($user->is_blocked==0?'':'Un')}}Block</a>
                </form>
                <br>
                {{-- @if($user->subscribed==0)
                <form method="post" class="d-inline" action="{{route('admin.customers.subscribe',$user->id)}}" style="width:100%;">
                  @csrf
                  <a href="#" title="Subscribe" onclick="CustomerSubscribe(this)" class="btn btn-success mt-1" style="width:100%;"><i class="fa fa-check-circle"></i> Subscribe</a>
                </form>
                
                @endif --}}
                <form method="post" class="d-inline" action="{{route('admin.customers.archive',$user->id)}}" style="width:100%;">
                  @csrf
                  <a href="#" onclick="CustomerArchive(this,'{{$user->name}}')" class="btn btn-danger mt-1" style="width:100%;"><i class="fa fa-archive"> Archive</i></a>
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
                <th>Contact</th>
                <th>Email</th>
                <th>Subscribed</th>
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
    msg = status?"Are you sure to unblock "+name+" ?":"Are you sure to block "+name+" ?";
    swal({
      title: msg,
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
  function CustomerSubscribe(obj)
  {
    swal({
        title: "Are you sure?",
        text: "Once subscribed, You will not be able to Un-Subscibe this user!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          swal("Customer has been Subscribed!", {
            icon: "success",
          });
          $(obj).closest('form').submit();
        } else {
          // swal("Your imaginary file is safe!");
        }
      });
  }
  function CustomerArchive(obj,name)
  {
    swal({
        title: "Are you sure?",
        text: "You want to archive " + name + "?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          swal("Customer is being archived!", {
            icon: "warning",
          });
          $(obj).closest('form').submit();
        } else {
          // swal("Your imaginary file is safe!");
        }
      });
  }

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