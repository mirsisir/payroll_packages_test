<!DOCTYPE html>
<html>

<head>
    <title>HRM</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="_token" content="3MvDAIcMVGFuX6QqvLqMhJdbXk0WwiIMIvWM9OLv">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
    <link media="all" type="text/css" rel="stylesheet"
          href="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/assets/plugins/select2/css/select2.min.css">

    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" rel="stylesheet"/>
    <link media="all" type="text/css" rel="stylesheet"
          href="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" rel="stylesheet"/>
    <link href=" {{ asset('css/pace-flash.css') }}" rel="stylesheet"/>

    <link href="https://datatables.net/download/build/dataTables.responsive.nightly.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon"
          href="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/favicon.ico">

    <script src="https://kit.fontawesome.com/e303330059.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/pace.js') }}" ></script>

    <link media="all" type="text/css" rel="stylesheet"
          href="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <!-- plugin css -->
    <link media="all" type="text/css" rel="stylesheet"
          href="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/assets/plugins/flag-icon-css/css/flag-icon.css">
    <link media="all" type="text/css" rel="stylesheet"
          href="{{ asset('css/materialicons.css') }}">
    <link media="all" type="text/css" rel="stylesheet"
          href="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/assets/plugins/perfect-scrollbar/perfect-scrollbar.css">
    <!-- end plugin css -->

    <link media="all" type="text/css" rel="stylesheet"
          href="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">

    <!-- common css -->
    <link media="all" type="text/css" rel="stylesheet"
          href="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/css/app.css">
    <!-- end common css -->

    @livewireStyles

</head>

<body>

<div class="container-scroller" id="app">
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo"
               href=""><img
                    src="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/assets/images/logo.svg"
                    alt="logo"/></a>
            <a class="navbar-brand brand-logo-mini"
               href=""><img
                    src="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/assets/images/logo-mini.svg"
                    alt="logo"/></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="mdi mdi-menu"></span>
            </button>

            <div class="search-field d-none d-xl-block">
                <form class="d-flex align-items-center h-100 ml-6" action="#">
                    <b><h3 class="text-dark font-weight-bold mb-2 mt-2">
                            {{ $title??'' }}
                            @yield('title')
                        </h3></b>
                </form>
            </div>

            <ul class="navbar-nav navbar-nav-right">

                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown"
                       aria-expanded="false">

                        <div class="nav-profile-text">
                            <p class="mb-1 text-black">{{ Auth::user()->name }}</p>
                        </div>
                    </a>
                    <div class="dropdown-menu navbar-dropdown dropdown-menu-right p-0 border-0 font-size-sm"
                         aria-labelledby="profileDropdown" data-x-placement="bottom-end">

                        <div class="p-2">

                            <a class="dropdown-item py-1 d-flex align-items-center justify-content-between"
                               href="javascript:void(0)">
                                <span>Settings</span>
                                <i class="mdi mdi-settings"></i>
                            </a>
                            <div role="separator" class="dropdown-divider"></div>

                            <a href="{{ route('logout') }}"
                               class="dropdown-item py-1 d-flex align-items-center justify-content-between"
                               onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                <span class="menu-title">Log Out</span>
                                <i class="mdi mdi-logout menu-icon"></i>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </li>

            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>
    <div class="container-fluid page-body-wrapper">
        <div class="theme-setting-wrapper">
            <div id="color-settings" class="settings-panel">
                <i class="settings-close mdi mdi-close"></i>
                <div class="d-flex align-items-center justify-content-between border-bottom">
                    <p class="settings-heading font-weight-bold border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">
                        Template Skins</p>
                </div>
                <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                    <div class="img-ss rounded-circle bg-light border mr-3"></div>
                    Light
                </div>
                <div class="sidebar-bg-options" id="sidebar-dark-theme">
                    <div class="img-ss rounded-circle bg-dark border mr-3"></div>
                    Dark
                </div>
                <p class="settings-heading font-weight-bold mt-2">Header Skins</p>
                <div class="color-tiles mx-0 px-2">
                    <div class="tiles primary"></div>
                    <div class="tiles success"></div>
                    <div class="tiles warning"></div>
                    <div class="tiles danger"></div>
                    <div class="tiles pink"></div>
                    <div class="tiles info"></div>
                    <div class="tiles dark"></div>
                    <div class="tiles default"></div>
                </div>
            </div>
        </div>
        <div id="right-sidebar" class="settings-panel">
            <i class="settings-close mdi mdi-close"></i>
            <div class="d-flex align-items-center justify-content-between border-bottom">
                <p class="settings-heading font-weight-bold border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">
                    Friends</p>
            </div>
            <ul class="chat-list">
                <li class="list active">
                    <div class="profile">
                        <img
                            src="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/assets/images/faces/face3.jpg"
                            alt="image">
                        <span class="online"></span>
                    </div>
                    <div class="info">
                        <p>Thomas Douglas</p>
                        <p>Available</p>
                    </div>
                    <small class="text-muted my-auto">19 min</small>
                </li>
                <li class="list">
                    <div class="profile">
                        <img
                            src="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/assets/images/faces/face2.jpg"
                            alt="image">
                        <span class="offline"></span>
                    </div>
                    <div class="info">
                        <div class="wrapper d-flex">
                            <p>Catherine</p>
                        </div>
                        <p>Away</p>
                    </div>
                    <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                    <small class="text-muted my-auto">23 min</small>
                </li>
                <li class="list">
                    <div class="profile">
                        <img
                            src="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/assets/images/faces/face3.jpg"
                            alt="image">
                        <span class="online"></span>
                    </div>
                    <div class="info">
                        <p>Daniel Russell</p>
                        <p>Available</p>
                    </div>
                    <small class="text-muted my-auto">14 min</small>
                </li>
                <li class="list">
                    <div class="profile">
                        <img
                            src="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/assets/images/faces/face4.jpg"
                            alt="image">
                        <span class="offline"></span>
                    </div>
                    <div class="info">
                        <p>James Richardson</p>
                        <p>Away</p>
                    </div>
                    <small class="text-muted my-auto">2 min</small>
                </li>
                <li class="list">
                    <div class="profile">
                        <img
                            src="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/assets/images/faces/face5.jpg"
                            alt="image">
                        <span class="online"></span>
                    </div>
                    <div class="info">
                        <p>Madeline Kennedy</p>
                        <p>Available</p>
                    </div>
                    <small class="text-muted my-auto">5 min</small>
                </li>
                <li class="list">
                    <div class="profile">
                        <img
                            src="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/assets/images/faces/face6.jpg"
                            alt="image">
                        <span class="online"></span>
                    </div>
                    <div class="info">
                        <p>Sarah Graves</p>
                        <p>Available</p>
                    </div>
                    <small class="text-muted my-auto">47 min</small>
                </li>
            </ul>
        </div>

        @include('Payroll::layouts.navigation')

        <div class="main-panel">
            <div class="content-wrapper">

                @yield('content')

                {{ $slot ?? " " }}

            </div>
            <footer class="footer">
                <div class="container-fluid clearfix">
                        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2020 <a
                                href="http://www.bootstrapdash.com/" target="_blank">Bootstrapdash</a>. All rights
                            reserved.</span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made
                            with <i class="mdi mdi-heart text-danger"></i>
                        </span>
                </div>
            </footer>
        </div>
    </div>
</div>

<!-- base js -->
<script src="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/js/app.js"></script>
<script
    src="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js">
</script>
<!-- end base js -->

<!-- plugin js -->
<script
    src="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/assets/plugins/chartjs/chart.min.js">
</script>
<script
    src="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/assets/plugins/jquery-sparkline/jquery.sparkline.min.js">
</script>
<script
    src="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js">
</script>
<script
    src="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/assets/plugins/jquery-circle-progress/circle-progress.min.js">
</script>
<script
    src="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/assets/plugins/select2/js/select2.min.js"></script>
<script
    src="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/assets/plugins/datatables.net/jquery.dataTables.min.js"></script>
<script
    src="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.js"></script>
<!-- end plugin js -->

<!-- common js -->
<script src="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/assets/js/off-canvas.js">
</script>
<script
    src="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/assets/js/hoverable-collapse.js">
</script>
<script src="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/assets/js/misc.js"></script>
<script src="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/assets/js/settings.js">
</script>
<script src="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/assets/js/todolist.js">
</script>
<!-- end common js -->

<script src="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/assets/js/dashboard.js">
</script>
<script
    src="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/assets/plugins/datatables.net/jquery.dataTables.min.js"></script>
<script
    src="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.js"></script>
<script src="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/assets/js/data-table.js"></script>

<script src="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/assets/js/select2.js"></script>

<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>

<script src="https://datatables.net/download/build/dataTables.responsive.nightly.js"></script>


@livewireScripts
{{--    <script>--}}
{{--        var Turbolinks = require("turbolinks")--}}
{{--        Turbolinks.start()--}}
{{--    </script>--}}
@yield('js')

</body>

</html>
