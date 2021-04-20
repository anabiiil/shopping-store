@extends('layouts.dashboard')

@section('content')

    <div>
        <h2>Admins</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.admins.index') }}">Admins</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow mb-4">

                <form method="post" action="{{ route('dashboard.admins.update', $admin->id) }}">
                    @csrf
                    @method('put')

                    {{-- @include('dashboard.includes._errors') --}}

                    {{--name--}}
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $admin->name) }}">
                        @error('name')
                            <span class="text-danger">{{$message}} </span>
                        @enderror
                    </div>

                    {{--email--}}
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $admin->email) }}">
                        @error('email')
                            <span class="text-danger">{{$message}} </span>
                        @enderror
                    </div>

                    {{--password--}}
                    <div class="form-group">
                        <label for="projectinput1">  Password </label>
                        <input type="password" class="form-control" name="password">
                        @error('password')
                            <span class="text-danger">{{$message}} </span>
                        @enderror
                    </div>
                    {{--roles--}}
                    <div class="form-group">
                        <label>Roles</label>
                        <select name="role_id" class="form-control">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ $admin->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group text-left">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection
