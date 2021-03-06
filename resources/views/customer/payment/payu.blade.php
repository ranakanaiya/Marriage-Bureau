@extends('customer.layout.app')

@section('title')
Subscription using PayU
@endsection

@section('styles')

@endsection

@section('content')
<section class="content-header">
  <h1>
    Subscription using PayU
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Subscription using PayU </li>
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
              <svg
                     xmlns:dc="http://purl.org/dc/elements/1.1/"
                     xmlns:cc="http://creativecommons.org/ns#"
                     xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                     xmlns:svg="http://www.w3.org/2000/svg"
                     xmlns="http://www.w3.org/2000/svg"
                     xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                     xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
                     version="1.1"
                     id="svg2"
                     xml:space="preserve"
                     height="60"
                     viewBox="0 0 385.61334 192.41333"
                     sodipodi:docname="PAYU_LOGO_LIME.eps"><metadata
                       id="metadata8"><rdf:RDF><cc:Work
                           rdf:about=""><dc:format>image/svg+xml</dc:format><dc:type
                             rdf:resource="http://purl.org/dc/dcmitype/StillImage" /></cc:Work></rdf:RDF></metadata><defs
                       id="defs6" /><sodipodi:namedview
                       pagecolor="#ffffff"
                       bordercolor="#666666"
                       borderopacity="1"
                       objecttolerance="10"
                       gridtolerance="10"
                       guidetolerance="10"
                       inkscape:pageopacity="0"
                       inkscape:pageshadow="2"
                       inkscape:window-width="640"
                       inkscape:window-height="480"
                       id="namedview4" /><g
                       id="g10"
                       inkscape:groupmode="layer"
                       inkscape:label="ink_ext_XXXXXX"
                       transform="matrix(1.3333333,0,0,-1.3333333,0,192.41333)"><g
                         id="g12"
                         transform="scale(0.1)"><path
                           d="m 2507.22,898.414 c -18.79,0 -34.01,15.234 -34,34.024 l 0.05,150.352 h -12.54 c -77.78,0 -106.71,-12.83 -106.71,-83.685 V 833.316 c -0.01,-0.351 -0.05,-0.703 -0.05,-1.054 v -36.34 c -0.02,-1.258 -0.1,-2.43 -0.1,-3.731 V 560.543 c 0,-28.293 -5.45,-50.82 -16.7,-68.32 -21.21,-32.676 -63.2,-47.532 -130.38,-47.618 -67.15,0.086 -109.13,14.93 -130.34,47.579 -11.28,17.507 -16.74,40.046 -16.74,68.359 v 231.648 c 0,1.301 -0.07,2.473 -0.09,3.731 v 36.34 c 0,0.351 -0.04,0.703 -0.05,1.054 v 165.789 c 0,70.855 -28.93,83.685 -106.71,83.685 h -24.49 c -77.79,0 -106.71,-12.83 -106.71,-83.685 V 832.262 656.723 560.543 c 0,-70.547 15.91,-130.281 46.65,-178.434 59.37,-93.3 174.38,-142.988 337.88,-142.988 0.2,0 0.4,0.008 0.6,0.008 0.21,0 0.4,-0.008 0.61,-0.008 163.5,0 278.51,49.688 337.88,142.988 30.74,48.153 46.65,107.887 46.65,178.434 v 96.18 175.539 66.121 l -84.71,0.031"
                           style="fill:#90cc23;fill-opacity:1;fill-rule:nonzero;stroke:none"
                           id="path14" /><path
                           d="m 2866.82,1140.67 -127.94,0.05 c -13.95,0 -25.26,11.32 -25.25,25.27 l 0.04,129.52 c 0.01,13.96 11.33,25.27 25.28,25.27 l 127.93,-0.05 c 13.96,0 25.27,-11.32 25.27,-25.28 l -0.05,-129.52 c 0,-13.95 -11.32,-25.26 -25.28,-25.26"
                           style="fill:#90cc23;fill-opacity:1;fill-rule:nonzero;stroke:none"
                           id="path16" /><path
                           d="m 2696.34,1320.76 -86.89,0.03 c -9.48,0.01 -17.16,7.69 -17.16,17.16 l 0.03,87.97 c 0.01,9.49 7.7,17.16 17.17,17.16 l 86.89,-0.03 c 9.48,0 17.16,-7.69 17.16,-17.17 l -0.03,-87.97 c -0.01,-9.48 -7.69,-17.15 -17.17,-17.15"
                           style="fill:#90cc23;fill-opacity:1;fill-rule:nonzero;stroke:none"
                           id="path18" /><path
                           d="m 496.59,815.961 c 0,-104.07 -26.574,-160.469 -166.75,-160.469 H 114.059 v 268.586 c 0,37.246 13.847,51.094 51.089,51.094 H 329.84 c 105.605,0 166.75,-26.055 166.75,-159.211 z M 329.84,1082.95 H 143.77 C 44.3438,1082.95 0.00390625,1038.6 0.00390625,939.164 V 300.512 C 0.00390625,262.102 12.332,249.77 50.7422,249.77 h 12.5742 c 38.4136,0 50.7426,12.332 50.7426,50.742 V 548.98 H 329.84 c 191.582,0 280.812,84.844 280.812,266.981 0,182.148 -89.23,266.989 -280.812,266.989"
                           style="fill:#90cc23;fill-opacity:1;fill-rule:nonzero;stroke:none"
                           id="path20" /><path
                           d="m 1012.01,536.82 v -87.547 c 0,-71.375 -26.455,-112.695 -161.721,-112.695 -89.359,0 -132.801,32.344 -132.801,98.863 0,72.954 43.578,101.379 155.434,101.379 z M 850.289,899.801 c -73.738,0 -119.949,-9.25 -137.476,-12.754 -31.036,-6.75 -44.012,-15.266 -44.012,-50.559 V 826.43 c 0,-13.828 2.047,-23.407 6.441,-30.145 5.113,-7.851 13.348,-11.836 24.488,-11.836 5.434,0 11.727,0.918 19.243,2.793 17.722,4.434 74.379,13.594 136.347,13.594 111.297,0 156.69,-30.832 156.69,-106.406 V 626.988 H 871.66 c -180.422,0 -264.461,-60.859 -264.461,-191.547 0,-126.761 86.778,-196.57 244.352,-196.57 187.249,0 270.749,63.719 270.749,206.633 V 694.43 c 0,138.191 -88.97,205.371 -272.011,205.371"
                           style="fill:#90cc23;fill-opacity:1;fill-rule:nonzero;stroke:none"
                           id="path22" /><path
                           d="m 1739.43,870.035 c -7.95,9.981 -22.98,11.356 -38.05,11.356 h -11.3 c -37.55,0 -52.28,-11.582 -60.59,-47.606 L 1525.15,400.078 c -13.02,-53.297 -31.32,-63.039 -62.63,-63.039 -38.34,0 -53.69,9.152 -68.97,63.25 l -118.18,433.699 c -9.78,36.328 -24.21,47.403 -61.77,47.403 h -10.06 c -15.16,0 -30.26,-1.395 -38.01,-11.504 -7.76,-10.125 -5.14,-25.235 -1.14,-40.086 L 1283.82,392.34 c 22.4,-83.719 49.03,-153.02 148.53,-153.02 18.57,0 35.75,2.578 50.04,7.399 -30.18,-94.91 -60.88,-136.77 -151.41,-146.071 -18.37,-1.5269 -30.31,-4.1597 -36.96,-13.0777 -6.91,-9.25 -5.34,-22.5 -2.87,-34.332 l 2.49,-11.2188 C 1299.04,16.0781 1308.25,0 1337.37,0 c 3.06,0 6.35,0.160156 9.88,0.460938 C 1482.43,9.30859 1554.86,82.0898 1597.24,251.66 l 144.62,578.453 c 3.43,14.844 5.5,29.95 -2.43,39.922"
                           style="fill:#90cc23;fill-opacity:1;fill-rule:nonzero;stroke:none"
                           id="path24" /><path
                           d="m 2679.57,1140.78 -172.26,0.06 c -18.79,0 -34.02,-15.23 -34.03,-34.02 l -0.01,-24.03 h 11.95 c 77.78,0 106.71,-12.83 106.71,-83.685 V 898.383 l 87.55,-0.028 c 18.79,-0.011 34.02,15.215 34.03,34.004 l 0.06,174.381 c 0,18.79 -15.22,34.03 -34,34.04"
                           style="fill:#90cc23;fill-opacity:1;fill-rule:nonzero;stroke:none"
                           id="path26" /></g></g>
                  </svg><br>
              <h4>Click pay to proceed and pay Rs 205.</h4>
              <form action='https://secure.payu.in/_payment' method='post'>
                <input type="hidden" name="key" value="{{ $key }}" />
                <input type="hidden" name="txnid" value="{{ $txnid }}" />
                <input type="hidden" name="productinfo" value="{{ $productInfo }}" />
                <input type="hidden" name="amount" value="{{ $amount }}" />
                <input type="hidden" name="email" value="{{ $email }}" />
                <input type="hidden" name="firstname" value="{{ $firstName }}" />
                <input type="hidden" name="lastname" value="" />
                <input type="hidden" name="surl" value="{{ route('subscription.plans.payu.success') }}" />
                <input type="hidden" name="furl" value="{{ route('subscription.plans.payu.fail') }}" />
                <input type="hidden" name="phone" value="{{ $phone }}" />
                <input type="hidden" name="udf1" value="{{ $udf1 }}">
                <input type="hidden" name="hash" value="{{ $hash }}" />
                <button type="submit" class="btn btn-primary">Pay</button>
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
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>

var rzp1 = new Razorpay(options);
document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
}
</script>
@endsection