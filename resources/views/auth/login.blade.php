@extends('admin.layouts.app')

@section('title', 'Sign In')

@section('content')
    <div class="container-fluid h-100">
        <div class="row flex-row h-100 bg-white">
            <div class="col-xl-8 col-lg-6 col-md-5 p-0 d-md-block d-lg-block d-sm-none d-none">
                <div class="lavalite-bg"
                     style="background-image: url({{ asset('assets/admin/images/auth/login-bg.jpg') }})">
                    <div class="lavalite-overlay"></div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-7 my-auto p-0">
                <div class="authentication-form mx-auto">
                    <div class="logo-centered">
                        <a href="{{ route_check('home') }}" class="d-block"><img
                                src="{{ asset('assets/shared/logo.png') }}" alt="logo"></a>
                    </div>
                    <h3>{{ trans('auth.register_greeting', ['name' => config('app.name')]) }}</h3>
                    <p>{{ trans('auth.register_sub_greeting') }}</p>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group mb-2">
                            <div class="form-group-container">
                                <input id="username" type="text" placeholder="{{ trans('auth.username') }}"
                                       class="form-control @error('username') is-invalid @enderror" name="username"
                                       value="{{ old('username') }}" required autocomplete="username" autofocus>
                                <i class="ik ik-link"></i>
                            </div>
                            @error('username')
                            <small class="invalid-feedback" role="alert">
                                <i class="ik ik-stop-circle mr-5 f-10"></i>{{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <div class="form-group-container">
                                <input id="password" type="password" placeholder="{{ trans('auth.password') }}"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       required autocomplete="current-password">
                                <i class="ik ik-lock"></i>
                            </div>

                            @error('password')
                            <small class="invalid-feedback" role="alert">
                                <i class="ik ik-stop-circle mr-5 f-10"></i>{{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col text-left">
                                <label class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" name="remember"
                                           id="item_checkbox" value="true"
                                           id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <span
                                        class="custom-control-label">&nbsp;{{ trans('auth.remember_me') }}</span>
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                                <div class="col text-right">
                                    <a href="{{ route('password.request') }}">{{ trans('auth.forgot_password') }}</a>
                                </div>
                            @endif
                        </div>
                        <div class="sign-btn text-center">
                            <button type="submit" class="btn btn-theme">
                                {{ trans('auth.sign_in') }}
                            </button>
                        </div>
                    </form>
                    @if (Route::has('register'))
                    <div class="register">
                        <p>{{ trans('auth.ask_has_account') }} <a
                                href="{{ route('register') }}">{{ trans('auth.create_a_account') }}</a>
                        </p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
