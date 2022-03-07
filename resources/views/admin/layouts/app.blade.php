<!doctype html>
<html class="no-js" lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/shared/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/shared/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/shared/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/shared/site.webmanifest') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/libs/icon-kit/dist/css/iconkit.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/libs/perfect-scrollbar/css/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/libs/jquery-toast-plugin/dist/jquery.toast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/theme.min.css') }}">
    <script src="{{ asset('assets/admin/libs/modernizr/modernizr-2.8.3.min.js') }}"></script>
    @stack('css')
    @stack('js_defer')
</head>
<body>
<div id="loading">
    <img id="loading-image" src="{{ asset('assets/shared/loader.svg') }}" alt="Loading..." />
</div>
<div class="wrapper" ng-app="ngAppWrapper">
    @if(session()->has('is_auth_view'))
        <div class="auth-wrapper">
            @yield('content')
        </div>
    @else
        @includeIf('admin.partials._menu_list')
        @includeIf('admin.partials.header')
        <div class="page-wrap">
            @includeIf('admin.partials.app-sidebar')

            <div class="main-content">
                @yield('content')
            </div>

            @includeIf('admin.partials.right-sidebar')
            @includeIf('admin.partials.chat-panel')
            @includeIf('admin.partials.footer')
        </div>
        @includeIf('admin.partials.app-modal')
    @endif
    @php session()->forget('is_auth_view') @endphp
</div>
<script src="{{ asset('assets/admin/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/libs/angularjs/angular.min.js') }}"></script>
<script>
    const ngAppWrapper = angular.module('ngAppWrapper', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    }).constant('AppGlobalData', {
        'API_URL': '{{ config('app.url') }}',
        'token': localStorage.getItem('_access_token')
    }).factory('toaster', () => {
        return (header = "", body = "", type = 'default', callback = {
            beforeShow: () => {
            },
            afterShown: () => {
            },
            beforeHide: () => {
            },
            afterHidden: () => {
            },
        }) => {
            const toastType = {
                'default': 'black',
                'warning': 'red',
                'success': 'green',
                'error': 'red',
                'info': 'blue'
            }
            jQuery.toast({
                heading: header ? header : 'Notification!',
                text: body ? body : 'Something was happen!!',
                icon: type === 'default' ? '' : type,
                loader: true,
                loaderBg: toastType[type],
                hideAfter: 5000,
                showHideTransition: 'slide',
                allowToastClose: true,
                stack: 4,
                position: 'top-right',
                beforeShow: jQuery.isFunction(callback.beforeShow) ? callback.beforeShow : () => {},
                afterShown: jQuery.isFunction(callback.afterShown) ? callback.afterShown : () => {},
                beforeHide: jQuery.isFunction(callback.beforeHide) ? callback.beforeHide : () => {},
                afterHidden: jQuery.isFunction(callback.afterHidden) ? callback.afterHidden : () => {}
            })
        };
    });
</script>
<script src="{{ asset('assets/admin/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/admin/libs/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/admin/libs/screenfull/dist/screenfull.js') }}"></script>
<script src="{{ asset('assets/admin/libs/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>
<script src="{{ asset('assets/admin/libs/moment/moment.js') }}"></script>
<script src="{{ asset('assets/admin/js/theme.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/app.js') }}"></script>
@stack('js')
<script>
    $(window).on('load', function(){
        var loader = setTimeout(removeLoader(this), 1000);
    });
    function removeLoader(loader){
        $( "#loading" ).fadeOut(300, function() {
            $( "#loading" ).remove();
        });
    }
</script>
</body>
</html>
