@extends('layouts.dashboard')

@section('content')

    <div>
        <h2>Admins</h2>
    </div>

    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Admins</li>
        @if (auth()->guard('admin')->user()->hasPermission('create_admins'))
            <li class="breadcrumb-item"><a href="{{ route('dashboard.admins.create') }}"> Add New Admin </a></li>
        @endif
    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="tile mb-4">
                <div class="row">
                    <div class="col-md-12">
                        @if ($admins->count() > 0)
                            <table class="table table-hover" id="datatable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th> Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($admins as $index=>$admin)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>
                                            @foreach ($admin->roles as $role)
                                                <h5 style="display: inline-block;"><span class="badge badge-primary">{{ $role->name }}</span></h5>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if(auth()->guard('admin')->user()->hasPermission('update_admins'))
                                                <a href="{{ route('dashboard.admins.edit', $admin->id) }}" title="Edit"> <i class="fa fa-edit"></i></a>
                                            @endif

                                            @if(auth()->guard('admin')->user()->hasPermission('delete_admins'))
                                                <form method="post" action="{{ route('dashboard.admins.destroy', $admin->id) }}" style="display: inline-block;">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"title="Delete" style="background: none;border:0px;color:#c13232;outline:0" class="delete"><i class="fa  fa-trash"></i></button>
                                                </form><!-- end of form -->
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        @else
                        <h3 style="font-weight: 400;">Sorry no records found</h3>
                        @endif
                    </div>
                </div>
            </div><!-- end of tile -->
        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection
