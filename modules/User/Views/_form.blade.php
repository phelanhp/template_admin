<div class="col-md-6">
    <form action="" method="post">
        @csrf
        <div class="form-group row">
            <div class="col-md-4">
                <label for="name">Name</label>
            </div>
            <div class="col-md-8">
                <input type="text" id="name" class="form-control" name="name" value="{{ $user->name ?? old('name') }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-4">
                <label for="email">Email</label>
            </div>
            <div class="col-md-8">
                <input type="email" id="email" class="form-control" name="email" value="{{ $user->email ?? old('email') }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-4">
                <label for="password">Password</label>
            </div>
            <div class="col-md-8">
                <input type="password" id="password" class="form-control" name="password">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-4">
                <label for="password_re_enter">Re-enter Password</label>
            </div>
            <div class="col-md-8">
                <input type="password" id="password_re_enter" class="form-control" name="password_re_enter">
            </div>
        </div>
        @if(isset($user) && \Auth::guard()->user()->role->id === \Modules\Role\Model\Role::getAdminRole()->id)
        <div class="form-group row">
            <div class="col-md-4">
                <label for="role">Role</label>
            </div>
            <div class="col-md-8">
                {!! Form::select('role_id',$roles,$user->role->id ?? NULL,['id' => 'role', 'class' => 'select2 form-control', 'style' => 'width: 100%']) !!}
            </div>
        </div>
        @endif
        <div class="input-group mt-5">
            <button type="submit" class="btn btn-primary mr-2">Save</button>
            <button type="reset" class="btn btn-default">Reset</button>
        </div>
    </form>
</div>
@push('js')
    {!! JsValidator::formRequest('Modules\User\Http\Requests\UserValidation') !!}
@endpush
