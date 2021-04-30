@extends("Base::layouts.master")

@section("content")
    <div id="role-module">
        <div class="breadcrumb-line">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('get.setting.list') }}">Setting</a></li>
                    <li class="breadcrumb-item active">Email Config</li>
                </ol>
            </nav>
        </div>

        <div id="head-page" class="d-flex justify-content-between">
            <div class="page-title"><h3>Email Config</h3></div>
        </div>
    </div>

    <div id="user" class="card">
        <div class="card-body">
            <form action="" method="post" id="role-form">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="name">Host</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="host" name="MAIL_HOST"
                                       value="{{ $setting->getValuebyKey(\Modules\Setting\Model\Email::MAIL_HOST) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="name">Port</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="port" name="MAIL_PORT"
                                       value="{{ $setting->getValuebyKey(\Modules\Setting\Model\Email::MAIL_PORT) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="name">Protocol</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="protocol" name="MAIL_ENCRYPTION"
                                       value="{{ $setting->getValuebyKey(\Modules\Setting\Model\Email::PROTOCOL) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="name">Username</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="username" name="MAIL_USERNAME"
                                       value="{{ $setting->getValuebyKey(\Modules\Setting\Model\Email::MAIL_USERNAME) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="name">Password</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="password" name="MAIL_PASSWORD"
                                       value="{{ $setting->getValuebyKey(\Modules\Setting\Model\Email::MAIL_PASSWORD) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="name">SMTP Server</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="driver" name="MAIL_DRIVER"
                                       value="{{ $setting->getValuebyKey(\Modules\Setting\Model\Email::MAIL_DRIVER) }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="name">Email from address</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="host" name="MAIL_ADDRESS"
                                       value="{{ $setting->getValuebyKey(\Modules\Setting\Model\Email::MAIL_ADDRESS) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="name">Email from name</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="host" name="MAIL_NAME"
                                       value="{{ $setting->getValuebyKey(\Modules\Setting\Model\Email::MAIL_NAME) }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="input-group mt-5">
                    <button type="submit" class="btn btn-primary mr-2">Save</button>
                    <button type="reset" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
@endsection
