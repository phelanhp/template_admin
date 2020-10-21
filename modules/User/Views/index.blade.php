@extends('Base::layouts.master')

@section('content')
<div id="user-module">
    <div class="breadcrumb-line">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Users</a></li>
            </ol>
        </nav>
    </div>
    <div id="head-page" class="d-flex justify-content-between">
        <div class="page-title"><h3>User Listing</h3></div>
        <div class="group-btn">
            <a href="{{ route('get.user.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> &nbsp; Add New</a>
        </div>
    </div>
    <!--Search box-->
    <div class="search-box">
        <div class="card">
            <div class="card-header" data-toggle="collapse" data-target="#form-search-box" aria-expanded="false" aria-controls="form-search-box">
                <div class="title">Search</div>
            </div>
            <div class="card-body collapse show" id="form-search-box">
                <form action="" method="get">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="text-input">Role name</label>
                                <input type="text" class="form-control" id="text-input" name="name" value="{{$filter['name'] ?? NULL}}">
                            </div>
                        </div>
                    </div>
                    <div class="input-group">
                        <button type="submit" class="btn btn-primary mr-2">Search</button>
                        <button type="button" class="btn btn-default clear">Cancel</button>
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
                            Showing <b>{{($users->currentpage()-1)*$users->perpage()+1}} to {{($users->currentpage()-1) * $users->perpage() + $users->count()}}</b>
                            of  <b>{{$users->total()}}</b> entries
                        </span>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th width="50px">#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th width="200px">Created At</th>
                            <th width="200px">Updated At</th>
                            <th width="200px" class="action">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($key = ($users->currentpage()-1)*$users->perpage()+1)
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $key++ }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->roles->first()->role->name ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i:s')}}</td>
                            <td>{{ \Carbon\Carbon::parse($user->updated_at)->format('d/m/Y H:i:s')}}</td>
                            <td class="link-action">
                                <a href="{{ route('get.user.update',$user->id) }}" class="btn btn-primary mr-2">
                                    <i class="fas fa-pencil-alt"></i></a>
                                <a href="{{ route('get.user.delete',$user->id) }}" class="btn btn-danger btn-delete"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="mt-5 pagination-style">
                        {{ $users->render('vendor.pagination.default') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
