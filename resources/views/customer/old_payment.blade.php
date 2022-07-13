@extends('customer.layout.app')

@section('title')
Subscription
@endsection

@section('styles')

@endsection

@section('content')
<section class="content-header">
  <h1>
    Subscription
    <small>Control panel</small>
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
        <form id="finalPay" method="post" action="{{route('subscription.payment')}}" enctype="multipart/form-data">
          @csrf
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                Redirecting To Payment...
              </div>
            </div>
          </div>
          <!-- /.box-body -->
        </form>
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div>
</section>
@endsection

@section('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script src="https://js.stripe.com/v3/"></script>
<script>
  document.addEventListener('DOMContentLoaded', async (e) => {
    const stripe = Stripe("<?= $_ENV['STRIPE_PUBLISHABLE_KEY']; ?>");
    // const submitButton = document.getElementById('submit');
    // submitButton.addEventListener('click', function(e) {
    //   e.preventDefault();
      stripe.redirectToCheckout({ sessionId: "<?= $checkout_session->id; ?>" });
    // });
  });
</script>
<script>
  // $(document).ready(function(e){
  //   $('#finalPay').submit();
  // });
</script>
@endsection