@extends('admin.layouts.app')

@section('title', 'Reset Password')

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
                    <h3>{{ trans('auth.reset_password') }}</h3>
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group mb-2">
                            <div class="form-group-container">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       placeholder="{{ trans('auth.email') }}"
                                       name="email" value="{{ old('email') }}" required autocomplete="email">
                                <i class="ik ik-mail"></i>
                            </div>
                            @error('email')
                            <small class="invalid-feedback" role="alert">
                                <i class="ik ik-stop-circle mr-5 f-10"></i>{{ $message }}
                            </small>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <div class="form-group-container">
                                <input id="password" type="password" placeholder="{{ trans('auth.password') }}"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       required autocomplete="new-password">
                                <i class="ik ik-lock"></i>
                            </div>
                            @error('password')
                            <small class="invalid-feedback" role="alert">
                                <i class="ik ik-stop-circle mr-5 f-10"></i>{{ $message }}
                            </small>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <div class="form-group-container">
                                <input id="password-confirm" type="password" class="form-control"
                                       placeholder="{{ trans('auth.password_confirmation') }}"
                                       name="password_confirmation" required autocomplete="new-password">
                                <i class="ik ik-lock"></i>
                            </div>
                        </div>
                        <div class="sign-btn text-center">
                            <button type="submit" class="btn btn-theme">
                                {{ trans('auth.reset_password') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
