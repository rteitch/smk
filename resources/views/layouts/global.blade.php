<!DOCTYPE html>
<!--[if IE 9]> <html class="ie9 no-js" lang="en"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> GAWEB SMKN2SKA @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('polished/polished.min.css') }}">
    <link rel="stylesheet" href="{{ asset('polished/iconic/css/open-iconic-bootstrap.min.css') }}">

    <style>
        .grid-highlight {
            padding-top: 1rem;
            padding-bottom: 1rem;
            background-color: #5c6ac4;
            border: 1px solid #202e78;
            color: #fff;
        }

        hr {
            margin: 6rem 0;
        }

        hr+.display-3,
        hr+.display-2+.display-3 {
            margin-bottom: 2rem;
        }
    </style>
    <script type="text/javascript">
        document.documentElement.className = document.documentElement.className.replace('no-js', 'js') + (document
            .implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#BasicStructure", "1.1") ? ' svg' : ' no-svg');
    </script>
</head>

<body>
    {{-- Navigasi --}}
    <nav class="navbar navbar-expand p-0">
        {{-- Judul Situs --}}
        <a class="navbar-brand text-left col-xs-12 col-md-3 col-lg-2 mr-0 pl-4" href="{{ route('backend.home') }}">
            SMKN 2
            SOLO</a>
        {{-- Resnponsive Menu Mobile side-right --}}
        <button class="btn btn-link d-block d-md-none" data-toggle="collapse" data-target="#sidebar-nav" role="button">
            <span class="oi oi-menu"></span>
        </button>
        {{-- Search input dinavigasi --}}
        <div class="input-group">
            <input name="keyword" type="text" value="{{ Request::get('keyword') }}"
                class="border-dark bg-primary-darkest form-control d-none d-md-block w-50 ml-3 mr-2"
                placeholder="Search on page..">
            <div class="input-group-append">
                <button type="button" class="btn btn-primary d-none d-md-block mr-3" value="Filter">
                    <i class="oi oi-magnifying-glass"></i>
                </button>
            </div>
        </div>
        {{-- Menu Person --}}
        <div class="dropdown d-none d-md-block">
            {{-- Kondisi jika user login, muncul nama user --}}
            @if (\Auth::user())
                @if (\Auth::user()->avatar)
                    <img class="d-none d-lg-inline rounded-circle ml-1"
                        src="{{ asset('storage/' . \Auth::user()->avatar) }}"
                        alt="avatar_{{ \Auth::user()->avatar }}" width="32px">
                @else
                    NA
                @endif
                <button class="btn btn-link btn-link-primary dropdown-toggle" id="navbar-dropdown"
                    data-toggle="dropdown">
                    {{ Auth::user()->name }}
                </button>
            @endif
            {{-- Menu dropdown person --}}
            <div class="dropdown-menu dropdown-menu-right" id="navbar-dropdown">
                <a href="{{ route('users.show', \Auth::user()->id) }}" class="dropdown-item">Profile</a>
                <a href="#" class="dropdown-item">Setting</a>
                <div class="dropdown-divider"></div>
                {{-- Tombol untuk Logout --}}
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item" style="cursor: pointer;">Sign Out</button>
                    </form>
                </li>
            </div>
        </div>
    </nav>

    <div class="container-fluid h-100 p-0">
        <div style="min-height: 100%" class="flex-row d-flex align-items-stretch m-0">
            {{-- Sidebar Menu Section --}}
            <div class="polished-sidebar bg-light col-12 col-md-3 col-lg-2 p-0 collapse d-md-inline" id="sidebar-nav">
                <ul class="polished-sidebar-menu ml-0 pt-4 p-0 d-md-block">
                    <div class="input-group">
                        <input name="keyword" type="text" value="{{ Request::get('keyword') }}"
                            class="border-dark form-control d-block d-md-none mb-4" placeholder="Search on page..">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary d-block d-md-none" value="Filter">
                                <i class="oi oi-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>
                    {{-- Sidebar Menu --}}
                    <li><a href="/home"><span class="oi oi-home"> Home</span></a></li>
                    @if (json_decode(Auth::user()->roles) == array_intersect(['0']))
                        <li>
                            <a href="{{ route('users.index') }}">
                                <span class="oi oi-people"> Manage Users</span>
                            </a>
                        </li>
                    @endif
                    @if (json_decode(Auth::user()->roles) == array_intersect(['0']) || json_decode(Auth::user()->roles) == array_intersect(['1']))
                        <li><a href="{{ route('jobclass.index') }}"><span class="oi oi-tag"> Manage Job
                                    Class</span></a></li>
                        <li><a href="{{ route('skill.index') }}"><span class="oi oi-book"> Manage
                                    Skill</span></a>
                        </li>
                        <li><a href="{{ route('quest.index') }}"><span class="oi oi-task"> Manage
                                    Quest</span></a>
                        </li>
                        <li><a href="{{ route('orderq.index') }}"><span class="oi oi-paperclip"> Manage Order
                                    Quest</span></a>
                        </li>

                        <li><a href="#"><span class="oi oi-clipboard"> Manage Reward</span></a></li>
                        <li><a href="{{ route('artikel.index') }}"><span class="oi oi-globe"> Manage
                                    Artikel</span></a></li>
                        <li><a href="{{ route('artikel.published') }}"><span class="oi oi-globe"> Published
                                    Artikel</span></a></li>
                        <li><a href="#"><span class="oi oi-envelope-closed"> Manage Notifikasi</span></a></li>
                        <li><a href="#"><span class="oi oi-fork"> Manage Log</span></a></li>
                    @endif
                    {{-- Menu person responsive mobile --}}
                    <div class="d-block d-md-none">
                        <div class="dropdown-divider"></div>
                        <li><a href="{{ route('users.show', \Auth::user()->id) }}"> Profile</a></li>
                        <li><a href="#"> Setting</a></li>
                        {{-- Tombol untuk logout --}}
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item" style="cursor: pointer;">Sign Out</button>
                            </form>
                        </li>
                    </div>
                </ul>
                <div class="pl-3 d-none d-md-block position-fixed" style="bottom: 0px">
                    <span class="oi oi-cog"></span> Setting
                </div>
            </div>
            <div class="col-lg-10 col-md-9 pt-4">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
        integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
    </script>
    @yield('footer-scripts')
</body>

</html>
