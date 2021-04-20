@extends('layouts.dashboard')

@section('content')

<div>
    <h2>Roles</h2>
</div>

<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Roles</li>
    @if (auth()->guard('admin')->user()->hasPermission('create_roles'))
    <li class="breadcrumb-item"><a href="{{ route('dashboard.roles.create') }}"> Add New Role </a></li>
    @endif
</ul>

<div class="row">

    <div class="col-md-12">
        <div class="tile mb-4">
            <div class="row">
                <div class="col-md-12">
                    @if ($roles->count() > 0)
                    <table class="table table-hover" id="datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Permissions</th>
                                <th>Admins count</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($roles as $index=>$role)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @foreach ($role->permissions as $permission)
                                    {{-- <h5 style="display: inline-block;"><span
                                        class="badge badge-primary">{{__('admin.'.$permission->name)}}</span></h5> --}}
                                    <h5 style="display: inline-block;"><span
                                            class="badge badge-primary">{{ $permission->name }}</span></h5>
                                    @endforeach
                                </td>
                                <td>{{ $role->admins_count }}</td>

                                <td style="display: flex">
                                    @if(auth()->guard('admin')->user()->hasPermission('update_roles'))
                                    <a href="{{ route('dashboard.roles.edit', $role->id) }}" title="Edit"> <i
                                            class="fa fa-edit"></i></a>
                                    @endif
                                    @if(auth()->guard('admin')->user()->hasPermission('delete_roles'))
                                    <form method="post" action="{{ route('dashboard.roles.destroy', $role->id) }}"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" title="Delete"
                                            style="background: none;border:0px;color:#c13232;outline:0"
                                            class="delete"><i class="fa  fa-trash"></i></button>
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
