<!doctype html>
<html lang="en">

<head>
    <title>GAWEB SMKN2SKA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Iconic Bootstrap 4.5.0 Admin Template">
    <meta name="author" content="SMKN2SKA">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{ asset('iconic/dist/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('iconic/dist/assets/vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('iconic/dist/assets/vendor/charts-c3/plugin.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('iconic/dist/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css') }}">
    <link rel="stylesheet" href="{{ asset('iconic/dist/assets/vendor/multi-select/css/multi-select.css') }}">
    <link rel="stylesheet"
        href="{{ asset('iconic/dist/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">

    <link rel="stylesheet" href="{{ asset('iconic/dist/assets/vendor/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('iconic/dist/assets/vendor/charts-c3/plugin.css') }}" />

    <!-- MAIN Project CSS file -->
    <link rel="stylesheet" href="{{ asset('iconic/dist/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('iconic/dist/assets/css/h-menu.css') }}">

    @yield('css-vendor')
</head>

<body data-theme="light" class="font-nunito h_menu">

    <div id="wrapper" class="theme-cyan">

        <!-- Horizontal menu  -->
        <div class="over-menu"></div>
        <header class="header" id="header-sroll">
            <div class="container">
                <div class="desk-menu">
                    <div class="logo">
                        <div class="d-flex">
                            <h1 class="logo-adn"><a title="SMKN2SOLO" href="{{ route('backend.home') }}">SMKN2SOLO
                                    <span>Admin</span></a>
                            </h1>
                            <ul class="nav navbar-nav">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle icon-menu"
                                        data-toggle="dropdown">
                                        <i class="fa fa-bell"></i>
                                        <span class="notification-dot"></span>
                                    </a>
                                    <ul class="dropdown-menu notifications">
                                        <li class="header"><strong>You have <span id="jumlahnotifikasi"></span> new
                                                Notifications</strong></li>
                                        <li class="isi-notifikasi">

                                        </li>
                                        {{-- <li>
                                            <a href="javascript:void(0);">
                                                <div class="media">
                                                    <div class="media-left" id="img-notifikasi">
                                                    </div>
                                                    <div class="media-body">
                                                        <p id="judul-notifikasi"></p>
                                                        <p id="pesan-notifikasi" class="text">.</p>
                                                        <span id="waktu-notifikasi" class="timestamp"></span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li> --}}
                                        <li class="footer"><a href="javascript:void(0);" class="more">See all
                                                notifications</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <nav class="box-menu">
                        <div class="menu-container">
                            <div class="menu-head">
                                <h4 class="text-left mb-0">Menu</h4>
                            </div>
                            <div class="menu-header-container">
                                <ul id="cd-primary-nav" class="menu">
                                    <li class="menu-item menu-item-has-children @yield('dashboard-active')">
                                        <a href="#"><i class="fa fa-dashboard"></i> Dashboard</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item @yield('dash-user-active')"><a
                                                    href="{{ route('users.index') }}">Manajemen User</a></li>
                                            <li class="menu-item @yield('dash-jobclass-active')"><a
                                                    href="{{ route('jobclass.index') }}">Manajemen Job Class</a>
                                            </li>
                                            <li class="menu-item @yield('dash-skill-active')"><a
                                                    href="{{ route('skill.index') }}">Manajemen Skill</a></li>
                                            <li class="menu-item @yield('dash-quest-active')"><a
                                                    href="{{ route('quest.index') }}">Manajemen Quest</a></li>
                                            <li class="menu-item @yield('dash-quest-siswa-active')"><a
                                                    href="{{ route('orderq.index') }}">Manajemen Quest Siswa</a>
                                            </li>
                                            <li class="menu-item @yield('dash-reward-active')"><a
                                                    href="{{ route('reward.index') }}">Manajemen Reward</a></li>
                                            <li class="menu-item @yield('dash-reward-siswa-active')"><a
                                                    href="{{ route('orderr.index') }}">Manajemen Reward Siswa</a>
                                            </li>
                                            <li class="menu-item @yield('dash-artikel-active')"><a
                                                    href="{{ route('artikel.index') }}">Manajemen Artikel</a></li>
                                            <li class="menu-item @yield('dash-notifikasi-active')"><a
                                                    href="{{ route('notifikasi.index') }}">Manajemen Notifikasi</a>
                                            </li>
                                            <hr width="50%">
                                            <li class="menu-item @yield('dash-jobclass-saya-active')">
                                                <a href="#">JobClass Saya (progress)</a>
                                            </li>
                                            <li class="menu-item @yield('dash-quest-saya-active')">
                                                <a href="{{ route('orderq.siswa', \Auth::user()->id) }}">Quest
                                                    Saya</a>
                                            </li>
                                            <li class="menu-item @yield('dash-reward-saya-active')">
                                                <a href="{{ route('orderr.siswa', \Auth::user()->id) }}">Reward
                                                    Saya</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item menu-item-has-children @yield('ga-active')">
                                        <a href="#"><i class="fa fa-compass"></i> Guild Adventure</a>
                                        <ul class="sub-menu">

                                            <li class="menu-item @yield('ga-buku-panduan-active')"><a
                                                    href="{{ route('frontend.global') }}">Buku Panduan</a></li>
                                            <li class="menu-item @yield('ga-jobclass')"><a
                                                    href="{{ route('jobclass.published') }}">Job Class</a></li>
                                            <li class="menu-item @yield('ga-skill')"><a
                                                    href="{{ route('skill.published') }}">Skill</a></li>
                                            <li class="menu-item @yield('ga-quest')"><a
                                                    href="{{ route('quest.published') }}">Quest</a></li>
                                            <li class="menu-item @yield('ga-reward')"><a
                                                    href="{{ route('reward.published') }}">Reward</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item @yield('leaderboard-active')">
                                        <a href="{{ route('user.leaderboard') }}"><i class="fa fa-trophy"></i>
                                            Leaderboard</a>
                                    </li>
                                    <li class="menu-item @yield('artikel-active')}">
                                        <a href="{{ route('artikel.published') }}"><i class="fa fa-rss"></i>
                                            <span>Berita</span></a>
                                    </li>
                                    {{-- <li class="menu-item menu-item-has-children">
                                        <a href="#">Notifikasi</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item @yield('notifikasi-siswa')"><a
                                                    href="{{ route('notifikasi.showSiswaNotifikasi') }}">Siswa</a>
                                            </li>
                                            <li class="menu-item @yield('notifikasi-pengajar')"><a
                                                    href="{{ route('notifikasi.showPengajarNotifikasi') }}">Pengajar</a>
                                            </li>
                                        </ul>
                                    </li> --}}
                                    @if (Auth::user())
                                        <li class="menu-item menu-item-has-children li_right_side">
                                            <a href="#"><i class="fa fa-user"></i>
                                                {{ Auth::user()->name }}</a>
                                            <ul class="sub-menu">
                                                <li class="menu-item"><a
                                                        href="{{ route('users.show', \Auth::user()->id) }}">Profile
                                                    </a>
                                                </li>
                                                <li>

                                                    <form onsubmit="return confirm('Yakin ingin logout?')"
                                                        action="{{ route('logout') }}" method="POST">
                                                        @csrf
                                                        <button class="dropdown-item "
                                                            style="cursor: pointer;">Keluar</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </li>
                                    @endif
                                    <li class="line"></li>
                                </ul>
                            </div>
                            <div class="menu-foot">
                                <div class="social">
                                    <a href="#" target="_blank"><i class="fa fa-facebook-f"></i></a>
                                    <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                                    <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                                    <a href="#" target="_blank"><i class="fa fa-instagram"></i></a>
                                    <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                                </div>
                                <hr />
                                <address class="text-center">
                                    <span class="email"><i class="icon-mail"></i> smkn2solo.online</span>
                                </address>
                            </div>
                        </div>
                        <div class="hamburger-menu">
                            <div class="bar"></div>
                        </div>
                    </nav>
                </div>
            </div>
        </header>


        <!-- mani page content body part -->
        <div id="main-content">
            <div class="container">
                @yield('breadcrumb')
                @yield('content')
            </div>
        </div>
    </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <!-- Javascript -->
    <script src="{{ asset('iconic/dist/assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('iconic/dist/assets/bundles/vendorscripts.bundle.js') }}"></script>

    <!-- page vendor js file -->
    <script src="{{ asset('iconic/dist/assets/vendor/toastr/toastr.js') }}"></script>
    <script src="{{ asset('iconic/dist/assets/bundles/c3.bundle.js') }}"></script>
    <script src="{{ asset('iconic/dist/assets/vendor/jquery-inputmask/jquery.inputmask.bundle.js') }}"></script> <!-- Input Mask Plugin Js -->
    <script src="{{ asset('iconic/dist/assets/vendor/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ asset('iconic/dist/assets/vendor/multi-select/js/jquery.multi-select.js') }}"></script> <!-- Multi Select Plugin Js -->
    <script src="{{ asset('iconic/dist/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('iconic/dist/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('iconic/dist/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script> <!-- Bootstrap Tags Input Plugin Js -->

    <!-- page js file -->
    <script src="{{ asset('iconic/dist/assets/bundles/mainscripts.bundle.js') }}"></script>
    <script src=" {{ asset('iconic/js/pages/forms/advanced-form-elements.js') }}"></script>
    <script src="{{ asset('iconic/js/h-menu.js') }}"></script>
    <script src="{{ asset('iconic/js/index.js') }}"></script>

    <script>
        var staticUrl = '{{ url('get-notifikasi') }}';
        $.getJSON(staticUrl, function(data) {
            // console.log(data);

            document.getElementById("jumlahnotifikasi").innerHTML = data.length;
            for (i = 0; i < data.length; i = i + 1) {
                const header = document.querySelector('.isi-notifikasi');
                const myDiv1 = document.createElement('a');
                myDiv1.innerHTML =
                    "<div class='media'><a href='javascript:void(0);'><div class='media'><div class='media-left'> <i class='icon-envelope text-info'></i> </div><div class='media-body'><p><strong>" +
                    data[i].title + "</strong></p><p class='text'>" + data[i].pesan +
                    "</p><span class='timestamp'>" + data[i].created_at + "</span></div></div></div>";
                header.appendChild(myDiv1);
            }
        });
    </script>
    @yield('footer-scripts')
</body>

</html>
