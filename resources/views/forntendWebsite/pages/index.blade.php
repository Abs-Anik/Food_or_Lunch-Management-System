<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <title>Food Corner</title>
      <meta content="" name="description">
      <meta content="" name="keywords">
      <!-- Favicons -->
      <link rel="icon" type="image/x-icon" href="{{ asset('public/frontend/assets/images/8.png')}}">
      <!-- Google Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
      <!-- Vendor CSS Files -->
      <link href="{{ asset('public/frontendWebsite/assets/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
      <link href="{{ asset('public/frontendWebsite/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{ asset('public/frontendWebsite/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
      <link href="{{ asset('public/frontendWebsite/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
      <link href="{{ asset('public/frontendWebsite/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
      <link href="{{ asset('public/frontendWebsite/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
      <link href="{{ asset('public/frontendWebsite/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
      <!-- Template Main CSS File -->
      <link href="{{ asset('public/frontendWebsite/assets/css/style.css')}}" rel="stylesheet">
      <!-- =======================================================
         * Template Name: Hidayah - v4.5.0
         * Template URL: https://bootstrapmade.com/hidayah-free-simple-html-template-for-corporate/
         * Author: BootstrapMade.com
         * License: https://bootstrapmade.com/license/
         ======================================================== -->
   </head>
   <body>
      <!-- ======= Hero Section ======= -->
      <section id="hero">
         <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <!-- <ol class="carousel-indicators" id="hero-carousel-indicators"></ol> -->
            <div class="carousel-inner" role="listbox">
               <!-- Slide 1 -->
               <div class="carousel-item active" style="background-image: url('{{ asset('public/frontendWebsite/assets/img/slide/slide_1.jpg')}}');">
                  <div class="carousel-container">
                     <div class="container">
                        <h1 class="logo"><b>F<span>oo</span>d<span>C</span><span>or</span>ner</b></h1>
                        @if (auth()->check() && auth()->user()->is_admin == 1)
                        <a href="{{route('admin.dashboard.index')}}" id="link" class="mt-2">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            Take Your Food
                        </a>
                        @elseif (auth()->check() && auth()->user()->is_admin == 0)
                        <a href="{{route('user.dashboard.index')}}" id="link" class="mt-2">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            Take Your Food
                        </a>
                        @else
                        <a href="{{route('login')}}" id="link" class="mt-2">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            Take Your Food
                        </a>
                        @endif

                     </div>
                  </div>
               </div>
               <!-- Slide 2 -->
               <div class="carousel-item" style="background-image: url('{{ asset('public/frontendWebsite/assets/img/slide/slide_2.jpg')}}');">
                  <div class="carousel-container">
                     <div class="container">
                        <h1 class="logo"><b>F<span>oo</span>d<span>C</span><span>or</span>ner</b></h1>
                        <a href="{{route('login')}}" id="link" class="mt-2">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        Take Your Food
                        </a>
                     </div>
                  </div>
               </div>
               <!-- Slide 3 -->
               <div class="carousel-item" style="background-image: url('{{ asset('public/frontendWebsite/assets/img/slide/slide_3.jpeg')}}');">
                  <div class="carousel-container">
                     <div class="container">
                        <h1 class="logo"><b>F<span>oo</span>d<span>C</span><span>or</span>ner</b></h1>
                        <a href="{{route('login')}}" id="link" class="mt-2">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        Take Your Food
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- End Hero -->
      <div id="preloader"></div>
      <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
      <!-- Vendor JS Files -->
      <script src="{{ asset('public/frontendWebsite/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
      <script src="{{ asset('public/frontendWebsite/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
      <script src="{{ asset('public/frontendWebsite/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
      <script src="{{ asset('public/frontendWebsite/assets/vendor/php-email-form/validate.js')}}"></script>
      <script src="{{ asset('public/frontendWebsite/assets/vendor/purecounter/purecounter.js')}}"></script>
      <script src="{{ asset('public/frontendWebsite/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
      <script src="{{ asset('public/frontendWebsite/assets/vendor/waypoints/noframework.waypoints.js')}}"></script>
      <!-- Template Main JS File -->
      <script src="{{ asset('public/frontendWebsite/assets/js/main.js')}}"></script>
   </body>
</html>
