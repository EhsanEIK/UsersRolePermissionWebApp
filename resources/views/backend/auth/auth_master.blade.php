<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('auth_title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    @include('backend.layouts.partial.style')
    @yield('style')
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

    <!-- login area start -->
        @yield('auth_content')
    <!-- login area end -->

    @include('backend.layouts.partial.script')
    @yield('script')
</body>

</html>