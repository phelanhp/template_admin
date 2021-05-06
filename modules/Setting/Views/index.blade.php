@extends("Base::layouts.master")

@section("content")
    <div id="setting-module">
        <div class="breadcrumb-line">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">{{ trans('Home') }}</a></li>
                    <li class="breadcrumb-item"><a href="#">{{ trans('Settings') }}</a></li>
                </ol>
            </nav>
        </div>
        <div id="head-page" class="d-flex justify-content-between">
            <div class="page-title"><h3>{{ trans('Settings') }}</h3></div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route("get.setting.emailConfig") }}" class="btn btn-light btn-setting">
                        <span>{{ trans('Email Setting') }}</span>
                        <div>{{ trans('To configuration the site email and SMTP') }}</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
