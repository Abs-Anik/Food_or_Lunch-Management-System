<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'User Dashboard')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('public/frontend/assets/images/8.png')}}">
    @include('frontend.layouts.partials.style')
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        @include('frontend.layouts.partials.leftsidebar')

        <!-- top navigation -->
        @include('frontend.layouts.partials.header')
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
        @yield('user-main')
        </div>
        <!-- /page content -->

        <!-- footer content -->
        @include('frontend.layouts.partials.footer')
        <!-- /footer content -->
      </div>
    </div>

    @include('frontend.layouts.partials.script')

  </body>
</html>
