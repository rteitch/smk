@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center bg-primary-darkest text-white">
                    <strong>Login</strong>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}" style="padding: 0 15%">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="username" class="col-sm-12 col-form-label pl-0">{{ __('Username or Email') }}</label>
                                <br>
                                <input id="username" type="username" class="form-control{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}" name="login" value="{{ old('username') ?: old('email') }}" required autofocus>

                                @if ($errors->has('username') || $errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-12">
                                <label for="password" class="col-md-4 col-form-label text-md-left pl-0">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="checkbox">
                                <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}> <label for="remember">{{ __('Remember Me') }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn-block btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                                <br>

                                <a class="btn btn-link pl-0" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
