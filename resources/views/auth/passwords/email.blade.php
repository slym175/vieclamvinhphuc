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
                    <h3>{{ trans('auth.forgot_password') }}</h3>
                    <p>{{ trans('auth.forgot_password_desc') }}</p>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group mb-2">
                            <div class="form-group-container">
                                <input id="username" type="text" placeholder="{{ trans('auth.email') }}"
                                       class="form-control @error('email') is-invalid @enderror" name="email"
                                       value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <i class="ik ik-link"></i>
                            </div>
                            @error('email')
                            <small class="invalid-feedback" role="alert">
                                <i class="ik ik-stop-circle mr-5 f-10"></i>{{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="sign-btn text-center">
                            <button type="submit" class="btn btn-theme">
                                {{ trans('auth.forgot_password') }}
                            </button>
                        </div>
                    </form>
                    @if (Route::has('register'))
                        <div class="register">
                            <p>{{ trans('auth.not_a_member') }} <a
                                    href="{{ route('register') }}">{{ trans('auth.create_a_account') }}</a>
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
