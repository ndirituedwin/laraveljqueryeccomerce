<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>My amazon eccomerce</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="csrf-token" content="{{ csrf_token() }}"/>
	
	<!-- Front style -->
	
	<link id="callCss" rel="stylesheet" href="{{asset('frontend/themes/css/front.min.css')}}" media="screen"/>
	<link id="callCss" rel="stylesheet" href="{{asset('frontend/themes/css/backo.min.css')}}" media="screen"/>
	<link href="{{asset('frontend/themes/css/base.css')}}" rel="stylesheet" media="screen"/>
	<!-- Front style responsive -->
	<link href="{{asset('frontend/themes/css/front-responsive.min.css')}}" rel="stylesheet"/>
	<link href="{{asset('frontend/themes/css/font-awesome.css')}}" rel="stylesheet" type="text/css">


	<style type="text/css" id="enject"></style>
</head>
<body>
@include('Frontend.frontendlayout.header')
<!-- Header End====================================================================== -->
@include('Frontend.banners.homepagebanners')
<div id="mainBody">
	<div class="container">
		<div class="row">
			<!-- Sidebar ================================================== -->
			   <div class="col-md-3">
		            @include('Frontend.frontendlayout.sidebar')
			   </div>
			   
					<!-- Sidebar end=============================================== -->
	<div class="col-md-9">
					@yield('content')
		</div>
	</div>
	</div>
</div>
<!-- Footer ================================================================== -->
@include('Frontend.frontendlayout.footer')


<!-- Placed at the end of the document so the pages load faster ============================================= -->
<script src="{{asset('frontend/themes/js/jquery.js')}}" type="text/javascript"></script>
<script src="{{asset('frontend/themes/js/front.min.js')}}" type="text/javascript"></script>
<script src="{{asset('frontend/themes/js/google-code-prettify/prettify.js')}}"></script>

<script src="{{asset('frontend/themes/js/front.js')}}"></script>
<script src="{{asset('frontend/themes/js/frontscript.js')}}"></script>
<script src="{{asset('frontend/themes/js/jquery.lightbox-0.5.js')}}"></script>
<!--sweet alert2-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{asset('adminlte/sweetalert2.min.js')}}"></script>

</body>
</html>