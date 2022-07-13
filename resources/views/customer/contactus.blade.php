@extends('customer.layout.app')

@section('title')
Contact Us
@endsection

@section('styles')
<style>
.client-desc {
  padding-left: 275px;
}
.dev-desc {
  margin-top: 15px;
  padding-left: 0px;
  padding-right: 275px;
}
.support-img {
  height: 250px;
  width: 250px;
}
@media screen and (max-width: 768px) {
  .support-img {
    width: 100%;
    height: auto;
    padding: 15px;
  }
  .client-desc,
  .dev-desc {
    padding: 15px;
  }
}
</style>
@endsection

@section('content')
<section class="content-header">
  <h1>
    Contact Us
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Contact Us</li>
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
              <form method="post">
                @csrf
                <p>We likes to hear from you!</p>
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <label for="firstName" class="sr-only">First Name</label>
                    <input type="text" name="firstName" class="form-control" id="firstName" placeholder="First Name" required>
                  </div>
                </div>
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <label for="lastName" class="sr-only">Last Name</label>
                    <input type="text" name="lastName" class="form-control" id="lastName" placeholder="Last Name" required>
                  </div>
                </div>
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                  </div>
                </div>
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <label for="contact" class="sr-only">Contact No</label>
                    <input type="contact" name="contact" class="form-control" id="contact" placeholder="Contact No" required>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="message" class="sr-only">Message</label>
                    <textarea name="message" class="form-control" id="message" placeholder="Contact No" rows="4" required></textarea>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <button type="submit" class="btn btn-primary">Send Message!</button>
                </div>
              </form>
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