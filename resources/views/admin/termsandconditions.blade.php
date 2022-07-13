@extends('admin.layout.app')

@section('title')
Terms and Conditions Managment
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
    Terms and Conditions Managment
    <small>Contact</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('admin.contactus.index')}}">Terms and Conditions Managment</a></li>
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
              <h3 class="box-title">Terms and Conditions Managment List</h3>
            </div>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <form method="post">
              @csrf
              <div class="col-md-12 form-group">
                <label for="terms">Terms and Conditions</label>
                <textarea name="terms" id="terms" rows="5">{{$terms->data}}</textarea>
              </div>
              <div class="col-md-12 form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
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
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<!-- page script -->
<script type="text/javascript">
  CKEDITOR.replace( 'terms' );
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