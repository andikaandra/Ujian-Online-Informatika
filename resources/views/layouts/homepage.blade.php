<!doctype html>
<html lang="en">
    <head>

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="img/favicon.png" type="image/png">
        <title>AMSW</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('homepage/css/bootstrap.css')}}">
        <link rel="stylesheet" href="{{asset('homepage/vendors/linericon/style.css')}}">
        <link rel="stylesheet" href="{{asset('homepage/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('homepage/vendors/owl-carousel/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('homepage/vendors/lightbox/simpleLightbox.css')}}">
        <link rel="stylesheet" href="{{asset('homepage/vendors/nice-select/css/nice-select.css')}}">
        <link rel="stylesheet" href="{{asset('homepage/vendors/animate-css/animate.css')}}">
        
        <!-- main css -->
        <link rel="stylesheet" href="{{asset('homepage/css/style.css')}}">
        <link rel="stylesheet" href="{{asset('homepage/css/responsive.css')}}">
    </head>
    <body>
        
        <!--================Header Menu Area =================-->
            @include('includes.homepage.header')
		<!--================Header Menu Area =================-->
		

		<div class="app">
			@yield('content')

		</div>
        
        
        
        <!--================ start footer Area  =================-->	
        @include('includes.homepage.footer')
		<!--================ End footer Area  =================-->
        
        
        
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="{{asset('homepage/js/jquery-3.2.1.min.js')}}"></script>
        <script src="{{asset('homepage/js/popper.js')}}"></script>
        <script src="{{asset('homepage/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('homepage/js/stellar.js')}}"></script>
        <script src="{{asset('homepage/vendors/lightbox/simpleLightbox.min.js')}}"></script>
        <script src="{{asset('homepage/vendors/nice-select/js/jquery.nice-select.min.js')}}"></script>
        <script src="{{asset('homepage/vendors/isotope/imagesloaded.pkgd.min.js')}}"></script>
        <script src="{{asset('homepage/vendors/isotope/isotope-min.js')}}"></script>
        <script src="{{asset('homepage/vendors/owl-carousel/owl.carousel.min.js')}}"></script>
        <script src="{{asset('homepage/js/jquery.ajaxchimp.min.js')}}"></script>
        <script src="{{asset('homepage/vendors/counter-up/jquery.waypoints.min.js')}}"></script>
        <script src="{{asset('homepage/vendors/counter-up/jquery.counterup.js')}}"></script>
        <script src="{{asset('homepage/js/mail-script.js')}}"></script>
        <script src="{{asset('homepage/js/theme.js')}}"></script>
    </body>
</html>