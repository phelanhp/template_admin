@extends('Base::layouts.master')
@section('content')
    @php
        $page = App\AppHelpers\Helper::segment(1) === 'profile' ? 'Profile' : 'Update User';
    @endphp
    <div id="role-module">
        <div class="breadcrumb-line">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('get.user.list') }}">Users</a></li>
                    <li class="breadcrumb-item active">{{ $page }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div id="user" class="card">
        <div class="card-body">
            @include('User::_form')
        </div>
    </div>
@endsection
