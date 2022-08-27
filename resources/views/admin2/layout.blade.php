<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    {{--    <title>Login &mdash; {{ $settings->name }}</title>--}}
    <meta name="description" content="Login Page"/>
    <!-- Font Tags Start -->
    <link rel="preconnect" href="https://fonts.gstatic.com"/>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset("assets/font/CS-Interface/style.css") }}"/>
    <!-- Font Tags End -->
    <!-- Vendor Styles Start -->
    <link rel="stylesheet" href="{{ asset("assets/css/vendor/bootstrap.min.css") }}"/>
    <link rel="stylesheet" href="{{ asset("assets/css/vendor/OverlayScrollbars.min.css")}}"/>
    <link rel="stylesheet" href="{{ asset("assets/css/vendor/select2.min.css") }}"/>
    <link rel="stylesheet" href="{{ asset("assets/css/vendor/select2-bootstrap4.min.css") }}"/>
    <link href="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/modules/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/modules/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("assets/css/vendor/datatables.min.css") }}"/>
    <!-- Vendor Styles End -->
    <!-- Template Base Styles Start -->
    <link rel="stylesheet" href="{{ asset("assets/css/styles.css") }}"/>
    <!-- Template Base Styles End -->

    <link rel="stylesheet" href="{{ asset("assets/css/main.css") }}"/>
    <script src="{{ asset("assets/js/base/loader.js") }}"></script>
</head>

<body class="h-100">
<div id="root">

    @include('admin2.partials.navigation')

    <main>
        <div class="container">

            <!-- Title and Top Buttons Start -->
            <div class="page-title-container">
                <div class="row">
                    <!-- Title Start -->
                    <div class="col-12 col-sm-6">
                        <h1 class="mb-0 pb-0 display-4" id="title">
                            {{ $pageTitle }}
                        </h1>

                        <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
                            @if($pageTitle != 'Dashboard')
                                <ul class="breadcrumb pt-0">
                                    <li class="breadcrumb-item active"><a
                                            href="{{ route('admin2.dashboard.index') }}">@lang('menu.home')</a></li>
                                    <li class="breadcrumb-item"><a href="#">{{ $pageTitle }}</a></li>
                                </ul>
                            @endif
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Title End -->

            <!-- Title and Top Buttons End -->

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
<script src="{{ asset('assets/js/vendor/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>

<!-- Vendor Scripts End -->

<!-- Template Base Scripts Start -->
<script src="{{ asset('assets/font/CS-Line/csicons.min.js') }}"></script>
<script src="{{ asset('assets/js/base/helpers.js') }}"></script>
<script src="{{ asset('assets/js/base/globals.js') }}"></script>
<script src="{{ asset('assets/js/base/nav.js') }}"></script>
<script src="{{ asset('assets/js/base/search.js') }}"></script>
<script src="{{ asset('assets/js/base/settings.js') }}"></script>
<script src="{{ asset('assets/js/base/init.js') }}"></script>
<script src="{{ asset('assets/modules/fullcalendar/fullcalendar.min.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap-fileinput/bootstrap-fileinput.js') }}"></script>

<!-- Template Base Scripts End -->
<!-- Page Specific Scripts Start -->
<script src="{{ asset('assets/js/pages/auth.login.js') }}"></script>
<script src="{{ asset('assets/js/common.js') }}"></script>
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<!-- Page Specific Scripts End -->
<script src="{{ asset('assets/modules/izitoast/js/iziToast.min.js') }}"></script>
<script src="{{ asset('assets/modules/sweetalert/sweetalert.min.js') }}"></script>

@yield('scripts')

</body>
</html>
