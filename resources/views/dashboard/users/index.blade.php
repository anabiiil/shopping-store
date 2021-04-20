@extends('layouts.dashboard')

@section('content')


<div>
    <h2>Users</h2>
</div>

<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"> Dashboard</a></li>
    <li class="breadcrumb-item active">Users</li>
    @if (auth()->guard('admin')->user()->hasPermission('create_users'))
        <li class="breadcrumb-item"><a href="{{ route('dashboard.users.create') }}"> Add New User </a></li>
    @endif
</ul>

<div class="row">
    <div class="col-md-12">
        <div class="tile mb-4">


            <div class="row">
                <div class="col-md-12">
                    @if ($users->count() > 0)
                        <table class="table table-hover" id="datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th> Name</th>
                                <th>Email</th>
                                <th>status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($users as $index=>$user)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->getActive() == 'active')
                                        <span class="btn-sm btn-success">{{ $user->getActive() }}</span>
                                            @else
                                                <span class="btn-sm btn-danger">{{ $user->getActive() }}</span>
                                            @endif
                                        </td>

                                    <td>
                                        @if(auth()->guard('admin')->user()->hasPermission('update_users'))
                                            <a href="{{ route('dashboard.users.edit', $user->id) }}" title="Edit"> <i class="fa fa-edit"></i></a>
                                        @endif

                                        @if(auth()->guard('admin')->user()->hasPermission('delete_users'))
                                            <form method="post" action="{{ route('dashboard.users.destroy', $user->id) }}" style="display: inline-block;">
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
