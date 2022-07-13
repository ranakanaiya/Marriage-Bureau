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
			background-color: transparent!important;
		  border-color: transparent!important;
		}
    .goog-te-menu-value {
        color: rgba(255, 255, 255, 0.90)!important;
		    background-color: transparent!important;
		    border-color: transparent!important;
    }
    .goog-te-gadget-icon {
    	display: none;
    }
    .modal {
    	z-index: 2250;
    }
    .menu-1 a {
    	cursor: pointer;
    }
    .display-tc p {
    	color: white;
    }
    .fh5co-heading h3{
    	color: white;
    }
    .fh5co-heading {
    	margin-bottom: 0px;
    }
    #fh5co-event {
    	height: auto;
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
				<div class="col-xs-3">
					<div id="fh5co-logo"><a href="index.html">Rana Marriage Bureau</a></div>
				</div>
				<div class="col-xs-7 text-right menu-1">
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
						<li><a href="{{route('landing.aboutus')}}">About Us</a></li>
						<li><a href="{{route('landing.contactus')}}">Contact Us</a></li>
						<li><a href="{{asset('')}}#fh5co-started">Sign Up</a></li>
						<li><a onclick="signinModal()">Sign In</a></li>
						<li><a href="{{route('forgot-password')}}">Forgot Password</a></li>
					</ul>
				</div>
				<div class="col-xs-2">
					<div id="google_translate_element"></div>
				</div>
			</div>
			
		</div>
	</nav>

	<header id="fh5co-header" class="fh5co-cover" role="banner" style="background-image:url(frontend_assets/images/img_bg_2.jpg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<div class="display-t">
						<div class="display-tc animate-box" data-animate-effect="fadeIn">
							<h1>Find Your Perfect Match</h1>
							<h2>Rana Marriage Bureau is an independant organization operating for all caste from around 15 years. As a part of woman empowerment, Rana Marriage Bureau provides service to find marital perfect match, which is <strong>FREE</strong> for woman and ₹ 205 for man.</h2>
							<!-- <div class="simply-countdown simply-countdown-one"></div> -->
							<p><a href="#fh5co-started" class="btn btn-default btn-sm">Sign Up</a> OR <a onclick="signinModal()" class="btn btn-default btn-sm">Sign In</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<div id="fh5co-couple">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box">
					<h2>Hello!</h2>
					<h3>November 28th, 2016</h3>
					<p>Finding your soulmate will never be too early or late. Best to start today or infact NOW.</p>
				</div>
			</div>
			<div class="couple-wrap animate-box">
				<div class="couple-half">
					<div class="groom">
						<img src="{{asset('/assets/img/user/male.png')}}" alt="groom" class="img-responsive">
					</div>
					<div class="desc-groom">
						<h3>Mr. Groom</h3>
						<p>Love recognizes no barriers. It jumps hurdles, leaps fences, penetrates walls to arrive at its destination full of hope.</p>
					</div>
				</div>
				<p class="heart text-center"><i class="icon-heart2"></i></p>
				<div class="couple-half">
					<div class="bride">
						<img src="{{asset('/assets/img/user/female.png')}}" alt="bride" class="img-responsive">
					</div>
					<div class="desc-bride">
						<h3>Ms. Bride</h3>
						<p>You know you’re in love when you can’t fall asleep because reality is finally better than your dreams</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="fh5co-event" class="fh5co-bg" style="background:url(/frontend_assets/images/img_bg_3.jpg) center;" >
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box">
					<span>Our Special Events</span>
					<h2>Events</h2>
					<h3>Coming Soon...</h3>
				</div>
			</div>
			{{-- <div class="row">
				<div class="display-t">
					<div class="display-tc">
						<div class="col-md-10 col-md-offset-1">
							<div class="col-md-6 col-sm-6 text-center">
								<div class="event-wrap animate-box">
									<h3>Gathering</h3>
									<div class="event-col">
										<i class="icon-clock"></i>
										<span>4:00 PM</span>
										<span>6:00 PM</span>
									</div>
									<div class="event-col">
										<i class="icon-calendar"></i>
										<span>Monday 28</span>
										<span>November, 2016</span>
									</div>
									<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 text-center">
								<div class="event-wrap animate-box">
									<h3>Gathering</h3>
									<div class="event-col">
										<i class="icon-clock"></i>
										<span>7:00 PM</span>
										<span>12:00 AM</span>
									</div>
									<div class="event-col">
										<i class="icon-calendar"></i>
										<span>Monday 28</span>
										<span>November, 2016</span>
									</div>
									<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> --}}
		</div>
	</div>

	<div id="fh5co-couple-story">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box">
					<span>Steps to follow</span>
					<h2>Process</h2>
					<p>Just following 3 steps to get started.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-md-offset-0">
					<ul class="timeline animate-box">
						<li class="animate-box">
							<div class="timeline-badge" style="background-image:url(frontend_assets/images/process1.png);"></div>
							<div class="timeline-panel">
								<div class="timeline-heading">
									<h3 class="timeline-title">Sign Up</h3>
									<!-- <span class="date">December 25, 2015</span> -->
								</div>
								<div class="timeline-body">
									<p>This step will required your email id to verify and let you know about new match found based on your prefences.</p>
								</div>
							</div>
						</li>
						<li class="timeline-inverted animate-box">
							<div class="timeline-badge left" style="background-image:url(frontend_assets/images/process2.png);"></div>
							<div class="timeline-panel">
								<div class="timeline-heading">
									<h3 class="timeline-title">Profile Setup</h3>
									<!-- <span class="date">December 28, 2015</span> -->
								</div>
								<div class="timeline-body">
									<p>To find soul-mate for you. We do required to know about you so that we can guerentee your perfect match. Thats the reason for profile picture. Take one and attractive Photo, some good description of profile etc.</p>
								</div>
							</div>
						</li>
						<li class="animate-box">
							<div class="timeline-badge" style="background-image:url(frontend_assets/images/process3.png);"></div>
							<div class="timeline-panel">
								<div class="timeline-heading">
									<h3 class="timeline-title">Payment</h3>
									<!-- <span class="date">January 1, 2016</span> -->
								</div>
								<div class="timeline-body">
									<p>Manage those wonderful couples and singles profile is too tough job. For that we takes cheaper fees <strong>(<i class="fa fa-rupee-sign"></i> 205)</strong> but for girls, its absolutely <strong>FREE</strong>. </p>
								</div>
							</div>
						</li>
			    	</ul>
				</div>
			</div>
		</div>
	</div>

	<!-- <div id="fh5co-gallery" class="fh5co-section-gray">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box">
					<span>Our Memories</span>
					<h2>Wedding Gallery</h2>
					<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
				</div>
			</div>
			<div class="row row-bottom-padded-md">
				<div class="col-md-12">
					<ul id="fh5co-gallery-list">
						
						<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(images/gallery-1.jpg); "> 
						<a href="images/gallery-1.jpg">
							<div class="case-studies-summary">
								<span>14 Photos</span>
								<h2>Two Glas of Juice</h2>
							</div>
						</a>
					</li>
					<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(images/gallery-2.jpg); ">
						<a href="#" class="color-2">
							<div class="case-studies-summary">
								<span>30 Photos</span>
								<h2>Timer starts now!</h2>
							</div>
						</a>
					</li>


					<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(images/gallery-3.jpg); ">
						<a href="#" class="color-3">
							<div class="case-studies-summary">
								<span>90 Photos</span>
								<h2>Beautiful sunset</h2>
							</div>
						</a>
					</li>
					<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(images/gallery-4.jpg); ">
						<a href="#" class="color-4">
							<div class="case-studies-summary">
								<span>12 Photos</span>
								<h2>Company's Conference Room</h2>
							</div>
						</a>
					</li>

						<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(images/gallery-5.jpg); ">
							<a href="#" class="color-3">
								<div class="case-studies-summary">
									<span>50 Photos</span>
									<h2>Useful baskets</h2>
								</div>
							</a>
						</li>
						<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(images/gallery-6.jpg); ">
							<a href="#" class="color-4">
								<div class="case-studies-summary">
									<span>45 Photos</span>
									<h2>Skater man in the road</h2>
								</div>
							</a>
						</li>

						<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(images/gallery-7.jpg); ">
							<a href="#" class="color-4">
								<div class="case-studies-summary">
									<span>35 Photos</span>
									<h2>Two Glas of Juice</h2>
								</div>
							</a>
						</li>

						<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(images/gallery-8.jpg); "> 
							<a href="#" class="color-5">
								<div class="case-studies-summary">
									<span>90 Photos</span>
									<h2>Timer starts now!</h2>
								</div>
							</a>
						</li>
						<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(images/gallery-9.jpg); ">
							<a href="#" class="color-6">
								<div class="case-studies-summary">
									<span>56 Photos</span>
									<h2>Beautiful sunset</h2>
								</div>
							</a>
						</li>
					</ul>		
				</div>
			</div>
		</div>
	</div> -->

	<div id="fh5co-counter" class="fh5co-bg fh5co-counter" style="background:url(frontend_assets/images/background1.png) center;">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="display-t">
					<div class="display-tc">
						<div class="col-md-3 col-sm-6 animate-box">
							<div class="feature-center">
								<span class="icon">
									<i class="icon-users"></i>
								</span>

								<span class="counter js-counter" data-from="0" data-to="500" data-speed="5000" data-refresh-interval="50">1</span>
								<span class="counter-label">Males</span>

							</div>
						</div>
						<div class="col-md-3 col-sm-6 animate-box">
							<div class="feature-center">
								<span class="icon">
									<i class="icon-user"></i>
								</span>

								<span class="counter js-counter" data-from="0" data-to="1000" data-speed="5000" data-refresh-interval="50">1</span>
								<span class="counter-label">Females</span>
							</div>
						</div>
						<div class="col-md-3 col-sm-6 animate-box">
							<div class="feature-center">
								<span class="icon">
									<i class="icon-calendar"></i>
								</span>
								<span class="counter js-counter" data-from="0" data-to="402" data-speed="5000" data-refresh-interval="50">1</span>
								<span class="counter-label">Happy Couples</span>
							</div>
						</div>
						<div class="col-md-3 col-sm-6 animate-box">
							<div class="feature-center">
								<span class="icon">
									<i class="icon-clock"></i>
								</span>

								<span class="counter js-counter" data-from="0" data-to="2345" data-speed="5000" data-refresh-interval="50">1</span>
								<span class="counter-label">Visitors</span>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="fh5co-testimonial">
		<div class="container">
			<div class="row">
				<div class="row animate-box">
					<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
						<span>Reviews from Our Successful Pair</span>
						<h2>Reviews</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 animate-box">
						<div class="wrap-testimony">
							<div class="owl-carousel-fullwidth">
								<div class="item">
									<div class="testimony-slide active text-center">
										<figure>
											<img {{-- src="images/couple-1.jpg" --}} alt="user">
										</figure>
										<span>John Doe, via <a href="#" class="twitter">Twitter</a></span>
										<blockquote>
											<p>"Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics"</p>
										</blockquote>
									</div>
								</div>
								<div class="item">
									<div class="testimony-slide active text-center">
										<figure>
											<img {{-- src="images/couple-2.jpg" --}} alt="user">
										</figure>
										<span>John Doe, via <a href="#" class="twitter">Twitter</a></span>
										<blockquote>
											<p>"Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, at the coast of the Semantics, a large language ocean."</p>
										</blockquote>
									</div>
								</div>
								<div class="item">
									<div class="testimony-slide active text-center">
										<figure>
											<img {{-- src="images/couple-3.jpg" --}} alt="user">
										</figure>
										<span>John Doe, via <a href="#" class="twitter">Twitter</a></span>
										<blockquote>
											<p>"Far far away, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean."</p>
										</blockquote>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="fh5co-services" class="fh5co-section-gray">
		<div class="container">
			
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<h2>We Offer Services</h2>
					<p>Our Clients are too important for us. Along with match finding we also provides following services <strong>FREE</strong> for you.</p>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="feature-left animate-box" data-animate-effect="fadeInLeft">
						<span class="icon">
							<i class="icon-calendar"></i>
						</span>
						<div class="feature-copy">
							<h3>Meeting Arrangment</h3>
							<p>We help you to fix meeting when its difficult to even talk and help you to start with warm welcome.</p>
						</div>
					</div>

					<div class="feature-left animate-box" data-animate-effect="fadeInLeft">
						<span class="icon">
							<i class="icon-image"></i>
						</span>
						<div class="feature-copy">
							<h3>Support as Moderator</h3>
							<p>To provide smoother communication at beginning, we act as moderator to help you in your journey. </p>
						</div>
					</div>

					{{-- <div class="feature-left animate-box" data-animate-effect="fadeInLeft">
						<span class="icon">
							<i class="icon-video"></i>
						</span>
						<div class="feature-copy">
							<h3>Video Editing</h3>
							<p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci architecto culpa amet.</p>
						</div>
					</div> --}}

				</div>

				<div class="col-md-6 animate-box">
					<div class="fh5co-video fh5co-bg" {{-- style="background-image: url(images/img_bg_3.jpg); " --}}>
						<!-- <a href="https://www.youtube.com/embed/fiH1ZDF2cXQ" class="popup-vimeo"><i class="icon-video2"></i></a>
						<div class="overlay"></div> -->
						<iframe width="560" height="315" src="https://www.youtube.com/embed/kFBTDLMAVkQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</div>
				</div>
			</div>

			
		</div>
	</div>


	<div id="fh5co-started" class="fh5co-bg" style="background-image:url(frontend_assets/images/background2.png);">
		<div class="overlay"></div>
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<h2>Are You Ready to Find your perfect Match?</h2>
					<p>Please Fill-up the form to notify us that you're ready and we should start to find ASAP. Thanks.</p>
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
							<div class="col-md-4 col-sm-12">
								<div class="form-group">
									<label for="email" class="sr-only">Email</label>
									<input type="email" name="email" class="form-control" id="email" placeholder="Email">
								</div>
							</div>
							<div class="col-md-4 col-sm-12">
								<div class="form-group">
									<label for="password" class="sr-only">Password</label>
									<input type="password" name="password" class="form-control" id="password" placeholder="Password">
								</div>
							</div>
							<div class="col-md-4 col-sm-12">
								<div class="form-group">
									<label for="password_confirmation" class="sr-only">Confirm Password</label>
									<input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm Password">
								</div>
							</div>
							<div class="col-md-4 col-sm-12"></div>
							<div class="col-md-4 col-sm-12">
								<button type="submit" class="btn btn-default btn-block">Yes! Lets do this!</button>
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
	<script src="{{asset('assets/dist/js/er_loader.js')}}"></script>
	<!-- Main -->
	<script src="{{asset('frontend_assets/js/main.js')}}"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script>
		$(document).ready(function(e){
			@if(Session::Has('message'))
			swal("{{Session::get('message')}}!", {
                icon: "{{Session::get('status')}}",
              });
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

    $(document).ready(function(){
    	$('#fh5co-offcanvas').click(function(e){
    		console.log('cliked');
    		$('.fh5co-nav-toggle').trigger('click');
    	});
    });

    function signinModal()
    {
    	$('#signinModal').delay('500').modal('show');
    }
</script>

	</body>
</html>

