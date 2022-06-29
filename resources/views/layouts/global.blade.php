<!doctype html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Home SMKN2 Surakarta">
    <meta name="author" content="Rizal Taufiq Hidayat">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title> GAWEB SMKN2SKA @yield('title')</title>

    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{ asset('iconic/dist/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('iconic/dist/assets/vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('iconic/dist/assets/vendor/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('iconic/dist/assets/vendor/charts-c3/plugin.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('iconic/dist/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css') }}">
    <link rel="stylesheet"
        href="{{ asset('iconic/dist/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('iconic/dist/assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('iconic/dist/assets/vendor/multi-select/css/multi-select.css') }}">
    <link rel="stylesheet"
        href="{{ asset('iconic/dist/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('iconic/dist/assets/vendor/nouislider/nouislider.min.css') }}" />

    <!-- MAIN Project CSS file -->
    <link rel="stylesheet" href="{{ asset('iconic/dist/assets/css/main.css') }}">

    {{-- <script type="text/javascript">
        document.documentElement.className = document.documentElement.className.replace('no-js', 'js') + (document
            .implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#BasicStructure", "1.1") ? ' svg' : ' no-svg');
    </script> --}}
    @yield('css-vendor')
</head>

<body data-theme="light" class="font-nunito">

    <div id="wrapper" class="theme-cyan">

        <!-- Page Loader -->
        {{-- <div class="page-loader-wrapper">
            <div class="loader">
                <div class="m-t-30"><img src="{{ asset('iconic/dist/assets/images/logo-icon.svg') }}" width="48"
                        height="48" alt="Iconic">
                </div>
                <p>Please wait...</p>
            </div>
        </div> --}}

        <!-- Top navbar div start -->
        <nav class="navbar navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-brand">
                    <button type="button" class="btn-toggle-offcanvas"><i class="fa fa-bars"></i></button>
                    <button type="button" class="btn-toggle-fullwidth"><i class="fa fa-bars"></i></button>
                    <a href="{{ route('backend.home') }}">SMKN2SKA</a>
                </div>

                <div class="navbar-right">
                    <form id="navbar-search" class="navbar-form search-form">
                        <input value="" class="form-control" placeholder="Search here..." type="text">
                        <button type="button" class="btn btn-default"><i class="icon-magnifier"></i></button>
                    </form>

                    <div id="navbar-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                                    <i class="fa fa-bell"></i>
                                    <span class="notification-dot"></span>
                                </a>
                                <ul class="dropdown-menu notifications">
                                    <li class="header"><strong>You have 4 new Notifications</strong></li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="media">
                                                <div class="media-left">
                                                    <i class="icon-info text-warning"></i>
                                                </div>
                                                <div class="media-body">
                                                    <p class="text">Campaign <strong>Holiday Sale</strong> is
                                                        nearly
                                                        reach budget limit.</p>
                                                    <span class="timestamp">10:00 AM Today</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="media">
                                                <div class="media-left">
                                                    <i class="icon-like text-success"></i>
                                                </div>
                                                <div class="media-body">
                                                    <p class="text">Your New Campaign <strong>Holiday
                                                            Sale</strong> is
                                                        approved.</p>
                                                    <span class="timestamp">11:30 AM Today</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="media">
                                                <div class="media-left">
                                                    <i class="icon-pie-chart text-info"></i>
                                                </div>
                                                <div class="media-body">
                                                    <p class="text">Website visits from Twitter is 27% higher than
                                                        last week.</p>
                                                    <span class="timestamp">04:00 PM Today</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="media">
                                                <div class="media-left">
                                                    <i class="icon-info text-danger"></i>
                                                </div>
                                                <div class="media-body">
                                                    <p class="text">Error on website analytics configurations</p>
                                                    <span class="timestamp">Yesterday</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="footer"><a href="javascript:void(0);" class="more">See all
                                            notifications</a></li>
                                </ul>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item" style="cursor: pointer;"><i
                                            class="fa fa-power-off"></i></button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- main left menu -->
        <div id="left-sidebar" class="sidebar">
            <button type="button" class="btn-toggle-offcanvas"><i class="fa fa-arrow-left"></i></button>
            <div class="sidebar-scroll">
                <div class="user-account">
                    <img src="{{ asset('storage/'. \Auth::user()->avatar) }}" class="rounded-circle user-photo" alt="User Profile Picture">
                    @if (Auth::check())
                        <div class="dropdown">
                            <span>Welcome,</span>
                            <a href="javascript:void(0);" class="dropdown-toggle user-name"
                                data-toggle="dropdown"><strong>{{ Auth::user()->name }}</strong></a>
                            <ul class="dropdown-menu dropdown-menu-right account">
                                <li><a href="{{ route('users.show', \Auth::user()->id) }}"><i
                                            class="icon-user"></i>My
                                        Profile</a></li>
                                <li class="divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="btn btn-danger" style="cursor: pointer;">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <hr>
                        <ul class="row list-unstyled">
                            <li class="col-4">
                                <small>Level</small>
                                <h6>{{ Auth::user()->level }}</h6>
                            </li>
                            <li class="col-4">
                                <small>Skor</small>
                                <h6>{{ Auth::user()->skor }}</h6>
                            </li>
                            <li class="col-4">
                                <small>Exp</small>
                                <h6>{{ Auth::user()->exp }}</h6>
                            </li>
                        </ul>
                    @endif
                </div>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#menu">Menu</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#setting"><i
                                class="icon-settings"></i></a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content padding-0">
                    <div class="tab-pane active" id="menu">
                        <nav id="left-sidebar-nav" class="sidebar-nav">
                            <ul id="main-menu" class="metismenu li_animation_delay">
                                <li class="{{ Request::path() == 'home' ? 'active' : '' }}">
                                    <a href="{{ route('backend.home') }}"><i
                                            class="fa fa-home"></i><span>Home</span></a>
                                </li>
                                <li class="@if (Request::path() == 'users' || Request::path() == 'jobclass' || Request::path() == 'skill' || Request::path() == 'quest' || Request::path() == 'reward' || Request::path() == 'artikel' || Request::path() == 'notifikasi' || Request::path() == 'users/create') active @else @endif">
                                    <a href="#Dashboard" class="has-arrow"><i
                                            class="fa fa-dashboard"></i><span>Dashboard</span></a>
                                    <ul aria-expanded="false"
                                        class="@if (Request::path() == 'users' || Request::path() == 'jobclass' || Request::path() == 'skill' || Request::path() == 'quest' || Request::path() == 'reward' || Request::path() == 'artikel' || Request::path() == 'notifikasi' || Request::path() == 'users/create') collapse in @else collapse @endif">
                                        <li class="@if (Request::path() == 'users' || Request::path() == 'users/create') active @endif"><a
                                                href="{{ route('users.index') }}">Manajemen User</a></li>
                                        <li class="@if (Request::path() == 'jobclass') active @endif"><a
                                                href="{{ route('jobclass.index') }}">Manajemen Job Class</a>
                                        </li>
                                        <li class="@if (Request::path() == 'skill') active @endif"><a
                                                href="{{ route('skill.index') }}">Manajemen Skill</a></li>
                                        <li class="@if (Request::path() == 'quest') active @endif"><a
                                                href="{{ route('quest.index') }}">Manajemen Quest</a></li>
                                        <li class="@if (Request::path() == 'reward') active @endif"><a
                                                href="{{ route('reward.index') }}">Manajemen Reward</a></li>
                                        <li class="@if (Request::path() == 'artikel') active @endif"><a
                                                href="{{ route('artikel.index') }}">Manajemen Artikel</a></li>
                                        <li class="@if (Request::path() == 'notifikasi') active @endif"><a
                                                href="{{ route('notifikasi.index') }}">Manajemen Notifikasi</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#GuildAdventure" class="has-arrow"><i
                                            class="fa fa-compass"></i><span>Guild
                                            Adventure</span></a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a href="#">Buku Panduan</a></li>
                                        <li><a href="{{ route('jobclass.published') }}">Job Class</a></li>
                                        <li><a href="{{ route('skill.published') }}">Skill</a></li>
                                        <li><a href="{{ route('quest.published') }}">Quest</a></li>
                                        <li><a href="#">Quest</a></li>
                                    </ul>
                                </li>
                                <li class="{{ Request::path() == 'leaderboard' ? 'active' : '' }}">
                                    <a href="{{ route('user.leaderboard') }}"><i
                                            class="fa fa-anchor"></i><span>Leaderboard</span></a>
                                </li>
                                <li class="{{ Request::path() == 'artikel/published' ? 'active' : '' }}">
                                    <a href="{{ route('artikel.published') }}"><i
                                            class="fa fa-rss"></i><span>Berita</span></a>
                                </li>
                                <li class="">
                                    <a href="#"><i class="fa fa-bell"></i><span>Notifikasi</span></a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                    <div class="tab-pane" id="setting">
                        <h6>Choose Skin</h6>
                        <ul class="choose-skin list-unstyled">
                            <li data-theme="purple">
                                <div class="purple"></div>
                            </li>
                            <li data-theme="blue">
                                <div class="blue"></div>
                            </li>
                            <li data-theme="cyan" class="active">
                                <div class="cyan"></div>
                            </li>
                            <li data-theme="green">
                                <div class="green"></div>
                            </li>
                            <li data-theme="orange">
                                <div class="orange"></div>
                            </li>
                            <li data-theme="blush">
                                <div class="blush"></div>
                            </li>
                            <li data-theme="red">
                                <div class="red"></div>
                            </li>
                        </ul>

                        <ul class="list-unstyled font_setting mt-3">
                            <li>
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="font"
                                        value="font-nunito" checked="">
                                    <span class="custom-control-label">Nunito Google Font</span>
                                </label>
                            </li>
                            <li>
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="font"
                                        value="font-ubuntu">
                                    <span class="custom-control-label">Ubuntu Font</span>
                                </label>
                            </li>
                            <li>
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="font"
                                        value="font-raleway">
                                    <span class="custom-control-label">Raleway Google Font</span>
                                </label>
                            </li>
                            <li>
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="font"
                                        value="font-IBMplex">
                                    <span class="custom-control-label">IBM Plex Google Font</span>
                                </label>
                            </li>
                        </ul>

                        <ul class="list-unstyled mt-3">
                            <li class="d-flex align-items-center mb-2">
                                <label class="toggle-switch theme-switch">
                                    <input type="checkbox">
                                    <span class="toggle-switch-slider"></span>
                                </label>
                                <span class="ml-3">Enable Dark Mode!</span>
                            </li>
                            <li class="d-flex align-items-center mb-2">
                                <label class="toggle-switch theme-rtl">
                                    <input type="checkbox">
                                    <span class="toggle-switch-slider"></span>
                                </label>
                                <span class="ml-3">Enable RTL Mode!</span>
                            </li>
                            <li class="d-flex align-items-center mb-2">
                                <label class="toggle-switch theme-high-contrast">
                                    <input type="checkbox">
                                    <span class="toggle-switch-slider"></span>
                                </label>
                                <span class="ml-3">Enable High Contrast Mode!</span>
                            </li>
                        </ul>

                        <hr>
                    </div>
                </div>
            </div>
        </div>

        <!-- rightbar icon div -->
        <div class="right_icon_bar">
            <ul>
                <li><a href="app-inbox.html"><i class="fa fa-envelope"></i></a></li>
                <li><a href="app-chat.html"><i class="fa fa-comments"></i></a></li>
                <li><a href="app-calendar.html"><i class="fa fa-calendar"></i></a></li>
                <li><a href="file-dashboard.html"><i class="fa fa-folder"></i></a></li>
                <li><a href="app-contact.html"><i class="fa fa-id-card"></i></a></li>
                <li><a href="blog-list.html"><i class="fa fa-globe"></i></a></li>
                <li><a href="javascript:void(0);"><i class="fa fa-plus"></i></a></li>
                <li><a href="javascript:void(0);" class="right_icon_btn"><i class="fa fa-angle-right"></i></a>
                </li>
            </ul>
        </div>

        <!-- mani page content body part -->
        <div id="main-content">
            <div class="container-fluid">
                @yield('breadcrumb')
                @yield('content')
            </div>
        </div>

    </div>
    <!-- Javascript -->
    <script src="{{ asset('iconic/dist/assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('iconic/dist/assets/bundles/vendorscripts.bundle.js') }}"></script>

    <!-- page vendor js file -->
    <script src="{{ asset('iconic/dist/assets/bundles/c3.bundle.js') }}"></script>
    <script src="{{ asset('iconic/dist/assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js') }}"></script> <!-- Bootstrap Colorpicker Js -->
    <script src="{{ asset('iconic/dist/assets/vendor/jquery-inputmask/jquery.inputmask.bundle.js') }}"></script> <!-- Input Mask Plugin Js -->
    <script src="{{ asset('iconic/dist/assets/vendor/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ asset('iconic/dist/assets/vendor/multi-select/js/jquery.multi-select.js') }}"></script> <!-- Multi Select Plugin Js -->
    <script src="{{ asset('iconic/dist/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('iconic/dist/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('iconic/dist/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script> <!-- Bootstrap Tags Input Plugin Js -->
    <script src="{{ asset('iconic/dist/assets/vendor/nouislider/nouislider.js') }}"></script> <!-- noUISlider Plugin Js -->


    <!-- page js file -->
    <script src="{{ asset('iconic/dist/assets/bundles/mainscripts.bundle.js') }}"></script>
    <script src=" {{ asset('iconic/js/pages/forms/advanced-form-elements.js') }}"></script>
    <script src="{{ asset('iconic/js/index.js') }}"></script>


    {{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
        integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
    </script> --}}
    @yield('footer-scripts')
</body>

</html>
