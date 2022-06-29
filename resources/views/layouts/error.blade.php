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
                    <a href="{{ route('backend.home') }}">SMKN2SKA</a>
                </div>
            </div>
        </nav>

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
