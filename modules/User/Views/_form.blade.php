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
                <input type="email" id="email" class="form-control" name="email"
                       @if(\Illuminate\Support\Facades\Auth::user()->role->name !== \Modules\Role\Model\Role::ADMINISTRATOR)
                           readonly=""
                       @endif
                       value="{{ $user->email ?? old('email') }}">
            </div>
        </div>
        @can('update-user-role')
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="role">Role</label>
                </div>
                <div class="col-md-8">
                    {!! Form::select('role_id',$roles,$user->role->id ?? NULL,['id' => 'role', 'class' => 'select2 form-control', 'style' => 'width: 100%']) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="status">Status</label>
                </div>
                <div class="col-md-8">
                    <select name="status" id="status" class="select2 form-control">
                        @foreach($statuses as $key => $status)
                            <option value="{{ $key }}"
                                    @if(isset($user) && $user->status === $key) selected @endif>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endcan
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
        <div class="input-group mt-5">
            <button type="submit" id="save" class="btn btn-primary mr-2">Save</button>
            <button type="reset" class="btn btn-default">Reset</button>
        </div>
    </form>
</div>
@push('js')
    {!! JsValidator::formRequest('Modules\User\Http\Requests\UserValidation') !!}
@endpush
