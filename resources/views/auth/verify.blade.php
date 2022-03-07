@extends('admin.layouts.app')

@section('title', 'Email Verification')

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
                <h3>{{ trans('auth.verify_email') }}</h3>
                <p>{{ __('Before proceeding, please check your email for a verification link.') }}<br>
                    {{ __('If you did not receive the email') }},</p>
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <div class="sign-btn text-center">
                        <button type="submit" class="btn btn-theme">
                            {{ __('click here to request another') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
