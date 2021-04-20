@extends('layouts.dashboard')

@section('content')

    <div>
        <h2>Admins</h2>
    </div>

    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.admins.index') }}">Admins</a></li>
        <li class="breadcrumb-item active">Add</li>
    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="tile mb-4">

                <form method="post" action="{{ route('dashboard.admins.store') }}">
                    @csrf
                    @method('post')

                    {{--name--}}
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                        @error("name")
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{--email--}}
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                        @error("email")
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{--password--}}
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" required class="form-control">
                        @error("password")
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{--password confirmation--}}
                    <div class="form-group">
                        <label> Confirmation Password</label>
                        <input type="password" name="password_confirmation" required class="form-control">
                        @error("password_confirmation")
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{--roles--}}
                    <div class="form-group">
                        <label>Roles</label>
                        <select name="role_id" required class="form-control">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @if(auth()->guard('admin')->user()->hasPermission('create_roles'))
                            <a href="{{ route('dashboard.roles.create') }}">Add New Role </a>
                        @endif
                    </div>

                    <div class="form-actions text-left">
                        {{-- <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
                            <i class="ft-x"></i> تراجع
                        </button> --}}
                        <button type="submit" class="btn btn-primary">
                            <i class="la la-check-square-o"></i> Add
                        </button>
                    </div>
                </form><!-- end of form -->

            </div><!-- end of tile -->
        </div><!-- end of col -->
    </div><!-- end of row -->

@endsection
