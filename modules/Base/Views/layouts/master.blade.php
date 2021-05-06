<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('assets/fontawesome/css/all.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/select2/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/datetimepicker/css/datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/main.css') }}">
    <title>System</title>
</head>
<body>

<!-- Header -->
<header class="topbar d-flex justify-content-between">
    <!-- Logo -->
    <div id="logo" class="logo d-flex justify-content-between">
        <img src="/logo/logo.png" alt="logo">
        <button id="menu-button" class="btn border-0 bg-transparent menu-button">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    <!-- Right-Sidebar -->
    <div class="d-flex align-items-center">
        <div class="mr-2" style="width: 160px;">
            <select class="select2 form-control" id="change-language" name="dropdown">
                <option value="en" @if(session()->get('locale') === 'en') selected @endif>{{ trans('English') }} (US)</option>
                <option value="cn" @if(session()->get('locale') === 'cn') selected @endif>{{ trans('Chinese') }} (Traditional)</option>
            </select>
        </div>
        <div class="right-sidebar float-right" data-toggle="collapse" href="#list-menu" aria-expanded="false">
            <a href="#" class="text-light">{{ \Illuminate\Support\Facades\Auth::user()->name ?? null }}</a>
            <ul class="collapse list-unstyled border menu-sidebar" id="list-menu">
                <li><a href="{{ route('get.profile.update') }}"> {{ trans('Profile') }}</a></li>
                <li><a href="{{ route('get.logout.admin') }}"> {{ trans('Log out') }}</a></li>
            </ul>
        </div>
    </div>
</header>
<!-- Left Sidebar -->
@include('Base::layouts.left_sidebar')
<!-- Content -->
<div class="page-wrapper clearfix">
    <div class="container-fluid page-content">
        @yield('content')
    </div>
</div>
@if (session('error') || session('danger'))
    <div class="alert alert-danger alert-fade-out" style="display: none" role="alert">
        {{ session('error') ?? session('danger') }}
    </div>
@endif
@if (session('success'))
    <div class="alert alert-primary alert-fade-out" style="display: none" role="alert">
        {{ session('success') }}
    </div>
@endif
<!-- Footer -->
{{--<footer>© 2018 Admin Template by Phelan</footer>--}}
</body>
<script src="{{ asset('assets/jquery/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap/datetimepicker/js/datetimepicker.min.js') }}"></script>
<script src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
<script src="{{ asset('assets/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/backend/jquery/main.js') }}"></script>
<script src="{{ asset('assets/backend/jquery/modal.js') }}"></script>
<script src="{{ asset('assets/backend/jquery/menu.js') }}"></script>
<script src="{{ asset('assets/backend/jquery/custom.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.select2').select2();
        if ($('.alert-primary').html() !== undefined) {
            $('.alert-danger').css('top', '120px');
        }
        slideAlert($('.alert-fade-out'));
    });
</script>
@stack('js')
</html>
