@extends('admin.layout.app')

@section('title')
Customer Archive
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
    Customer Archive
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
            <div class="col-md-12">
              <h3 class="box-title">Archived Customers List</h3>
            </div>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table class="table datatable table-bordered table-striped" style="width: 100%;">
            <thead>
              <tr>
                <th>No.</th>
                <th>Archive Date</th>
                <th>Name</th>
                <th>Email</th>
                <th>Subscribed</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
              <tr>
                <td>{{$loop->iteration}}.</td>
                <td>{{$user->created_at->format('d-m-Y')}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{!!($user->subscribed?'<span class="text-success">Subscribed</span>':'<span class="text-danger">Not Subscribed</span>')!!}</td>
                <td><form class="inline-block" method="post" action="{{route('admin.customers.archive.recover',$user->id)}}">
                      @csrf
                      <button type="button" onclick="archivedRecover(this,'{{$user->name}}')" class="btn btn-success">Recover</button>
                    </form>
                  </td>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>No.</th>
                <th>Archive Date</th>
                <th>Name</th>
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
@if(Session::Has('userData'))
  <script>
    swal({html:true,
      title:"{{Session::get('userData')['name']}} Recovered successfully!",
      text:"Email: {{Session::get('userData')['email']}}\n Password: {{Session::get('userData')['password']}}", 
      icon: "info",
    });
  </script>
@endif
<script>
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
  function archivedRecover(obj,name)
  {
    swal({
        html: true,
        title: "Are you sure?",
        text: "Do you want to recover data of "+name+"? After this other users can see this user and request to connect with them.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          swal("Recovering customer data!", {
            icon: "warning",
          });
          $(obj).closest('form').submit();
        } else {
          // swal("Your imaginary file is safe!");
        }
      });
  }
</script>
@endsection