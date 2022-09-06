<!DOCTYPE html>
<html lang="en">
<head>
	<title>FC Skill</title>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="{{ asset('favicon.png') }}">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Maven+Pro:400,500,700|Nunito:400,600,700" rel="stylesheet">

	<!-- FontAwesome JS-->
	<script defer src="{{ asset('landing_assets/landing_assets/fontawesome/js/all.min.js') }}"></script>

	<!-- Plugins CSS -->
	<link rel="stylesheet" href="{{ asset('landing_assets/plugins/flickity/flickity.min.css') }}">

	<!-- Theme CSS -->
	<link id="theme-style" rel="stylesheet" href="{{ asset('landing_assets/css/theme.css') }}">

</head>

<body style="background-image: url('landing_assets/images/logos/BgImage.png');">

	<header class="header">

		<div class="branding">

			<div class="container position-relative">

				<nav class="navbar navbar-expand-lg" >

					<h1 class="site-logo">
						<a class="navbar-brand" href="/" >
							<img class="logo-icon" src="{{ asset('landing_assets/images/logos/fcskill.png') }}" alt="logo" style="width: 150px;">
						</a>
					</h1>

					<!-- // Free Version ONLY -->
					<ul class="social-list list-inline mb-0 position-absolute">
						<li class="list-inline-item"><a class="text-dark" href="#"><i class="fab fa-twitter fa-fw"></i></a></li>
						<li class="list-inline-item"><a class="text-dark" href="#"><i class="fab fa-facebook-f fa-fw"></i></a></li>
						<li class="list-inline-item"><a class="text-dark" href="#"><i class="fab fa-instagram fa-fw"></i></a></li>
					</ul><!--//social-list-->

				</nav>

				<!-- // Free Version ONLY -->
				<ul class="social-list list-inline mb-0 position-absolute d-none">
					<li class="list-inline-item"><a class="text-dark" href="#"><i class="fab fa-twitter fa-fw"></i></a></li>
					<li class="list-inline-item"><a class="text-dark" href="#"><i class="fab fa-facebook-f fa-fw"></i></a></li>
					<li class="list-inline-item"><a class="text-dark" href="#"><i class="fab fa-instagram fa-fw"></i></a></li>
					<li class="list-inline-item"><a class="text-dark" href="#"><i class="fab fa-youtube fa-fw"></i></a></li>
				</ul><!--//social-list-->
			</div><!--//container-->
		</div><!--//branding-->
	</header><!--//header-->


	<section class="hero-section">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-12 pt-3 pt-md-4" style="background-color: white;">
					{!! $data->meta_value !!}
				</div>
			</div><!--//row-->
		</div>
	</section><!--//hero-section-->


	<footer class="footer theme-bg-primary" style="background-color:#f4f6fc;">

		<div class="footer-bottom text-center pb-5 pt-5" >
			<p><a href="{{ route('home') }}"> Home </a></p>
			<p>Copyright © {{ date('Y') }}. All Rights Reserved.</p>
		<!--	<small class="copyright">Designed with <span class="sr-only"></span><i class="fas fa-heart" style="color: #fb866a;"></i> by <a href="https://atozlogics.com/" target="_blank">https://atozlogics.com</a> for FCskill</small>  -->
		</div>

	</footer>


	<!-- Javascript -->
	<script type="text/javascript" src="{{ asset('landing_assets/plugins/popper.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('landing_assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('landing_assets/plugins/flickity/flickity.pkgd.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('landing_assets/js/main.js') }}"></script>


</body>
</html>

