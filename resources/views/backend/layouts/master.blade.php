<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Lunch Management System')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('public/frontend/assets/images/lunch.png')}}">
    @include('backend.layouts.partials.style')
    @yield('custom_css')
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        @include('backend.layouts.partials.leftsidebar')
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        @yield('main-content')
        <!-- main content area end -->
        <!-- footer area start-->
        @include('backend.layouts.partials.footer')
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
    <!-- offset area start -->
    <!-- offset area end -->
    @include('backend.layouts.partials.script')
    @yield('scripts')
</body>

</html>
