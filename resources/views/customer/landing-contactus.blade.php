<!DOCTYPE html>
<html class="no-js" lang="en">
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Rana Marriage Bureau</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Rana marriage Bureau will find your perfect match, join us if you are ready..." />
	<meta name="keywords" content="marriage,couples,pair,love,lifestyle" />
	<meta name="author" content="Kanaiya" />
	<link rel="icon" href="{{asset('assets/img/rm_logo.png')}}" type="image/icon type">

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href='https://fonts.googleapis.com/css?family=Work+Sans:400,300,600,400italic,700' rel='stylesheet' type='text/css'>
	<link href="https://fonts.googleapis.com/css?family=Sacramento" rel="stylesheet">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

	
	<!-- Animate.css -->
	<link rel="stylesheet" href="{{asset('/frontend_assets/css/animate.css')}}">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="{{asset('/frontend_assets/css/icomoon.css')}}">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="{{asset('/frontend_assets/css/bootstrap.css')}}">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="{{asset('/frontend_assets/css/magnific-popup.css')}}">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="{{asset('/frontend_assets/css/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{asset('/frontend_assets/css/owl.theme.default.min.css')}}">

	<!-- Theme style  -->
	<link rel="stylesheet" href="{{asset('/frontend_assets/css/style.css')}}">
	<link rel="stylesheet" href='{{asset('/assets/dist/css/er_loader.css')}}'>

	<style>
		html .goog-te-gadget-simple {
			margin-top: 2px;
			background-color: #999!important;
		  border-color: #999!important;
		}
    .goog-te-menu-value {
        color: rgba(255, 255, 255, 0.90)!important;
		    background-color: #999!important;
		    border-color: #999!important;
    }
    .goog-te-gadget-icon {
    	display: none;
    }
    .forgotpassword-container {
    	margin-top: 90px;
    }
	</style>
	<script>
	function googleTranslateElementInit() {
	  new google.translate.TranslateElement({
	    pageLanguage: 'en',
	    multilanguagePage: true,
	    layout: google.translate.TranslateElement.InlineLayout.SIMPLE
	  }, 'google_translate_element');
	}
	</script>
	<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

	<!-- Modernizr JS -->
	<script src="{{asset('/frontend_assets/js/modernizr-2.6.2.min.js')}}"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-52NKW8ZNC5"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-52NKW8ZNC5');
</script>

	</head>
	<body>
	<div id="er-loader" class="er-loader">
		<div class="er-loader-text">
			Loading...
		</div>
	</div>
		
	<div class="fh5co-loader"></div>
	
	<div id="page">
	<nav class="fh5co-nav" role="navigation">
		<div class="container">
			<div class="row">
				<div class="col-xs-5">
					<div id="fh5co-logo"><a href="index.html">Rana Marriage Bureau<strong>.</strong></a></div>
				</div>
				<div class="col-xs-5 text-right menu-1">
					<ul>
						{{-- <li class="active"><a href="index.html">Home</a></li>
						<li><a href="about.html">Story</a></li>
						<li class="has-dropdown">
							<a href="services.html">Services</a>
							<ul class="dropdown">
								<li><a href="#">Web Design</a></li>
								<li><a href="#">eCommerce</a></li>
								<li><a href="#">Branding</a></li>
								<li><a href="#">API</a></li>
							</ul>
						</li>
						<li class="has-dropdown">
							<a href="gallery.html">Gallery</a>
							<ul class="dropdown">
								<li><a href="#">HTML5</a></li>
								<li><a href="#">CSS3</a></li>
								<li><a href="#">Sass</a></li>
								<li><a href="#">jQuery</a></li>
							</ul>
						</li> --}}
						{{-- <li><a href="contact.html">Contact</a></li> --}}
						<li><a href="{{route('home')}}">Home</a></li>
					</ul>
				</div>
				<div class="col-xs-2">
					<div id="google_translate_element"></div>
				</div>
			</div>
			
		</div>
	</nav>

<div id="signinModal" class="modal fade text-white bg-grey" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="background: rgba(0, 0, 0, 0.5);">
      <div class="modal-header" style="border-bottom: none;">
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-white">Sign In</h4>
      </div>
      <form action="{{route('login')}}" method="post">
      	@csrf
      <div class="modal-body">
      	<div class="row">
	        <div class="col-md-12 col-sm-12">
				<div class="form-group">
					<label for="email" class="sr-only">Email</label>
					<input type="email" name="email" class="form-control text-white" id="emailLogin" placeholder="Email">
				</div>
			</div>
			<div class="col-md-12 col-sm-12">
				<div class="form-group">
					<label for="password" class="sr-only">Password</label>
					<input type="password" name="password" class="form-control text-white" id="passwordLogin" placeholder="Password">
					{{-- New here! <a class="my-anchor" href="" alt="Sign Up">Click me</a> to fresh start your journey. --}}
				</div>
			</div>
			<div class="col-md-4 col-sm-12 pull-right">
				<button type="submit" class="btn btn-custom btn-block">Login!</button>
			</div>
		</div>
      </div>
  	  </form>
      {{-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> --}}
    </div>

  </div>
</div>

	<div id="fh5co-started" class="fh5co-bg" {{-- style="background-image:url(images/img_bg_4.jpg);" --}}>
		<div class="overlay"></div>
		<div class="container forgotpassword-container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<h2>Contact Us</h2>
					<p>We likes to hear from you :)</p>
				</div>
			</div>
			<div class="row animate-box">
				<form method="post">
					@csrf
					<div class="col-md-10 col-md-offset-1">
						<form class="form-inline">
							<!-- <div class="col-md-4 col-sm-4">
								<div class="form-group">
									<label for="name" class="sr-only">Name</label>
									<input type="name" class="form-control" id="name" placeholder="Name">
								</div>
							</div> -->
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
									<textarea name="message" class="form-control" id="message" placeholder="Message" rows="4" required></textarea>
								</div>
							</div>
							<div class="col-md-12">
								<button type="submit" class="btn btn-default btn-block">Send Message!</button>
							</div>
						</form>
					</div>
				</form>
			</div>
		</div>
	</div>

	<footer id="fh5co-footer" role="contentinfo">
		<div class="container">

			<div class="row copyright">
				<div class="col-md-12 text-center">
					<p>
						<small class="block">&copy; 2004 Rana Marriage Bureau. All Rights Reserved. <a href="{{route('landing.termsandconditions')}}">Terms And Conditions</a> | <a href="{{route('landing.privacypolicy')}}">Privacy Policy</a> | <a href="{{route('landing.refundpolicy')}}">Refund Policy</a></small>
						<small class="block">Designed and Developed By <a href="mailto:ranakanaiya1996@gmail.com" target="_blank">Kanaiya Rana</a></small>
					</p>
					<p>
						<ul class="fh5co-social-icons">
							<li><a title="twitter" href="#"><i class="icon-twitter"></i></a></li>
							<li><a title="facebook" href="#"><i class="icon-facebook"></i></a></li>
							<li><a title="linkedin" href="#"><i class="icon-linkedin"></i></a></li>
							<li><a title="dribble" href="#"><i class="icon-dribbble"></i></a></li>
						</ul>
					</p>
				</div>
			</div>

		</div>
	</footer>
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="{{asset('frontend_assets/js/jquery.min.js')}}"></script>
	<!-- jQuery Easing -->
	<script src="{{asset('frontend_assets/js/jquery.easing.1.3.js')}}"></script>
	<!-- Bootstrap -->
	<script src="{{asset('frontend_assets/js/bootstrap.min.js')}}"></script>
	<!-- Waypoints -->
	<script src="{{asset('frontend_assets/js/jquery.waypoints.min.js')}}"></script>
	<!-- Carousel -->
	<script src="{{asset('frontend_assets/js/owl.carousel.min.js')}}"></script>
	<!-- countTo -->
	<script src="{{asset('frontend_assets/js/jquery.countTo.js')}}"></script>

	<!-- Stellar -->
	<script src="{{asset('frontend_assets/js/jquery.stellar.min.js')}}"></script>
	<!-- Magnific Popup -->
	<script src="{{asset('frontend_assets/js/jquery.magnific-popup.min.js')}}"></script>
	<script src="{{asset('frontend_assets/js/magnific-popup-options.js')}}"></script>

	<!-- // <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/0.0.1/prism.min.js"></script> -->
	<script src="{{asset('frontend_assets/js/simplyCountdown.js')}}"></script>
	<!-- Main -->
	<script src="{{asset('frontend_assets/js/main.js')}}"></script>
	<script src="{{asset('assets/dist/js/er_loader.js')}}"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script>
		$(document).ready(function(e){
			@if(Session::Has('message'))
			swal(`{{Session::get('message')}}!`, {
                icon: "{{Session::get('status')}}",
              });
			@endif
			@if ($errors->any())
        
			    @foreach ($errors->all() as $error)
			        swal("{{$error}}!", {
                icon: "error",
              });
			    @endforeach
			@endif
		});
	</script>

	<script>
    var d = new Date(new Date().getTime() + 200 * 120 * 120 * 2000);

    // default example
    simplyCountdown('.simply-countdown-one', {
        year: d.getFullYear(),
        month: d.getMonth() + 1,
        day: d.getDate()
    });

    //jQuery example
    $('#simply-countdown-losange').simplyCountdown({
        year: d.getFullYear(),
        month: d.getMonth() + 1,
        day: d.getDate(),
        enableUtc: false
    });

</script>

	</body>
</html>

