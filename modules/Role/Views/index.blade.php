@extends('Base::layouts.master')

@section('content')
    <div id="role-module">
        <div class="breadcrumb-line">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">{{ trans('Home') }}</a></li>
                    <li class="breadcrumb-item"><a href="#">{{ trans('Role Listing') }}</a></li>
                </ol>
            </nav>
        </div>
        <div id="head-page" class="d-flex justify-content-between">
            <div class="page-title"><h3>{{ trans('Role Listing') }}</h3></div>
            <div class="group-btn">
                <a href="{{ route('get.role.create') }}" class="btn btn-primary" data-toggle="modal" data-target="#form-modal"><i class="fa fa-plus"></i> &nbsp; {{ trans('Add new') }}</a>
            </div>
        </div>
        <!--Search box-->
        <div class="search-box">
            <div class="card">
                <div class="card-header" data-toggle="collapse" data-target="#form-search-box" aria-expanded="false" aria-controls="form-search-box">
                    <div class="title">{{ trans('Search') }}</div>
                </div>
                <div class="card-body collapse show" id="form-search-box">
                    <form action="" method="get">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="text-input">{{ trans('Role name') }}</label>
                                    <input type="text" class="form-control" id="text-input" name="name" value="{{$filter['name'] ?? NULL}}">
                                </div>
                            </div>
                        </div>
                        <div class="input-group">
                            <button type="submit" class="btn btn-primary mr-2">{{ trans('Search') }}</button>
                            <button type="button" class="btn btn-default clear">{{ trans('Cancel') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="listing">
            <div class="card">
                <div class="card-body">
                    <div class="sumary">
                        <span class="listing-information">
                            {{ trans('Showing') }} <b>{{($roles->currentpage()-1)*$roles->perpage()+1}} {{ trans('to') }} {{($roles->currentpage()-1) * $roles->perpage() + $roles->count()}}</b> {{ trans('of') }}  <b>{{$roles->total()}}</b> {{ trans('entries') }}
                        </span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th width="100px">
                                    <input type="checkbox" class="checkbox-style select-all">
                                </th>
                                <th width="50px">#</th>
                                <th>{{ trans('Name') }}</th>
                                <th>{{ trans('Status') }}</th>
                                <th width="200px">{{ trans('Created At') }}</th>
                                <th width="200px">{{ trans('Updated At') }}</th>
                                <th width="200px" class="action">{{ trans('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($key = ($roles->currentpage()-1)*$roles->perpage()+1)
                            @foreach($roles as $role)
                                <tr>
                                    <td>
                                        <input type="checkbox" name='id[]' value="{{ $role->id }}" class="checkbox-style checkbox-item">
                                    </td>
                                    <td>{{$key++}}</td>
                                    <td>{{ gg_trans($role->name) }}</td>
                                    <td>{{ \Modules\Base\Model\Status::getStatus($role->status) ?? NULL }}</td>
                                    <td>{{ \Carbon\Carbon::parse($role->created_at)->format('d/m/Y H:i:s')}}</td>
                                    <td>{{ \Carbon\Carbon::parse($role->updated_at)->format('d/m/Y H:i:s')}}</td>
                                    <td class="link-action">
                                        <a href="{{ route('get.role.update',$role->id) }}" class="btn btn-primary mr-2" data-toggle="modal" data-target="#form-modal">
                                            <i class="fas fa-pencil-alt"></i></a>
                                        <a href="{{ route('get.role.delete',$role->id) }}" class="btn btn-danger btn-delete"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="mt-5 pagination-style">
                            {{ $roles->render('vendor.pagination.default') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! \App\AppHelpers\Helper::getModal(['class' => 'modal-ajax'])  !!}
@endsection

