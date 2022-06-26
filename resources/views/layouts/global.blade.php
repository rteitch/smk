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

    <!-- MAIN Project CSS file -->
    <link rel="stylesheet" href="{{ asset('iconic/dist/assets/css/main.css') }}">

    {{-- <script type="text/javascript">
        document.documentElement.className = document.documentElement.className.replace('no-js', 'js') + (document
            .implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#BasicStructure", "1.1") ? ' svg' : ' no-svg');
    </script> --}}
</head>

<body data-theme="light" class="font-nunito">


    <div id="wrapper" class="theme-cyan">

        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="m-t-30"><img src="{{ asset('iconic/dist/assets/images/logo-icon.svg') }}" width="48"
                        height="48" alt="Iconic">
                </div>
                <p>Please wait...</p>
            </div>
        </div>

        <!-- Top navbar div start -->
        <nav class="navbar navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-brand">
                    <button type="button" class="btn-toggle-offcanvas"><i class="fa fa-bars"></i></button>
                    <button type="button" class="btn-toggle-fullwidth"><i class="fa fa-bars"></i></button>
                    <a href="{{ route('backend.home') }}">SMKN2 SURAKARTA</a>
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
                                                    <p class="text">Campaign <strong>Holiday Sale</strong> is nearly
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
                                                    <p class="text">Your New Campaign <strong>Holiday Sale</strong> is
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
                                    <button class="dropdown-item" style="cursor: pointer;"><i class="fa fa-power-off"></i></button>
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
                    <img src="{{ asset('storage/' . \Auth::user()->avatar) }}" class="rounded-circle user-photo"
                        alt="User Profile Picture">
                    <div class="dropdown">
                        <span>Welcome,</span>
                        <a href="javascript:void(0);" class="dropdown-toggle user-name"
                            data-toggle="dropdown"><strong>{{ Auth::user()->name }}</strong></a>
                        <ul class="dropdown-menu dropdown-menu-right account">
                            <li><a href="{{ route('users.show', \Auth::user()->id) }}"><i class="icon-user"></i>My Profile</a></li>
                            <li><a href="app-inbox.html"><i class="icon-envelope-open"></i>Messages</a></li>
                            <li><a href="javascript:void(0);"><i class="icon-settings"></i>Settings</a></li>
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
                            <h6>{{ Auth::user()->Skor }}</h6>
                        </li>
                        <li class="col-4">
                            <small>Exp</small>
                            <h6>{{ Auth::user()->exp }}</h6>
                        </li>
                    </ul>
                </div>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#menu">Menu</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Chat"><i
                                class="icon-book-open"></i></a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#setting"><i
                                class="icon-settings"></i></a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#question"><i
                                class="icon-question"></i></a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content padding-0">
                    <div class="tab-pane active" id="menu">
                        <nav id="left-sidebar-nav" class="sidebar-nav">
                            <ul id="main-menu" class="metismenu li_animation_delay">
                                <li class="active">
                                    <a href="{{ route('backend.home') }}"><i
                                            class="fa fa-home"></i><span>Home</span></a>
                                </li>
                                <li>
                                    <a href="#Dashboard" class="has-arrow"><i
                                            class="fa fa-dashboard"></i><span>Dashboard</span></a>
                                    <ul>
                                        <li><a href="#">Manajemen User</a></li>
                                        <li><a href="#">Manajemen Job Class</a></li>
                                        <li><a href="#">Manajemen Skill</a></li>
                                        <li><a href="#">Manajemen Quest</a></li>
                                        <li><a href="#">Manajemen Reward</a></li>
                                        <li><a href="#">Manajemen Artikel</a></li>
                                        <li><a href="#">Manajemen Notifikasi</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#GuildAdventure" class="has-arrow"><i
                                            class="fa fa-compass"></i><span>Guild Adventure</span></a>
                                    <ul>
                                        <li><a href="#">Buku Panduan</a></li>
                                        <li><a href="#">Job Class</a></li>
                                        <li><a href="#">Skill</a></li>
                                        <li><a href="#">Quest</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{ route('artikel.published') }}"><i
                                            class="fa fa-rss"></i><span>Berita</span></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="tab-pane" id="Chat">
                        <form>
                            <div class="input-group m-b-20">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-magnifier"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Search...">
                            </div>
                        </form>
                        <ul class="right_chat list-unstyled li_animation_delay">
                            <li>
                                <a href="javascript:void(0);" class="media">
                                    <img class="media-object" src="assets/images/xs/avatar1.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name d-flex justify-content-between">Chris Fox <i
                                                class="fa fa-heart-o font-12"></i></span>
                                        <span class="message">chrisfox@gmail.com</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="media">
                                    <img class="media-object" src="assets/images/xs/avatar2.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name d-flex justify-content-between">Joge Lucky <i
                                                class="fa fa-heart-o font-12"></i></span>
                                        <span class="message">Jogelucky@gmail.com</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="media">
                                    <img class="media-object" src="assets/images/xs/avatar3.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name d-flex justify-content-between">Isabella <i
                                                class="fa fa-heart-o font-12"></i></span>
                                        <span class="message">Isabella@gmail.com</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="media">
                                    <img class="media-object" src="assets/images/xs/avatar4.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name d-flex justify-content-between">Folisise Chosielie <i
                                                class="fa fa-heart font-12"></i></span>
                                        <span class="message">FolisiseChosielie@gmail.com</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="media">
                                    <img class="media-object" src="assets/images/xs/avatar5.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name d-flex justify-content-between">Alexander <i
                                                class="fa fa-heart-o font-12"></i></span>
                                        <span class="message">Alexander@gmail.com</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
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
                        <h6>General Settings</h6>
                        <ul class="setting-list list-unstyled">
                            <li>
                                <label class="fancy-checkbox">
                                    <input type="checkbox" name="checkbox" checked>
                                    <span>Allowed Notifications</span>
                                </label>
                            </li>
                            <li>
                                <label class="fancy-checkbox">
                                    <input type="checkbox" name="checkbox">
                                    <span>Offline</span>
                                </label>
                            </li>
                            <li>
                                <label class="fancy-checkbox">
                                    <input type="checkbox" name="checkbox">
                                    <span>Location Permission</span>
                                </label>
                            </li>
                        </ul>

                        <a href="#" target="_blank" class="btn btn-block btn-primary">Buy this item</a>
                        <a href="https://themeforest.net/user/wrraptheme/portfolio" target="_blank"
                            class="btn btn-block btn-secondary">View portfolio</a>
                    </div>
                    <div class="tab-pane" id="question">
                        <form>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-magnifier"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Search...">
                            </div>
                        </form>
                        <ul class="list-unstyled question">
                            <li class="menu-heading">HOW-TO</li>
                            <li><a href="javascript:void(0);">How to Create Campaign</a></li>
                            <li><a href="javascript:void(0);">Boost Your Sales</a></li>
                            <li><a href="javascript:void(0);">Website Analytics</a></li>
                            <li class="menu-heading">ACCOUNT</li>
                            <li><a href="javascript:void(0);">Cearet New Account</a></li>
                            <li><a href="javascript:void(0);">Change Password?</a></li>
                            <li><a href="javascript:void(0);">Privacy &amp; Policy</a></li>
                            <li class="menu-heading">BILLING</li>
                            <li><a href="javascript:void(0);">Payment info</a></li>
                            <li><a href="javascript:void(0);">Auto-Renewal</a></li>
                            <li class="menu-button mt-3">
                                <a href="../docs/index.html" class="btn btn-primary btn-block">Documentation</a>
                            </li>
                        </ul>
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
                <li><a href="javascript:void(0);" class="right_icon_btn"><i class="fa fa-angle-right"></i></a></li>
            </ul>
        </div>

        <!-- mani page content body part -->
        <div id="main-content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>

    </div>
    <!-- Javascript -->
    <script src="{{ asset('iconic/dist/assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('iconic/dist/assets/bundles/vendorscripts.bundle.js') }}"></script>

    <!-- page vendor js file -->
    <script src="{{ asset('iconic/dist/assets/bundles/c3.bundle.js') }}"></script>

    <!-- page js file -->
    <script src="{{ asset('iconic/dist/assets/bundles/mainscripts.bundle.js') }}"></script>
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
