<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    {{--    <title>Login &mdash; {{ $settings->name }}</title>--}}
    <meta name="description" content="Login Page" />
    <!-- Font Tags Start -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset("assets/font/CS-Interface/style.css") }}" />
    <!-- Font Tags End -->
    <!-- Vendor Styles Start -->
    <link rel="stylesheet" href="{{ asset("assets/css/vendor/bootstrap.min.css") }}" />
    <link rel="stylesheet" href="{{asset("assets/css/vendor/OverlayScrollbars.min.css")}}" />

    <!-- Vendor Styles End -->
    <!-- Template Base Styles Start -->
    <link rel="stylesheet" href="{{ asset("assets/css/styles.css") }}" />
    <!-- Template Base Styles End -->

    <link rel="stylesheet" href="{{ asset("assets/css/main.css") }}" />
    <script src="{{ asset("assets/js/base/loader.js") }}"></script>
</head>

<body class="h-100">
<div id="root">

    @include('admin2.partials.navigation')

    <main>
        <div class="container">

            @yield('main')

        </div>
    </main>
</div>

@include('admin2.partials.theme-setting')

<!-- Vendor Scripts Start -->
<script src="{{asset('assets/js/vendor/jquery-3.5.1.min.js')}}"></script>
<script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/OverlayScrollbars.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/autoComplete.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/clamp.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/jquery.validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/jquery.validate/additional-methods.min.js') }}"></script>
<script src="{{ asset('assets/js/ajax-helper/admin/helper.js') }}"></script>
<!-- Vendor Scripts End -->

<!-- Template Base Scripts Start -->
<script src="{{ asset('assets/font/CS-Line/csicons.min.js') }}"></script>
<script src="{{ asset('assets/js/base/helpers.js') }}"></script>
<script src="{{ asset('assets/js/base/globals.js') }}"></script>
<script src="{{ asset('assets/js/base/nav.js') }}"></script>
<script src="{{ asset('assets/js/base/search.js') }}"></script>
<script src="{{ asset('assets/js/base/settings.js') }}"></script>
<script src="{{ asset('assets/js/base/init.js') }}"></script>
<!-- Template Base Scripts End -->
<!-- Page Specific Scripts Start -->
<script src="{{ asset('assets/js/pages/auth.login.js') }}"></script>
<script src="{{ asset('assets/js/common.js') }}"></script>
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<!-- Page Specific Scripts End -->
</body>
</html>
