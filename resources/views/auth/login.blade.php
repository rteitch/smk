<!doctype html>
<html lang="en">

<head>
    <title>SMKN2SOLO Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Guild Adventure SMK Negeri 2 Surakarta">
    <meta name="author" content="SMKN2SKA">

    <link rel="icon" href="{{ asset('iconic/dist/fav-smkn2ska.png') }}" type="image/x-icon">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{ asset('iconic/dist/assets/vendor/bootstrap/css/bootstrap.min.css') }}">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('iconic/dist/assets/css/main.css') }}">

</head>

<body data-theme="light" class="font-nunito">
    <!-- WRAPPER -->
    <div id="wrapper" class="theme-cyan">
        <div class="vertical-align-wrap">
            <div class="vertical-align-middle auth-main">
                <div class="auth-box">
                    <div class="top">
                        <img src="{{ asset('iconic/dist/assets/images/smkn2solo.png') }}" alt="smkn2solo-logo" srcset="" >
                        {{-- <h4 class="text-white"> <strong>SMKN2 SURAKARTA</strong></h4> --}}
                    </div>
                    <div class="card">
                        <div class="header">
                            <p class="lead">Masuk ke akun Anda</p>
                        </div>
                        <div class="body">
                            <form class="form-auth-small" method="POST" action="{{ route('login') }}"
                                aria-label="{{ __('Login') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="signin-email"
                                        class="control-label sr-only">{{ __('Username or Email') }}</label>
                                    <input id="username" type="username"
                                        class="form-control{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}"
                                        name="login" value="{{ old('username') ?: old('email') }}" required
                                        autofocus placeholder="username / email">
                                    @if ($errors->has('username') || $errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="signin-password"
                                        class="control-label sr-only">{{ __('Password') }}</label>
                                    <input id="password" type="password"
                                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        name="password" required placeholder="password">
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group clearfix">
                                    <label class="fancy-checkbox element-left">
                                        <input id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}
                                            type="checkbox">
                                        <span>Ingat Saya</span>
                                    </label>
                                </div>
                                <button type="submit"
                                    class="btn btn-primary btn-lg btn-block">{{ __('Login') }}</button>
                                {{-- <div class="bottom">
                                    <span class="helper-text m-b-10"><i class="fa fa-lock"></i> <a
                                            href="page-forgot-password.html">Forgot password?</a></span>
                                    <span>Don't have an account? <a href="page-register.html">Register</a></span>
                                </div> --}}
                            </form>
                        </div>
                    </div>
                    <div class="footer text-center mt-3 mb-3">
                        Copyright © SMKN2 Surakarta. All Rights Reserved.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END WRAPPER -->
</body>

</html>
