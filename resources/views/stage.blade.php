<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Login &mdash; {{ $settings->name }}</title>
    <meta name="description" content="Login Page" />
    <!-- Favicon Tags Start -->
{{--    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{ asset("img/favicon/apple-touch-icon-57x57.png") }}" />--}}
{{--    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset("img/favicon/apple-touch-icon-114x114.png") }}" />--}}
{{--    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset("img/favicon/apple-touch-icon-72x72.png") }}" />--}}
{{--    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset("img/favicon/apple-touch-icon-144x144.png") }}" />--}}
{{--    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="{{ asset("img/favicon/apple-touch-icon-60x60.png") }}" />--}}
{{--    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{ asset("img/favicon/apple-touch-icon-120x120.png") }}"/>--}}
{{--    <link rel="apple-touch-icon-precomposed" sizes="77x76" href="{{ asset("img/favicon/apple-touch-icon-76x76.png") }}" />--}}
{{--    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ asset("img/favicon/apple-touch-icon-152x152.png") }}" />--}}

    <!-- Favicon Tags End -->
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
<div id="root" class="h-100">
    <!-- Background Start -->
    <div class="fixed-background"></div>
    <!-- Background End -->

    <div class="container-fluid p-0 h-100 position-relative">
        <div class="row g-0 h-100">
            <!-- Left Side Start -->
            <div class="offset-0 col-12 d-none d-lg-flex offset-md-1 col-lg h-lg-100">
                <div class="min-h-100 d-flex align-items-center">
                    <div class="w-100 w-lg-75 w-xxl-50">
{{--                        <div>--}}
{{--                            <div class="mb-5">--}}
{{--                                <h1 class="display-3 text-white">Multiple Niches</h1>--}}
{{--                                <h1 class="display-3 text-white">Ready for Your Project</h1>--}}
{{--                            </div>--}}
{{--                            <p class="h6 text-white lh-1-5 mb-5">--}}
{{--                                Dynamically target high-payoff intellectual capital for customized technologies. Objectively integrate emerging core competencies before--}}
{{--                                process-centric communities...--}}
{{--                            </p>--}}
{{--                            <div class="mb-5">--}}
{{--                                <a class="btn btn-lg btn-outline-white" href="index.html">Learn More</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
            <!-- Left Side End -->

            <!-- Right Side Start -->
            <div class="col-12 col-lg-auto h-100 pb-4 px-4 pt-0 p-lg-0">
                <div class="sw-lg-70 min-h-100 bg-foreground d-flex justify-content-center align-items-center shadow-deep py-5 full-page-content-right-border">
                    <div class="sw-lg-50 px-5">
                        <div class="sh-11">
                            <a href="{{ $settings->logo_url }}">
                                <div class="logo-default"></div>
                            </a>
                        </div>
                        <div class="mb-5">
                            <h2 class="cta-1 mb-0 text-primary">Welcome,</h2>
                            <h2 class="cta-1 text-primary">let's get started!</h2>
                        </div>
                        <div class="mb-5">
                            <p class="h6">Please use your credentials to login.</p>
                        </div>
                        <div>
                            {!! Form::open(['url' => '', 'method' => 'post','id'=>'loginform']) !!}
                            <div class="tooltip-end-bottom">
                                <div class="mb-3 filled form-group tooltip-end-top">
                                    <i data-cs-icon="email"></i>
                                    <input class="form-control" placeholder="Email" name="email" />
                                </div>
                                <div class="mb-3 filled form-group tooltip-end-top">
                                    <i data-cs-icon="lock-off"></i>
                                    <input class="form-control pe-7" name="password" type="password" placeholder="Password" />
                                </div>
                                <button type="submit" onclick="login();return false;" class="btn btn-lg btn-primary">Login</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Right Side End -->
        </div>
    </div>
</div>

<!-- Theme Settings Modal Start -->
{{--<div--}}
{{--    class="modal fade modal-right scroll-out-negative"--}}
{{--    id="settings"--}}
{{--    data-bs-backdrop="true"--}}
{{--    tabindex="-1"--}}
{{--    role="dialog"--}}
{{--    aria-labelledby="settings"--}}
{{--    aria-hidden="true"--}}
{{-->--}}
{{--    <div class="modal-dialog modal-dialog-scrollable full" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <h5 class="modal-title">Theme Settings</h5>--}}
{{--                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--            </div>--}}

{{--            <div class="modal-body">--}}
{{--                <div class="scroll-track-visible">--}}
{{--                    <div class="mb-5" id="color">--}}
{{--                        <label class="mb-3 d-inline-block form-label">Color</label>--}}
{{--                        <div class="row d-flex g-3 justify-content-between flex-wrap mb-3">--}}
{{--                            <a href="#" class="flex-grow-1 w-50 option col" data-value="light-blue" data-parent="color">--}}
{{--                                <div class="card rounded-md p-3 mb-1 no-shadow color">--}}
{{--                                    <div class="blue-light"></div>--}}
{{--                                </div>--}}
{{--                                <div class="text-muted text-part">--}}
{{--                                    <span class="text-extra-small align-middle">LIGHT BLUE</span>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                            <a href="#" class="flex-grow-1 w-50 option col" data-value="dark-blue" data-parent="color">--}}
{{--                                <div class="card rounded-md p-3 mb-1 no-shadow color">--}}
{{--                                    <div class="blue-dark"></div>--}}
{{--                                </div>--}}
{{--                                <div class="text-muted text-part">--}}
{{--                                    <span class="text-extra-small align-middle">DARK BLUE</span>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}

{{--                        <div class="row d-flex g-3 justify-content-between flex-wrap mb-3">--}}
{{--                            <a href="#" class="flex-grow-1 w-50 option col" data-value="light-red" data-parent="color">--}}
{{--                                <div class="card rounded-md p-3 mb-1 no-shadow color">--}}
{{--                                    <div class="red-light"></div>--}}
{{--                                </div>--}}
{{--                                <div class="text-muted text-part">--}}
{{--                                    <span class="text-extra-small align-middle">LIGHT RED</span>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                            <a href="#" class="flex-grow-1 w-50 option col" data-value="dark-red" data-parent="color">--}}
{{--                                <div class="card rounded-md p-3 mb-1 no-shadow color">--}}
{{--                                    <div class="red-dark"></div>--}}
{{--                                </div>--}}
{{--                                <div class="text-muted text-part">--}}
{{--                                    <span class="text-extra-small align-middle">DARK RED</span>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}

{{--                        <div class="row d-flex g-3 justify-content-between flex-wrap mb-3">--}}
{{--                            <a href="#" class="flex-grow-1 w-50 option col" data-value="light-green" data-parent="color">--}}
{{--                                <div class="card rounded-md p-3 mb-1 no-shadow color">--}}
{{--                                    <div class="green-light"></div>--}}
{{--                                </div>--}}
{{--                                <div class="text-muted text-part">--}}
{{--                                    <span class="text-extra-small align-middle">LIGHT GREEN</span>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                            <a href="#" class="flex-grow-1 w-50 option col" data-value="dark-green" data-parent="color">--}}
{{--                                <div class="card rounded-md p-3 mb-1 no-shadow color">--}}
{{--                                    <div class="green-dark"></div>--}}
{{--                                </div>--}}
{{--                                <div class="text-muted text-part">--}}
{{--                                    <span class="text-extra-small align-middle">DARK GREEN</span>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}

{{--                        <div class="row d-flex g-3 justify-content-between flex-wrap mb-3">--}}
{{--                            <a href="#" class="flex-grow-1 w-50 option col" data-value="light-purple" data-parent="color">--}}
{{--                                <div class="card rounded-md p-3 mb-1 no-shadow color">--}}
{{--                                    <div class="purple-light"></div>--}}
{{--                                </div>--}}
{{--                                <div class="text-muted text-part">--}}
{{--                                    <span class="text-extra-small align-middle">LIGHT PURPLE</span>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                            <a href="#" class="flex-grow-1 w-50 option col" data-value="dark-purple" data-parent="color">--}}
{{--                                <div class="card rounded-md p-3 mb-1 no-shadow color">--}}
{{--                                    <div class="purple-dark"></div>--}}
{{--                                </div>--}}
{{--                                <div class="text-muted text-part">--}}
{{--                                    <span class="text-extra-small align-middle">DARK PURPLE</span>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}

{{--                        <div class="row d-flex g-3 justify-content-between flex-wrap mb-3">--}}
{{--                            <a href="#" class="flex-grow-1 w-50 option col" data-value="light-pink" data-parent="color">--}}
{{--                                <div class="card rounded-md p-3 mb-1 no-shadow color">--}}
{{--                                    <div class="pink-light"></div>--}}
{{--                                </div>--}}
{{--                                <div class="text-muted text-part">--}}
{{--                                    <span class="text-extra-small align-middle">LIGHT PINK</span>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                            <a href="#" class="flex-grow-1 w-50 option col" data-value="dark-pink" data-parent="color">--}}
{{--                                <div class="card rounded-md p-3 mb-1 no-shadow color">--}}
{{--                                    <div class="pink-dark"></div>--}}
{{--                                </div>--}}
{{--                                <div class="text-muted text-part">--}}
{{--                                    <span class="text-extra-small align-middle">DARK PINK</span>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="mb-5" id="navcolor">--}}
{{--                        <label class="mb-3 d-inline-block form-label">Override Nav Palette</label>--}}
{{--                        <div class="row d-flex g-3 justify-content-between flex-wrap">--}}
{{--                            <a href="#" class="flex-grow-1 w-33 option col" data-value="default" data-parent="navcolor">--}}
{{--                                <div class="card rounded-md p-3 mb-1 no-shadow">--}}
{{--                                    <div class="figure figure-primary top"></div>--}}
{{--                                    <div class="figure figure-secondary bottom"></div>--}}
{{--                                </div>--}}
{{--                                <div class="text-muted text-part">--}}
{{--                                    <span class="text-extra-small align-middle">DEFAULT</span>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                            <a href="#" class="flex-grow-1 w-33 option col" data-value="light" data-parent="navcolor">--}}
{{--                                <div class="card rounded-md p-3 mb-1 no-shadow">--}}
{{--                                    <div class="figure figure-secondary figure-light top"></div>--}}
{{--                                    <div class="figure figure-secondary bottom"></div>--}}
{{--                                </div>--}}
{{--                                <div class="text-muted text-part">--}}
{{--                                    <span class="text-extra-small align-middle">LIGHT</span>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                            <a href="#" class="flex-grow-1 w-33 option col" data-value="dark" data-parent="navcolor">--}}
{{--                                <div class="card rounded-md p-3 mb-1 no-shadow">--}}
{{--                                    <div class="figure figure-muted figure-dark top"></div>--}}
{{--                                    <div class="figure figure-secondary bottom"></div>--}}
{{--                                </div>--}}
{{--                                <div class="text-muted text-part">--}}
{{--                                    <span class="text-extra-small align-middle">DARK</span>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="mb-5" id="placement">--}}
{{--                        <label class="mb-3 d-inline-block form-label">Menu Placement</label>--}}
{{--                        <div class="row d-flex g-3 justify-content-between flex-wrap">--}}
{{--                            <a href="#" class="flex-grow-1 w-50 option col" data-value="horizontal" data-parent="placement">--}}
{{--                                <div class="card rounded-md p-3 mb-1 no-shadow">--}}
{{--                                    <div class="figure figure-primary top"></div>--}}
{{--                                    <div class="figure figure-secondary bottom"></div>--}}
{{--                                </div>--}}
{{--                                <div class="text-muted text-part">--}}
{{--                                    <span class="text-extra-small align-middle">HORIZONTAL</span>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                            <a href="#" class="flex-grow-1 w-50 option col" data-value="vertical" data-parent="placement">--}}
{{--                                <div class="card rounded-md p-3 mb-1 no-shadow">--}}
{{--                                    <div class="figure figure-primary left"></div>--}}
{{--                                    <div class="figure figure-secondary right"></div>--}}
{{--                                </div>--}}
{{--                                <div class="text-muted text-part">--}}
{{--                                    <span class="text-extra-small align-middle">VERTICAL</span>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="mb-5" id="behaviour">--}}
{{--                        <label class="mb-3 d-inline-block form-label">Menu Behaviour</label>--}}
{{--                        <div class="row d-flex g-3 justify-content-between flex-wrap">--}}
{{--                            <a href="#" class="flex-grow-1 w-50 option col" data-value="pinned" data-parent="behaviour">--}}
{{--                                <div class="card rounded-md p-3 mb-1 no-shadow">--}}
{{--                                    <div class="figure figure-primary left large"></div>--}}
{{--                                    <div class="figure figure-secondary right small"></div>--}}
{{--                                </div>--}}
{{--                                <div class="text-muted text-part">--}}
{{--                                    <span class="text-extra-small align-middle">PINNED</span>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                            <a href="#" class="flex-grow-1 w-50 option col" data-value="unpinned" data-parent="behaviour">--}}
{{--                                <div class="card rounded-md p-3 mb-1 no-shadow">--}}
{{--                                    <div class="figure figure-primary left"></div>--}}
{{--                                    <div class="figure figure-secondary right"></div>--}}
{{--                                </div>--}}
{{--                                <div class="text-muted text-part">--}}
{{--                                    <span class="text-extra-small align-middle">UNPINNED</span>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="mb-5" id="layout">--}}
{{--                        <label class="mb-3 d-inline-block form-label">Layout</label>--}}
{{--                        <div class="row d-flex g-3 justify-content-between flex-wrap">--}}
{{--                            <a href="#" class="flex-grow-1 w-50 option col" data-value="fluid" data-parent="layout">--}}
{{--                                <div class="card rounded-md p-3 mb-1 no-shadow">--}}
{{--                                    <div class="figure figure-primary top"></div>--}}
{{--                                    <div class="figure figure-secondary bottom"></div>--}}
{{--                                </div>--}}
{{--                                <div class="text-muted text-part">--}}
{{--                                    <span class="text-extra-small align-middle">FLUID</span>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                            <a href="#" class="flex-grow-1 w-50 option col" data-value="boxed" data-parent="layout">--}}
{{--                                <div class="card rounded-md p-3 mb-1 no-shadow">--}}
{{--                                    <div class="figure figure-primary top"></div>--}}
{{--                                    <div class="figure figure-secondary bottom small"></div>--}}
{{--                                </div>--}}
{{--                                <div class="text-muted text-part">--}}
{{--                                    <span class="text-extra-small align-middle">BOXED</span>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="mb-5" id="radius">--}}
{{--                        <label class="mb-3 d-inline-block form-label">Radius</label>--}}
{{--                        <div class="row d-flex g-3 justify-content-between flex-wrap">--}}
{{--                            <a href="#" class="flex-grow-1 w-33 option col" data-value="rounded" data-parent="radius">--}}
{{--                                <div class="card rounded-md radius-rounded p-3 mb-1 no-shadow">--}}
{{--                                    <div class="figure figure-primary top"></div>--}}
{{--                                    <div class="figure figure-secondary bottom"></div>--}}
{{--                                </div>--}}
{{--                                <div class="text-muted text-part">--}}
{{--                                    <span class="text-extra-small align-middle">ROUNDED</span>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                            <a href="#" class="flex-grow-1 w-33 option col" data-value="standard" data-parent="radius">--}}
{{--                                <div class="card rounded-md radius-regular p-3 mb-1 no-shadow">--}}
{{--                                    <div class="figure figure-primary top"></div>--}}
{{--                                    <div class="figure figure-secondary bottom"></div>--}}
{{--                                </div>--}}
{{--                                <div class="text-muted text-part">--}}
{{--                                    <span class="text-extra-small align-middle">STANDARD</span>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                            <a href="#" class="flex-grow-1 w-33 option col" data-value="flat" data-parent="radius">--}}
{{--                                <div class="card rounded-md radius-flat p-3 mb-1 no-shadow">--}}
{{--                                    <div class="figure figure-primary top"></div>--}}
{{--                                    <div class="figure figure-secondary bottom"></div>--}}
{{--                                </div>--}}
{{--                                <div class="text-muted text-part">--}}
{{--                                    <span class="text-extra-small align-middle">FLAT</span>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<button type="button" class="btn settings-button btn-gradient-primary" data-bs-toggle="modal" data-bs-target="#settings" id="settingsButton">--}}
{{--    <i data-cs-icon="paint-roller" class="position-relative"></i>--}}
{{--</button>--}}
<!-- Theme Settings Modal End -->

<!-- Vendor Scripts Start -->
<script src="{{asset('assets/js/vendor/jquery-3.5.1.min.js')}}"></script>
<script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/OverlayScrollbars.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/autoComplete.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/clamp.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/jquery.validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/jquery.validate/additional-methods.min.js') }}"></script>
<!-- Vendor Scripts End -->

<script>

    function login() {
        var url = "{{ route('admin.login_check') }}";

        $.easyAjax({
            url: url,
            type: "POST",
            data: $("#loginform").serialize(),
            container: "#loginform",
            messagePosition: "inline"
        });
    }

</script>

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
